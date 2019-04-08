<?php

namespace Api\WCF
{
	/**
	 * Legales short summary.
	 *
	 * Legales description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */

    use Api\Models\ServiceItemResult as Result;
    use Api\Config\Setup as Data;
    use Api\Config\Token;
    use Api\Config\DataContext;

	class Legales{

        public function LoadTerminosCondiciones(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT Text FROM Legales Where Tipo = ".$input["tipo"];

                    if($res = mysqli_query($conn, $query)){

                        while($row = mysqli_fetch_assoc($res)){
                            $result->item = $row["Text"];
                        }
                        $result->SetStatus(true);
                        $result->SetMsg('SUCCESS');
                        mysqli_close($conn);

                        return $result;
                    }else{
                        mysqli_close($conn);
                        $result->SetStatus(false);
                        $result->SetMsg($query);
                        return $result;
                    }
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

        public function SaveTerminosCondiciones(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $query = "UPDATE legales Set Text = '".$input["item"]["text"]."' Where Tipo = ".$input["item"]["tipo"];
                    if($res = mysqli_query($conn, $query)){
                        mysqli_close($conn);

                        $result->SetStatus(true);
                        $result->SetMsg('SUCCESS');
                        return $result;
                    }else{
                        mysqli_close($conn);
                        $result->SetStatus(true);
                        $result->SetMsg('Error al guardar los cambios');
                        return $result;
                    }
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