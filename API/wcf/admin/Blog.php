<?php

namespace Api\WCF
{
	/**
	 * Blog short summary.
	 *
	 * Blog description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */

    use Api\Models\ServiceItemResult as Result;
    use Api\Models\ServiceListResult as Listado;
    use Api\Config\Setup as Data;
    use Api\Config\Token;
    use Api\Config\DataContext;
    use Api\Models\Multimedia as Imagen;
    use Api\Models\Post;

	class Blog
	{
        function __construct(){

        }

        function LoadFiles(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Multimedia.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Listado(false, '', null, 0, 0);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT Id_Multimedia, Url FROM multimedia order by ID";

                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $img = new Imagen($row["Id_Multimedia"], $row["Url"]);
                            array_push($result->list, $img);
                        }
                        mysqli_close($conn);
                        $result->SetStatus(true);
                        $result->SetMsg('');
                        return $result;
                    }else{
                        $result->SetStatus(false);
                        $result->SetMsg('No existen Imagenes');
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

        function SavePost(){
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
                    $guid = $config::GUID();

                    $query = "INSERT INTO blog (idBlog, Titulo, Descripcion, Descripcion_corta, FechaC, Video) VALUES ('".$guid."', '".$input["item"]["titulo"]."', '".$input["item"]["llarga"]."', '".$input["item"]["curta"]."', '".$date."', '".$input["item"]["url"]."')";
                    if($res = mysqli_query($conn, $query)){
                        foreach($input["item"]["img"] as $img){
                            $imagen = "SELECT Id_Multimedia FROM multimedia WHERE Url = '".$img."'";
                            if($res_img = mysqli_query($conn, $imagen)){
                                if(mysqli_num_rows($res_img) > 0){
                                    while($row = mysqli_fetch_assoc($res_img)){
                                        $insert = "INSERT INTO post_imagenes (Id_Post, Id_Multimedia) VALUES ('".$guid."', '".$row["Id_Multimedia"]."')";
                                        mysqli_query($conn, $insert);
                                    }
                                }
                            }
                        }
                        $result->SetStatus(true);
                    }else{
                        $result->SetMsg("Demasiado texto en la descripción corta, o falta campos por completar.");
                    }
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

        function DeleteFile(){
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
                    $query = "SELECT * FROM post_imagenes WHERE Id_Multimedia = '".$input["item"]["id"]."'";
                    if($res = mysqli_query($conn, $query)){
                        if(mysqli_num_rows($res) > 0){
                            $result->SetMsg("Dicho archivo se esta usando en un post del blog. Para eliminar dicho archivo elimina primero el post.");
                        }else{
                            $select = "SELECT * FROM multimedia WHERE Id_Multimedia = '".$input["item"]["id"]."'";
                            if($res = mysqli_query($conn, $select)){
                                while($row = mysqli_fetch_assoc($res)){
                                    $url = explode("cms/", $row["Url"]);
                                    unlink($_SERVER["DOCUMENT_ROOT"]."/cms/".$url[1]);

                                }
                            }
                            $delete = "DELETE FROM multimedia WHERE Id_Multimedia = '".$input["item"]["id"]."'";
                            mysqli_query($conn, $delete);
                            $result->SetStatus(true);
                        }
                    }
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

        function ListPosts(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Post.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Listado(false, '', null, 0, 0);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM blog order by FechaC DESC";

                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $post = new Post($row["idBlog"], $row["Titulo"], $row["Descripcion"], $row["Descripcion_corta"], $row["FechaC"], $row["Video"], $row["Activado"]);
                            array_push($result->list, $post);
                        }
                        mysqli_close($conn);
                        $result->SetStatus(true);
                        $result->SetMsg('');
                        return $result;
                    }else{
                        $result->SetStatus(false);
                        $result->SetMsg('No existen Posts');
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

        function ActivarPost(){
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
                    $query = "SELECT * FROM blog WHERE idBlog = '".$input["item"]["idBlog"]."'";
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            if($row["Activado"] == 1){
                                $update = "UPDATE blog SET Activado = 0 WHERE idBlog = '".$row["idBlog"]."'";
                                mysqli_query($conn, $update);
                            }else{
                                $update = "UPDATE blog SET Activado = 1 WHERE idBlog = '".$row["idBlog"]."'";
                                mysqli_query($conn, $update);
                            }
                        }
                    }

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

        function DeletePost(){
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
                    $query = "DELETE FROM blog WHERE idBlog = '".$input["item"]["idBlog"]."'";
                    if($res = mysqli_query($conn, $query)){
                        $imagenes = "DELETE FROM post_imagenes WHERE Id_Post = '".$input["item"]["idBlog"]."'";
                        mysqli_query($conn, $imagenes);
                    }

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

        function GetPost($id, $token){
            require_once("../../../api/Config/Token.php");
            require_once("../../../api/Config/Config.php");
            require_once("../../../api/Config/DataContext.php");
            require_once("../../../api/clases/Post.php");
            require_once("../../../api/clases/ServiceItemResult.php");

            $result = new Result(false, "", null);
            if($token != null){
                if(Token::CheckTokenAdmin($token)){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM blog WHERE idBlog = '".$id."'";
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $post = new Post($row["idBlog"], $row["Titulo"], $row["Descripcion"], $row["Descripcion_corta"], $row["FechaC"], $row["Video"], $row["Activado"]);
                            $query_img = "SELECT multimedia.Url FROM post_imagenes INNER JOIN multimedia ON post_imagenes.Id_Multimedia = multimedia.Id_Multimedia WHERE post_imagenes.Id_Post = '".$post->idBlog."';";
                            if($res = mysqli_query($conn, $query_img)){
                                while($row = mysqli_fetch_assoc($res)){
                                    $post->SetImages($row["Url"]);
                                }
                            }
                            $result->item = $post;
                        }
                    }
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

        function EditPost(){
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
                    $guid = $config::GUID();

                    $query = "UPDATE blog SET Titulo = '".$input["item"]["titulo"]."', Descripcion = '".$input["item"]["llarga"]."', Descripcion_corta = '".$input["item"]["curta"]."', FechaC = '".$date."', Video = '".$input["item"]["url"]."' WHERE idBlog = '".$input["item"]["idBlog"]."'";
                    if($res = mysqli_query($conn, $query)){

                        $Deleteimagen = "DELETE FROM post_imagenes WHERE Id_Post = '".$input["item"]["idBlog"]."'";
                        if($res_img = mysqli_query($conn, $Deleteimagen)){
                            foreach($input["item"]["img"] as $img){
                                $imagen = "SELECT Id_Multimedia FROM multimedia WHERE Url = '".$img."'";
                                if($res_img = mysqli_query($conn, $imagen)){
                                    while($row = mysqli_fetch_assoc($res_img)){
                                        $insert = "INSERT INTO post_imagenes (Id_Post, Id_Multimedia) VALUES ('".$input["item"]["idBlog"]."', '".$row["Id_Multimedia"]."')";
                                        mysqli_query($conn, $insert);
                                    }
                                }
                            }
                        }
                        
                        $result->SetStatus(true);
                    }else{
                        $result->SetMsg("Demasiado texto en la descripción corta, o falta campos por completar.");
                    }
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