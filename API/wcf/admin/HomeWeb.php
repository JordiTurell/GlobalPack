<?php

namespace Api\WCF
{
	/**
	 * HomeWeb short summary.
	 *
	 * HomeWeb description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */

    use Api\Models\ServiceItemResult as Result;
    use Api\Models\ServiceListResult as Listado;
    use Api\Config\Setup as Data;
    use Api\Config\Token;
    use Api\Config\DataContext;
    use Api\Models\HomeText;
    use Api\Models\HomeBox;

	class HomeWeb
	{
        public function LoadText(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/HomeText.php");

            $result = new Result(false, "", null);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $date = date("Y-m-d H:i:s");
                    $guid = $config::GUID();

                    $query = "SELECT * FROM texto_home_slider";
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $text = new HomeText($row["Titulo"], $row["Descripcion"]);
                            $result->item = $text;
                            $result->SetStatus(true);
                        }
                    }
                    mysqli_close($conn);
                    return $result;
                }else{
                    $result->SetStatus(false);
                    $result->SetMsg('Error de identificación');
                    return $result;
                }
            }else{
                $result->SetStatus(false);
                $result->SetMsg('Error de identificación');
                return $result;
            }
        }

        public function SaveText(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", null);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $date = date("Y-m-d H:i:s");
                    $guid = $config::GUID();

                    $query = "UPDATE texto_home_slider SET Titulo = '".$input["titulo"]."', Descripcion = '".$input["descripcio"]."' WHERE idtexto_home_slider = 1";
                    mysqli_query($conn, $query);
                    $result->SetStatus(true);
                    mysqli_close($conn);
                    return $result;
                }else{
                    $result->SetStatus(false);
                    $result->SetMsg('Error de identificación');
                    return $result;
                }
            }else{
                $result->SetStatus(false);
                $result->SetMsg('Error de identificación');
                return $result;
            }
        }

        public function SaveBox(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", null);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $date = date("Y-m-d H:i:s");
                    $guid = $config::GUID();

                    $query = "UPDATE cajas_home_slider SET imagen = '".$input["ico"]."', Nombre = '".$input["name"]."', Url = '".$input["direccion"]."' WHERE Indice = ".$input["id"];
                    mysqli_query($conn, $query);
                    $result->SetStatus(true);
                    mysqli_close($conn);
                    return $result;
                }else{
                    $result->SetStatus(false);
                    $result->SetMsg('Error de identificación');
                    return $result;
                }
            }else{
                $result->SetStatus(false);
                $result->SetMsg('Error de identificación');
                return $result;
            }
        }

        public function LoadBox(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/HomeBox.php");

            $result = new Listado(false, '', null, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $date = date("Y-m-d H:i:s");
                    $guid = $config::GUID();

                    $query = "SELECT * FROM cajas_home_slider";
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $text = new HomeBox($row["imagen"], $row["Nombre"], $row["Url"]);

                            array_push($result->list, $text);
                            $result->SetStatus(true);
                        }
                    }
                    mysqli_close($conn);
                    return $result;
                }else{
                    $result->SetStatus(false);
                    $result->SetMsg('Error de identificación');
                    return $result;
                }
            }else{
                $result->SetStatus(false);
                $result->SetMsg('Error de identificación');
                return $result;
            }
        }
	}
}