<?php

namespace Api\WCF
{
	/**
	 * PostVenta short summary.
	 *
	 * PostVenta description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */

    use Api\Models\ServiceItemResult as Result;
    use Api\Models\ServiceListResult as Listado;
    use Api\Config\Setup as Data;
    use Api\Config\DataContext;
    use Api\Models\DescPostVenta;
    use Api\Models\Planes;

	class PostVenta
	{
        public function LoadDescripcion(){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/DescPostVenta.php");

            $result = new Result(false, "", null);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();
            $query = "SELECT * FROM postventa";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $result->item = new DescPostVenta($row["Id"], $row["Descripcion"]);
                }
            }
            $result->SetStatus(true);
            mysqli_close($conn);
            return $result;
        }

        public function LoadPlans(){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Planes.php");

            $result = new Listado(false, "", null, 0, 0);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();
            $query = "SELECT * FROM planes WHERE Habilitado = 1";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $planes = new Planes($row["Indice"], $row["Id_Plan"], $row["Titulo"], $row["Descripcion"], $row["Orden"], $row["FechaC"], $row["Habilitado"]);
                    $planes->SetColor($row["Color"]);
                    array_push($result->list, $planes);
                }
            }
            $result->SetStatus(true);
            mysqli_close($conn);
            return $result;
        }
	}
}