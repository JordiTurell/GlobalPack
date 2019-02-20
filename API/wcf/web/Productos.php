<?php

namespace Api\WCFWeb
{
	/**
	 * Productos short summary.
	 *
	 * Productos description.
	 *
	 * @version 1.0
	 * @author Usuario
	 */

    use Api\Models\ServiceListResult as Listado;
    use Api\Config\Setup as Data;
    use Api\Config\DataContext;
    use Api\Models\Categoria;
    use Api\Models\Productos as Producto;
    use Api\Models\Subcategoria;

	class Productos
	{
        function LoadCategoriasProductos(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Categoria.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);

            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM p_categorias ORDER BY FechaM DESC";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Categoria($row["Id_Categoria"], $row["Categoria"], $row["Descripcion"], $row["Icono"], $row["Activada"]);
                    array_push($result->list, $cat);
                }
            }
            mysqli_close($conn);
            $result->SetStatus(true);
            $result->SetMsg('SUCCESS');
            return $result;
        }

        function LoadFiltrosProductos(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Subcategoria.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);

            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM p_subcategorias ORDER BY FechaM DESC";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Subcategoria($row["Id_Subcategorias"], '', $row["Subcategoria"], $row["Descripcion"], $row["Icono"], $row["Activada"]);
                    array_push($result->list, $cat);
                }
            }
            mysqli_close($conn);
            $result->SetStatus(true);
            $result->SetMsg('SUCCESS');
            return $result;
        }

        function LoadProductosCat(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM productos INNER JOIN productos_categorias ON productos.Id_Producto = productos_categorias.Id_Producto INNER JOIN productos_filtros ON productos.Id_Producto = productos_filtros.Id_Producto WHERE productos_categorias.Id_Categoria = '".$input["uuid"]."' AND productos.Habilitado = 1 GROUP BY productos.Indice";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                    $cat->SetId($row["Indice"]);
                    $cat->SetDescripcionCorta($row["Descripcio_min"]);
                    $cat->SetSubCategoria($row["Id_Filtro"]);
                    $cat->SetDescripcion($row["Descripcion"]);
                    $cat->SetFichaTecnica($row["Ficha_Tecnica"]);
                    $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$cat->Id_Producto."'";
                    if($r = mysqli_query($conn, $imagen)){
                        while($img = mysqli_fetch_assoc($r)){
                            $cat->SetImages($img["Url"]);
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
    }
}