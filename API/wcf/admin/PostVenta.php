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
    use Api\Config\Token;
    use Api\Config\DataContext;
    use Api\Models\DescPostVenta;
    use Api\Models\Planes;

	class PostVenta
	{
        public function LoadDescripcion(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/DescPostVenta.php");

            $result = new Result(false, "", null);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

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

        public function SaveDescripcion(){
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
                    $query = "UPDATE postventa SET Descripcion ='".$input["desc"]."' WHERE Id = 1";
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

        public function SavePlan(){
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
                    $query_count = "SELECT * FROM planes";
                    $count = 0;
                    if($res = mysqli_query($conn, $query_count)){
                        $count = mysqli_num_rows($res);
                    }
                    $query = "INSERT INTO planes (Id_Plan, Titulo, Descripcion, Orden, FechaC, Color) VALUES ('".Data::GUID()."', '".$input["titulo"]."', '".$input["desc"]."', '".$count."', '".$date."', '".$input["color"]."')";
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

        public function LoadPlans(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Planes.php");

            $result = new Listado(false, "", null, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $query = "SELECT * FROM planes";
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $plans = new Planes($row["Indice"], $row["Id_Plan"], $row["Titulo"], $row["Descripcion"], $row["Orden"], $row["FechaC"], $row["Habilitado"]);
                            $plans->SetColor($row["Color"]);
                            array_push($result->list, $plans);
                        }
                    }
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

        public function HabilitarPlan(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");

            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $query = "SELECT * FROM planes WHERE Indice = '".$input["item"]["Indice"]."'";
                    $Habilitado = 0;
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $Habilitado = $row["Habilitado"];
                            $update = "";
                            if($Habilitado == 0){
                                $update = "UPDATE planes SET Habilitado = 1 WHERE Indice ='". $row["Indice"]."'";
                            }else{
                                $update = "UPDATE planes SET Habilitado = 0 WHERE Indice ='". $row["Indice"]."'";
                            }
                            mysqli_query($conn, $update);
                        }
                    }
                    mysqli_close($conn);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function DeletePlan(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");

            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $query = "DELETE FROM planes WHERE Indice = '".$input["item"]["Indice"]."'";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function EditPlan(){
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
                    $query_count = "SELECT * FROM planes";
                    $count = 0;
                    if($res = mysqli_query($conn, $query_count)){
                        $count = mysqli_num_rows($res);
                    }
                    $query = "UPDATE planes SET Titulo = '".$input["titulo"]."', Descripcion = '".$input["desc"]."', Color = '".$input["color"]."' WHERE Id_Plan = '".$input["id"]."'";
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
	}
}