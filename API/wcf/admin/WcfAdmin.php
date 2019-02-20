<?php

namespace Api\WCF
{
	/**
	 * Admin short summary.
	 *
	 * Admin description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */

    use Api\Models\ServiceItemResult as Result;
    use Api\Models\ServiceListResult as ListResult;
    use Api\Config\Setup as Data;
    use Api\Models\Administrador as Admin;
    use Api\Models\InfoAdmin as InfoAdmin;
    use Api\Config\Token;
    use Api\Config\DataContext;


	class WcfAdmin
	{
        function __construct(){

        }

        function CreateAdmin(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $guid = Data::GUID();
                    $date = date("Y-m-d H:i:s");
                    $pass = hash('sha256', $input["item"]["login"]. $input["item"]["contrasenya"]);

                    if(!$this->ExistAdmin($input["item"]["login"])){
                        $query = "INSERT INTO administradores (Id_Usuario, Login, Password, FechaC) VALUES('".$guid."','".$input["item"]["login"]."','".$pass."','".$date."')";
                        $config = new Data(DataContext::Admin);
                        $conn = $config->Conect();
                        if($res = mysqli_query($conn, $query)){
                            $query = "INSERT INTO info_administradores (Id_Usuario, Nombre, Apellidos, Telefono) VALUES('".$guid."','".$input["item"]["Nombre"]."','".$input["item"]["Apellidos"]."','".$input["item"]["Telefono"]."')";
                            if($res = mysqli_query($conn, $query)){
                                $result->SetStatus(true);
                                mysqli_close($conn);
                                return $result;
                            }else{
                                $result->SetStatus(false);
                                mysqli_close($conn);
                                return $result;
                            }
                        }else{
                            mysqli_close($conn);
                            $result->SetStatus(true);
                            return $result;
                        }
                    }else{
                        $result->SetStatus(false);
                        $result->SetMsg('El administrador '.$input["item"]["login"].' ya existe en la base de datos.');
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

        private function ExistAdmin($login){
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();
            $query = "SELECT * FROM administradores WHERE Login ='".$login."'";
            if($res = mysqli_query($conn, $query)){
                $rowcount=mysqli_num_rows($res);
                if($rowcount > 0){
                    mysqli_close($conn);
                    return true;
                }else{
                    mysqli_close($conn);
                    return false;
                }
            }else{
                mysqli_close($conn);
                return false;
            }
        }

        function ListAdmin(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Administrador.php");
            require_once("../../clases/InfoAdmin.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $query = "SELECT * FROM administradores INNER JOIN info_administradores ON administradores.Id_Usuario = info_administradores.Id_Usuario LIMIT ".$input["items"]." OFFSET ".$input["pagina"];
                        $config = new Data(DataContext::Admin);
                        $conn = $config->Conect();
                        $result = new ListResult(false, '', 0, 0, 0);
                        if($res = mysqli_query($conn, $query)){
                            while($row = mysqli_fetch_assoc($res)){
                                $admin = new Admin($row["Indice"], $row["Id_Usuario"], $row["Login"], '', new InfoAdmin($row["Nombre"], $row["Apellidos"], $row["Telefono"]), boolval($row["Habilitado"]) ? true : false);
                                array_push($result->list, $admin);
                            }
                            $query_count = "SELECT COUNT(*) FROM administradores INNER JOIN info_administradores ON administradores.Id_Usuario = info_administradores.Id_Usuario";
                            if($res = mysqli_query($conn, $query_count)){
                                while($row = mysqli_fetch_assoc($res)){
                                    $result->total = (int)$row["COUNT(*)"];
                                }
                            }
                            mysqli_close($conn);
                            $result->items = $input["items"];
                            $result->pagina = $input["pagina"];
                            return $result;
                        }else{
                            mysqli_close($conn);
                            return $result;
                        }
                }else{
                    return $result;
                }
            }else{
                return $result;
            }
        }

        function ActiveAdmin(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $query = "SELECT * FROM administradores WHERE Id_Usuario = '".$input["item"]["ID"]."'";
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            if(boolval($row["Habilitado"]) ? true : false){
                                $update = "UPDATE administradores SET Habilitado = 0 WHERE Id_Usuario = '".$row["Id_Usuario"]."'";
                                if($res = mysqli_query($conn, $update)){
                                    mysqli_close($conn);
                                    return true;
                                }
                            }else{
                                $update = "UPDATE administradores SET Habilitado = 1 WHERE Id_Usuario = '".$row["Id_Usuario"]."'";
                                if($res = mysqli_query($conn, $update)){
                                    mysqli_close($conn);
                                    return true;
                                }
                            }
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
	}
}