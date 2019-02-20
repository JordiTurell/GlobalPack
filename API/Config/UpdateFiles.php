<?php

namespace Api\Config{

    /**
     * UpdateFiles short summary.
     *
     * UpdateFiles description.
     *
     * @version 1.0
     * @author Caperucitorojo
     */

    use Api\Config\Setup as Setup;

    class UpdateFiles
    {
        public $img = '';
        public $filename = '';
        private $location = '';
        private $guid = "00000000-0000-0000-0000-000000000000";
        private $file = null;

        function __construct($filename, $file, $fun){
            $this->filename = $filename;
            $this->file = $file;

            switch($fun){
                case 'Post_Blog_Min':
                    $this->img = $this->Creating_Post_Blog_Min($filename);
                    break;
            }
        }

        function Creating_Post_Blog_Min($filename){
                    if($this->location === ""){
                        $this->createfolder($this->guid);
                    }
            //        /* Location */
                    $this->location = $_SERVER["DOCUMENT_ROOT"]."/updates/img/".$this->guid."/".$this->filename;
                    $uploadOk = 1;
                    $imageFileType = pathinfo($this->location, PATHINFO_EXTENSION);

            //        // Check image format
                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                        $uploadOk = 0;
                    }

                    if($uploadOk == 0){
                        echo 0;
                    }else{
            //            /* Upload file */
                        array_map('unlink', glob($_SERVER["DOCUMENT_ROOT"]."/updates/img/*"));

                        if(move_uploaded_file($this->file, $this->location)){
                            echo "//".$_SERVER['HTTP_HOST']."/updates/img/".$this->guid."/".$this->filename;
                        }else{
                            echo 0;
                        }
                    }

        }
        function createfolder($g){
            if($g === "00000000-0000-0000-0000-000000000000"){
                require_once("Config.php");
                $this->guid = Setup::GUID();
            }
            if (!file_exists($_SERVER["DOCUMENT_ROOT"].'/updates/img/'.$this->guid)) {
                mkdir($_SERVER["DOCUMENT_ROOT"].'/updates/img/'.$this->guid, 0777, true);
            }
        }
    }
}