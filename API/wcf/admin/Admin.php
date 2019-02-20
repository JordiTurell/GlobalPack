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
    use Api\Config\Setup as Data;
    use Api\Models\Administrador as Admin;
    use Api\Config\Token;
    use Api\Config\DataContext;


	class Admin
	{
        function __construct(){

        }

        function CreateAdmin(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);

            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

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

        function ListAdmin(){

        }
	}
}