<?php

namespace Api\Config
{
	/**
	 * Config short summary.
	 *
	 * Config description.
	 *
	 * @version 1.0
	 * @author Jordi Turell Nebot
	 */
    use mysqli;

	class Setup
	{
        public $host_name;
        public $database;
        public $user_name;
        public $password;
        public $local = true;

        function __construct($db){
            if($this->local){
                $this->host_name = 'localhost';
                $this->database = $db;
                $this->user_name = 'root';
                $this->password = 'sawamura1984';
            }else{
                $this->host_name = 'localhost';
                $this->database = $db;
                $this->user_name = 'globalpack';
                $this->password = 'Kjhldfs74532hf@';
            }
        }

        function Conect(){
            if($this->local){
                $connect = new mysqli($this->host_name, $this->user_name, $this->password, $this->database);
                return $connect;
            }else{
                $connect = mysqli_connect($this->host_name, $this->user_name, $this->password, $this->database);
                return $connect;
            }
        }

        public static function Barra_Server(){
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                return "\\";
            } else {
                return "/";
            }
        }

        public static function GUID()
        {
            if (function_exists('com_create_guid') === true)
            {
                return trim(com_create_guid(), '{}');
            }

            return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        }
	}
}