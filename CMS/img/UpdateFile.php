<?php

function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

session_start();
if(isset($_SESSION['SES'])){
    $ses = json_decode($_SESSION['SES']);
    try{
        if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
        {
            /* Location */
            switch($_GET['FOLDER']){
                case 'Blog':
                    UpdateFilesBlog('multimedia');
                    break;
                case 'Productos':
                    UpdateFilesBlog('p_multimedia');
                    break;
                case 'icon-categorias-productos':
                case 'icon-subcategoria-producte':
                case 'icon-servicios-productos':
                    UpdateFileFix();
                    break;
                default:
                    UpdateFile();
                    break;
            }

        }else{
            echo "Method no permitido";
        }
    }
    catch(Exception $ex){
        echo "Imagen muy pesada maximo: 2MB";
    }
}else{
    echo "error de sesión.";
}

function UpdateFile(){
    $filename =  $_FILES['file']['name'];
    $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/tmp/".$filename;

    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

    // Check image format
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    if($uploadOk == 0){
        echo 0;
    }else{
        /* Upload file */
        $filename = GUID().'.'.$imageFileType;
        $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/tmp/".$filename;

        array_map('unlink', glob($_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/tmp/".$filename));

        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/tmp/".$filename;
        }else{
            echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/tmp/".$filename;
        }
    }
}
function UpdateFileFix(){
    $filename =  $_FILES['file']['name'];
    $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

    // Check image format
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    if($uploadOk == 0){
        echo 0;
    }else{
        /* Upload file */
        if($_POST["edit"]){
            $filename = $_POST["nombre"].'.'.$imageFileType;
        }else{
            $filename = GUID().'.'.$imageFileType;
        }
        $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

        array_map('unlink', glob($_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename));

        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
        }else{
            echo "Error";
        }
    }
}
function UpdateFilesBlog($table){
    $filename =  $_FILES['file']['name'];
    $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

    // Check image format
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    if($uploadOk == 0){
        echo 0;
    }else{
        /* Upload file */
        $filename = GUID().'.'.$imageFileType;
        $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

        array_map('unlink', glob($_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename));

        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            require_once("../../api/Config/Config.php");
            require_once("../../api/Config/DataContext.php");

            $conn = new Api\Config\Setup(Api\Config\DataContext::Admin);
            $conn = $conn->Conect();
            $query = "INSERT INTO ".$table." (Id_Multimedia, Url) VALUES ('".Api\Config\Setup::GUID()."', '//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename."')";
            mysqli_query($conn, $query);
            mysqli_close($conn);
            echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
        }else{
            echo $location;
        }
    }
}

?>