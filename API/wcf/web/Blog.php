<?php

namespace Api\WCFWeb
{
	/**
	 * Blog short summary.
	 *
	 * Blog description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */

    use Api\Models\ServiceListResult as Listado;
    use Api\Models\ServiceItemResult as Result;
    use Api\Config\Setup as Data;
    use Api\Config\DataContext;
    use Api\Models\Post as Post;

    class Blog
	{
        function ListBlog(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Post.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM blog WHERE Activado = 1 ORDER By FechaC DESC";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Post($row["idBlog"], $row["Titulo"], $row["Descripcion"], $row["Descripcion_corta"], $row["FechaC"], $row["Video"], $row["Activado"] );

                    $imagen = "SELECT URL FROM multimedia INNER JOIN post_imagenes ON multimedia.Id_Multimedia = post_imagenes.Id_Multimedia INNER JOIN blog ON post_imagenes.Id_Post = blog.idBlog WHERE Id_Post ='".$cat->idBlog."'";
                    if($r = mysqli_query($conn, $imagen)){
                        while($img = mysqli_fetch_assoc($r)){
                            $cat->SetImages($img["URL"]);
                        }
                    }
                    array_push($result->list, $cat);
                }
            }
            mysqli_close($conn);
            $result->SetStatus(true);
            $result->SetMsg('SUCCESS');
            return $result;
        }

        function LoadPost(){

        }
	}
}