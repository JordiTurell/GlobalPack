<?php

namespace Api\Config
{
	/**
	 * Token short summary.
	 *
	 * Token description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */

    use Firebase\JWT\JWT;
    use Exception;

	class Token
	{
        function __construct(){

        }

        private static $secret_key = 'nfgs574CXZ98jks@|€gfWSE786JBNf';
        private static $encrypt = array('HS256');
        private static $aud = null;

        public static function SignIn($data)
        {
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/BeforeValidException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/ExpiredException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/SignatureInvalidException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/JWT.php');

            $time = time();

            $token = array(
                'data' => $data
            );

            return JWT::encode($token, self::$secret_key);
        }

        public static function CheckTokenAdmin($token){
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/BeforeValidException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/ExpiredException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/SignatureInvalidException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/JWT.php');

            try{
                $decode = JWT::decode($token, Token::$secret_key, Token::$encrypt);
                
                //retornamos true si es usuario
                $config = new Setup(DataContext::Admin);
                $conn = $config->Conect();
                $query = "SELECT * FROM administradores WHERE Id_Usuario = '".$decode->data->ID."'";
                
                if($res = mysqli_query($conn, $query)){
                    if(mysqli_num_rows($res) > 0){
                        mysqli_close($conn);
                        return true;
                    }else{
                        mysqli_close($conn);
                        return false;
                    }
                }else{
                    mysqli_close($conn);
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function CheckTokenUser($token){
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/BeforeValidException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/ExpiredException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/SignatureInvalidException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/JWT.php');
            require_once('Config.php');

            try{
                $decode = JWT::decode($token, Token::$secret_key, Token::$encrypt);
                //retornamos true si es usuario
                $config = new Setup(DataContext::Usuarios);
                $conn = $config->Conect();
                $query = "SELECT * FROM usuarios WHERE IdUsuario = '".$decode->data->iduser."'";
                if($res = mysqli_query($conn, $query)){
                    if(mysqli_num_rows($res) > 0){
                        mysqli_close($conn);
                        return true;
                    }else{
                        mysqli_close($conn);
                        return false;
                    }
                }else{
                    mysqli_close($conn);
                }
            }
            catch(Exception $e){
                echo $e->getMessage();
                return false;
            }
            return false;
        }

        public static function Check($token)
        {
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/BeforeValidException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/ExpiredException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/SignatureInvalidException.php');
            require_once($_SERVER['DOCUMENT_ROOT'].'/api/vendor/firebase/php-jwt/src/JWT.php');

            if(empty($token))
            {
                throw new Exception("Invalid token supplied.");
            }

            try{
                $decode = JWT::decode($token, self::$secret_key, self::$encrypt);
            }
            catch(Exception $e){
                echo $e->getMessage();
            }

            if($decode->aud !== self::Aud())
            {
                throw new Exception("Invalid user logged in.");
            }
        }

        public static function GetData($token)
        {
            return JWT::decode(
                $token,
                self::$secret_key,
                self::$encrypt
            )->data;
        }

        private static function Aud()
        {
            $aud = '';

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $aud = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $aud = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $aud = $_SERVER['REMOTE_ADDR'];
            }

            $aud .= @$_SERVER['HTTP_USER_AGENT'];
            $aud .= gethostname();

            return sha1($aud);
        }
	}
}