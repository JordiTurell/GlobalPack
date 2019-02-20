<?php

namespace Api\WCFWeb
{
	/**
	 * Nosotros short summary.
	 *
	 * Nosotros description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */


    use Api\Models\ServiceListResult as Listado;
    use Api\Models\ServiceItemResult as Item;
    use Api\Models\Nosotros_Cabecera;
    use Api\Models\Nosotros as N;
    use Api\Config\Setup as Data;
    use Api\Config\DataContext;
    use Api\Models\Beneficios;

	class Nosotros
	{
        public function LoadCabecera(){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/Nosotros_Cabecera.php");
            require_once("../../clases/Post.php");

            $result = new Item(false, "Error", null);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM header_nosotors";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $result->item = new Nosotros_Cabecera($row["Imagen"], $row["Descripcion"]);

                }
            }
            return $result;
        }

        public function LoadInformacion(){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/Nosotros.php");

            $result = new Item(false, "", null);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM nosotros";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $result->item = new N($row["Imagen"], $row["Texto"], '');
                }
            }
            return $result;
        }

        public function LoadBeneficios(){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Beneficios.php");

            $result = new Listado(false, '', null, 0, 0);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM beneficios ORDER BY Orden";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $post = new Beneficios($row["Icono"], $row["Texto"], $row["Orden"], $row["ID"]);
                    array_push($result->list, $post);
                }
            }
            return $result;
        }
	}
}