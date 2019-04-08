<?php

namespace Api\WCFWeb
{
	/**
	 * Legales short summary.
	 *
	 * Legales description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */
    use Api\Config\Setup as Data;
    use Api\Config\DataContext;
    use Api\Models\ServiceItemResult as Item;

	class Legales
	{
        public function LoadTerminosCondiciones($tipo){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Item(false, "Error", null);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM legales WHERE Tipo = ".$tipo;
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $result->item = $row["Text"];
                }
                mysqli_close($conn);
                $result->SetStatus(true);
            }
            return $result;
        }
	}
}