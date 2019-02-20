<?php

namespace Api\WCF
{
	/**
	 * Login short summary.
	 *
	 * Login description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */

    use Api\Models\ServiceItemResult as Result;
    use Api\Config\Setup as Data;
    use Api\Models\Administrador as Admin;
    use Api\Config\Token;
    use Api\Config\DataContext;
    use Api\Models\InfoAdmin;

	class Login
	{
        function __construct(){

        }

        public function LoginAdmin(){

           require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/Administrador.php");
            require_once("../../clases/InfoAdmin.php");

            $result = new Result(false, "", null);
            $input = json_decode(file_get_contents('php://input'), true);

            if($input != null){
                session_start();
                $conf = new Data(DataContext::Admin);
                $conn = $conf->Conect();

                $pass = hash('sha256', $input['adminuser']. $input['adminpass']);
                $date = date('Y-m-d H:i:s');
                $query = "SELECT * FROM administradores INNER JOIN info_administradores ON administradores.Id_Usuario = info_administradores.Id_Usuario WHERE Login = '".$input['adminuser']."' AND Password = '".$pass."' AND Habilitado = 1";

                if($res = mysqli_query($conn, $query)){
                    while($row = mysqli_fetch_assoc($res)){
                        $info = new InfoAdmin($row["Nombre"], $row["Apellidos"], $row["Telefono"]);
                        $admin = new Admin($row["Indice"], $row['Id_Usuario'], $row['Login'], $row["FechaC"], $info, $row["Habilitado"]);

                        $t = Token::SignIn($admin);

                        $result->item = $admin;
                        $result->token = $t;
                        $result->status = true;
                        $result->msg = 'SUCCESS';
                    }
                    mysqli_close($conn);
                    $_SESSION['SES'] = json_encode($result);
                    return $result;
                }
                mysqli_close($conn);
                $result->SetStatus(false);
                $result->SetMsg('Error de identificación');
                return $result;
            }else{
                $result->SetStatus(false);
                $result->SetMsg('Error de identificación');
                return $result;
            }

        }

        public function LoginComercio(){
            require_once("../../config/Token.php");
            require_once("../../config/Config.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/Administrador.php");

            $result = new Result(false, "", null);
            $input = json_decode(file_get_contents('php://input'), true);

            if($input != null){
                session_start();
                //if(Token::CheckToken($input['token'])){}
                $conf = new Data(DataContext::Empresas);
                $conn = $conf->Conect();

                $pass = hash('sha256', $input['adminuser']. $input['adminpass']);

                $query = "SELECT * FROM usuarios WHERE Login = '".$input['adminuser']."' AND Password = '".$pass."'";

                if($res = mysqli_query($conn, $query)){
                    while($row = mysqli_fetch_assoc($res)){
                        $admin = new User($row['IdAdmin'], $row['Login'], $row['Password']);
                        $t = Token::SignIn($admin);
                        $result->item = $admin;
                        $result->token = $t;
                        $result->status = true;
                        $result->msg = 'SUCCESS';
                    }
                    mysqli_close($conn);
                    $_SESSION['SES'] = json_encode($result);
                    return $result;
                }
                mysqli_close($conn);
                $result->SetStatus(false);
                $result->SetMsg('Error de identificación');
                return $result;
            }else{
                $result->SetStatus(false);
                $result->SetMsg('Error de identificación');
                return $result;
            }

        }
	}
}