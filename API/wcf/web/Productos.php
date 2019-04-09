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
    use Api\Models\ServiceItemResult as Result;
    use Api\Config\Setup as Data;
    use Api\Config\DataContext;
    use Api\Models\Categoria;
    use Api\Models\Productos as Producto;
    use Api\Models\Servicios;
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

            $query = "SELECT * FROM p_categorias ORDER BY FechaM";
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

        function LoadProductosPostVenta(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM productos INNER JOIN productos_filtros ON productos.Id_Producto = productos_filtros.Id_Producto INNER JOIN productos_categorias ON productos.Id_Producto = productos_categorias.Id_Producto WHERE productos_filtros.Id_Filtro = '".$input["uuid"]."' AND productos.Habilitado = 1 GROUP BY productos.Indice";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                    $cat->SetId($row["Indice"]);
                    $cat->SetDescripcionCorta($row["Descripcio_min"]);
                    $cat->SetSubCategoria($row["Id_Filtro"]);
                    $cat->SetDescripcion($row["Descripcion"]);
                    $cat->SetFichaTecnica($row["Ficha_Tecnica"]);
                    $cat->Setvideo($row["Video"], $row["Titulo_Video"], $row["Descripcion_Video"]);
                    $cat->SetComparativa($row["Comparativa"]);
                    $cat->SetCategoria($row["Id_Categoria"]);

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

        function LoadOcasion(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM productos WHERE Ocasion =  1 AND productos.Habilitado = 1";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                    $cat->SetId($row["Indice"]);
                    $cat->SetDescripcionCorta($row["Descripcio_min"]);
                    $cat->SetSubCategoria($row["Id_Filtro"]);
                    $cat->SetDescripcion($row["Descripcion"]);
                    $cat->SetFichaTecnica($row["Ficha_Tecnica"]);
                    $cat->Setvideo($row["Video"], $row["Titulo_Video"], $row["Descripcion_Video"]);
                    $cat->SetComparativa($row["Comparativa"]);
                    $cat->SetCategoria($row["Id_Categoria"]);
                    $cat->SetAnoGarantia($row["Anogarantia"]);

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

        function LoadFiltrosProductos(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Subcategoria.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);

            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM p_subcategorias WHERE Activada = 1 AND Consumible = 0 ORDER BY FechaM";
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

        function LoadFiltrosConsumibles($id){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Subcategoria.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);

            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM p_subcategorias INNER JOIN categorias_filtros ON categorias_filtros.Id_Filtro = p_subcategorias.Id_Subcategorias WHERE categorias_filtros.Id_Categoria = '".$id."' ORDER BY p_subcategorias.FechaM";
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

        function LoadCategoriasRelacionadasFiltrosProductos($id){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Subcategoria.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);

            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM p_categorias INNER JOIN categorias_filtros ON categorias_filtros.Id_Categoria = p_categorias.Id_Categoria WHERE categorias_filtros.Id_Filtro = '".$id."' ORDER BY p_categorias.FechaM";
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

            $query = "SELECT * FROM productos INNER JOIN productos_categorias ON productos.Id_Producto = productos_categorias.Id_Producto INNER JOIN productos_filtros ON productos.Id_Producto = productos_filtros.Id_Producto WHERE productos_categorias.Id_Categoria = '".$input["uuid"]."' AND productos.Habilitado = 1 GROUP BY productos.Indice ORDER BY productos.Titulo";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                    $cat->SetId($row["Indice"]);
                    $cat->SetDescripcionCorta($row["Descripcio_min"]);
                    $cat->SetSubCategoria($row["Id_Filtro"]);
                    $cat->SetDescripcion($row["Descripcion"]);
                    $cat->SetFichaTecnica($row["Ficha_Tecnica"]);
                    $cat->Setvideo($row["Video"], $row["Titulo_Video"], $row["Descripcion_Video"]);
                    $cat->SetComparativa($row["Comparativa"]);

                    $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$cat->Id_Producto."'";
                    if($r = mysqli_query($conn, $imagen)){
                        while($img = mysqli_fetch_assoc($r)){
                            $cat->SetImages($img["Url"]);
                        }
                    }
                    $query_servicios = "SELECT * FROM productos_servicio WHERE Id_Producto ='".$cat->Id_Producto."'";
                    if($res_servicios = mysqli_query($conn, $query_servicios)){
                        while($row_servicios = mysqli_fetch_assoc($res_servicios)){
                            $cat->SetAllServicio($row_servicios["Id_Servicio"]);
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

        function LoadProducto(){
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/Servicios.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);

            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM productos WHERE productos.Id_Producto = '".$input["uuid"]."' AND productos.Habilitado = 1";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                    $cat->SetId($row["Indice"]);
                    $cat->SetDescripcionCorta($row["Descripcio_min"]);
                    $cat->SetSubCategoria($row["Id_Filtro"]);
                    $cat->SetDescripcion($row["Descripcion"]);
                    $cat->SetFichaTecnica($row["Ficha_Tecnica"]);
                    $cat->Setvideo($row["Video"], $row["Titulo_Video"], $row["Descripcion_Video"]);
                    $cat->SetComparativa($row["Comparativa"]);
                    $cat->SetAnoGarantia($row["Anogarantia"]);
                    $cat->SetPdf($row["pdf"]);

                    $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$cat->Id_Producto."'";
                    if($r = mysqli_query($conn, $imagen)){
                        while($img = mysqli_fetch_assoc($r)){
                            $cat->SetImages($img["Url"]);
                        }
                    }

                    $relacionados = "SELECT * FROM productos INNER JOIN productos_relacionados ON productos.Id_Producto = productos_relacionados.Productos_Relacionados WHERE productos_relacionados.Id_Producto ='". $cat->Id_Producto ."'";

                    if($res = mysqli_query($conn, $relacionados)){
                        while($row = mysqli_fetch_assoc($res)){
                            $p = new Producto($row["Productos_Relacionados"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                            $p->SetId($row["Indice"]);
                            $p->SetDescripcionCorta($row["Descripcio_min"]);
                            $p->SetSubCategoria($row["Id_Filtro"]);
                            $p->SetDescripcion($row["Descripcion"]);
                            $p->SetFichaTecnica($row["Ficha_Tecnica"]);
                            $p->Setvideo($row["Video"], $row["Titulo_Video"], $row["Descripcion_Video"]);
                            $p->SetComparativa($row["Comparativa"]);
                            $p->SetAnoGarantia($row["Anogarantia"]);
                            $p->SetPdf($row["pdf"]);
                            $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$p->Id_Producto."' LIMIT 1";
                            if($r = mysqli_query($conn, $imagen)){
                                while($img = mysqli_fetch_assoc($r)){
                                    $p->SetImage($img["Url"]);
                                }
                            }
                            $cat->SetRelacionados($p);
                        }
                    }

                    $servicios = "SELECT * FROM servicios INNER JOIN productos_servicio ON servicios.Id_Servicios = productos_servicio.Id_Servicio WHERE productos_servicio.Id_Producto ='".$cat->Id_Producto."' AND servicios.Activada = 1";

                    if($res = mysqli_query($conn, $servicios)){
                        while($row = mysqli_fetch_assoc($res)){
                            $s = new Servicios($row["Id_Servicios"], $row["Nombre"], $row["Icono"], $row["Activada"]);
                            $cat->SetServicios($s);
                        }
                    }

                    $result->item = $cat;
                }
            }
            mysqli_close($conn);
            $result->SetStatus(true);
            $result->SetMsg('SUCCESS');
            return $result;
        }

        function LoadAllServicios(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Servicios.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);

            $config = new Data(DataContext::Admin);
            $conn = $config->Conect();

            $query = "SELECT * FROM servicios WHERE Activada = 1";
            if($res = mysqli_query($conn, $query)){
                while($row = mysqli_fetch_assoc($res)){
                    $cat = new Servicios($row["Id_Servicios"], $row["Nombre"], $row["Icono"], $row["Activada"]);
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