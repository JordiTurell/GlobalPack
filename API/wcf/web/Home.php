<?php

namespace Api\WCFWeb
{
	/**
	 * Home short summary.
	 *
	 * Home description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */

    use Api\Models\ServiceItemResult as Result;
    use Api\Models\ServiceListResult as Listado;
    use Api\Models\Productos as Producto;
    use Api\Models\Post;
    use Api\Config\Setup as Data;
    use Api\Config\DataContext;
    use Api\Models\HomeText;
    use Api\Models\HomeBox;

	class Home
	{
        public function Loadblog(){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Post.php");

            $result = new Listado(false, '', null, 0, 0);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM blog ORDER BY FechaC DESC LIMIT 2";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $post = new Post($row["idBlog"], $row["Titulo"], $row["Descripcion"], $row["Descripcion_corta"], $row["FechaC"], $row["Video"], $row["Activado"]);
                    $img = "SELECT Url FROM globalpack.post_imagenes INNER JOIN multimedia ON multimedia.Id_Multimedia = post_imagenes.Id_Multimedia WHERE Id_post = '".$post->idBlog."' LIMIT 1;";
                    if($res_img = mysqli_query($conn, $img)){
                        while($row_img = mysqli_fetch_assoc($res_img)){
                            $post->SetImages($row_img["Url"]);
                        }
                    }
                    array_push($result->list, $post);
                }
            }
            return $result;
        }

        public function LoadOcasion(){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Productos.php");

            $result = new Listado(false, '', null, 0, 0);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM productos WHERE Ocasion = 1 AND Home = 1 And Habilitado = 1";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaM"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                    $cat->SetId($row["Indice"]);
                    $cat->SetDescripcionCorta($row["Descripcio_min"]);
                    $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$cat->Id_Producto."' LIMIT 1";
                    if($r = mysqli_query($conn, $imagen)){
                        while($img = mysqli_fetch_assoc($r)){
                            $cat->SetImage($img["Url"]);
                        }
                    }
                    array_push($result->list, $cat);
                }
            }
            return $result;
        }

        public function LoadText(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/HomeText.php");

            $result = new Result(false, "", null);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();
            $date = date("Y-m-d H:i:s");
            $guid = $config::GUID();

            $query = "SELECT * FROM texto_home_slider";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $text = new HomeText($row["Titulo"], $row["Descripcion"]);
                    $result->item = $text;
                    $result->SetStatus(true);
                }
            }
            mysqli_close($conn);
            return $result;
        }

        public function LoadBox(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/HomeBox.php");

            $result = new Listado(false, '', null, 0, 0);
            
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();
            $date = date("Y-m-d H:i:s");
            $guid = $config::GUID();

            $query = "SELECT * FROM cajas_home_slider ORDER BY Indice";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $text = new HomeBox($row["imagen"], $row["Nombre"], $row["Url"]);

                    array_push($result->list, $text);
                    $result->SetStatus(true);
                }
            }
            mysqli_close($conn);
            return $result;
        }
	}
}