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
                case 'PDF':
                    UpdatePDF();
                    break;
                case 'icon-slider-home':
                    UpdateFileHomeSlider();
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

function UpdatePDF(){
    if($_POST["idProducto"] == ''){

        $filename =  $_FILES['file']['name'];
        $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

        // Check image format
        if($imageFileType != "pdf") {
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
                $query = "INSERT INTO pdfs (Id_PDF, Ruta) VALUES ('".Api\Config\Setup::GUID()."', '//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename."')";
                mysqli_query($conn, $query);
                mysqli_close($conn);
                echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
            }else{
                echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
            }
        }
    }else{
        //Machacar Archivo
        require_once("../../api/Config/Config.php");
        require_once("../../api/Config/DataContext.php");

        $conn = new Api\Config\Setup(Api\Config\DataContext::Admin);
        $conn = $conn->Conect();
        $query = "SELECT pdf FROM productos WHERE Id_Producto = '".$_POST["idProducto"]."'";
        if($res = mysqli_query($conn, $query)){
            while($row = mysqli_fetch_assoc($res)){
                $url = $row["pdf"];
                if($url == ""){
                    $id = $_POST["idProducto"];
                    $filename =  $_FILES['file']['name'];
                    $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

                    $uploadOk = 1;
                    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

                    // Check image format
                    if($imageFileType != "pdf") {
                        $uploadOk = 0;
                    }

                    if($uploadOk == 0){
                        echo 0;
                    }else{
                        $filename = $id.'.'.$imageFileType;
                        $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

                        array_map('unlink', glob($_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename));

                        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                            require_once("../../api/Config/Config.php");
                            require_once("../../api/Config/DataContext.php");

                            $conn = new Api\Config\Setup(Api\Config\DataContext::Admin);
                            $conn = $conn->Conect();
                            $query = "INSERT INTO pdfs (Id_PDF, Ruta) VALUES ('".Api\Config\Setup::GUID()."', '//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename."')";
                            mysqli_query($conn, $query);
                            $query_updateproducto = "UPDATE productos SET PDF = '//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename."' WHERE Id_Producto = '".$_POST["idProducto"]."'";
                            mysqli_query($conn, $query_updateproducto);
                            mysqli_close($conn);
                            echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
                        }else{
                            echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
                        }
                    }
                }else{
                    $query_pdf = "SELECT * FROM pdfs WHERE Ruta = '".$url."'";
                    if($res_pdf = mysqli_query($conn, $query_pdf)){
                        while($row_pdf = mysqli_fetch_assoc($res_pdf)){
                            $id = $row_pdf["Id_PDF"];
                            $filename =  $_FILES['file']['name'];
                            $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

                            $uploadOk = 1;
                            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

                            // Check image format
                            if($imageFileType != "pdf") {
                                $uploadOk = 0;
                            }

                            if($uploadOk == 0){
                                echo 0;
                            }else{
                                $filename = $id.'.'.$imageFileType;
                                $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

                                array_map('unlink', glob($_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename));

                                if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                                    require_once("../../api/Config/Config.php");
                                    require_once("../../api/Config/DataContext.php");

                                    $conn = new Api\Config\Setup(Api\Config\DataContext::Admin);
                                    $conn = $conn->Conect();
                                    $query = "UPDATE pdfs SET Ruta = '//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename."' WHERE Id_PDF = '".$id."'";
                                    mysqli_query($conn, $query);
                                    $query_updateproducto = "UPDATE productos SET PDF = '//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename."' WHERE Id_Producto = '".$_POST["idProducto"]."'";
                                    mysqli_query($conn, $query_updateproducto);
                                    mysqli_close($conn);
                                    echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
                                }else{
                                    echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
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

function UpdateFileHomeSlider(){
    $filename = $_FILES['file']['name'];
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
        
        $filename = $_POST["box"].'.'.$imageFileType;
        $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename;

        array_map('unlink', glob($_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$filename));

        if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
            echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
        }else{
            echo "Error";
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
    $fileName =  $_FILES['file']['name'];
    $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$_GET['FOLDER']."/".$fileName;

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
            $query = "INSERT INTO ".$table." (Id_Multimedia, Url, Nombre_Fichero) VALUES ('".Api\Config\Setup::GUID()."', '//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename."', '".$fileName."')";
            mysqli_query($conn, $query);
            mysqli_close($conn);
            echo "//".$_SERVER['HTTP_HOST']."/cms/img/".$_GET['FOLDER']."/".$filename;
        }else{
            echo $location;
        }
    }
}

?>