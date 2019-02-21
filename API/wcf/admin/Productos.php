<?php

namespace Api\WCF
{
	/**
	 * Productos short summary.
	 *
	 * Productos description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */
    use Api\Models\ServiceItemResult as Result;
    use Api\Models\ServiceListResult as Listado;
    use Api\Config\Setup as Data;
    use Api\Config\Token;
    use Api\Config\DataContext;
    use Api\Models\Categoria;
    use Api\Models\Subcategoria;
    use Api\Models\Servicios;
    use Api\Models\Multimedia as Imagen;
    use Api\Models\Productos as Producto;

	class Productos
	{
        //Funciones de las categorias
        public function SaveCategoria(){
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

                    $query = '';
                    if($input["item"]["Id_Categoria"] == '00000000-0000-0000-0000-000000000000'){
                        $query = "INSERT INTO p_categorias (Id_Categoria, Categoria, Descripcion, Icono, Activada, FechaM) VALUES ('".$guid."', '".$input["item"]["Nombre"]."', '".$input["item"]["Descripcion"]."', '".$input["item"]["Icono"]."', 0, '".$date."')";
                    }else{
                        $query = "UPDATE p_categorias SET Categoria = '".$input["item"]["Nombre"]."', Descripcion = '".$input["item"]["Descripcion"]."', Icono = '".$input["item"]["Icono"]."', FechaM = '".$date."' WHERE Id_Categoria = '".$input["item"]["Id_Categoria"]."'";
                    }
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function LoadListCategorias(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Categoria.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
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

        public function ActiveCategorias(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Categoria.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", "");
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "UPDATE p_categorias SET Activada = ".$input["item"]["Activada"]." WHERE Id_Categoria = '".$input["item"]["Id_Categoria"]."'";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        //Funciones de las subcategorias
        public function LoadListSubCategorias(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Subcategoria.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
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

        public function SaveSubCategoria(){
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

                    $query = '';
                    if($input["item"]["Id_Subcategoria"] == '00000000-0000-0000-0000-000000000000'){
                        $query = "INSERT INTO p_subcategorias (Id_Subcategorias, Subcategoria, Descripcion, Icono, Activada, FechaM) VALUES ('".$guid."', '".$input["item"]["Nombre"]."', '".$input["item"]["Descripcion"]."', '".$input["item"]["Icono"]."', 0, '".$date."')";
                    }else{
                        $query = "UPDATE p_subcategorias SET Subcategoria = '".$input["item"]["Nombre"]."', Descripcion = '".$input["item"]["Descripcion"]."', Icono = '".$input["item"]["Icono"]."', FechaM = '".$date."' WHERE Id_Subcategorias = '".$input["item"]["Id_Subcategoria"]."'";
                    }
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function ActiveSubCategorias(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Categoria.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", "");
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "UPDATE p_subcategorias SET Activada = ".$input["item"]["Activada"]." WHERE Id_Subcategorias = '".$input["item"]["Id_Subcategoria"]."'";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        //Funciones de los Servicios del producto
        public function LoadListServicios(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Servicios.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM servicios";
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

        public function ActiveServicios(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Servicios.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", "");
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "UPDATE servicios SET Activada = ".$input["item"]["Activada"]." WHERE Id_Servicios = '".$input["item"]["Id_Servicios"]."'";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function SaveServicio(){
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

                    $query = '';
                    if($input["item"]["Id_Subcategoria"] == '00000000-0000-0000-0000-000000000000'){
                        $query = "INSERT INTO servicios (Id_Servicios, Nombre, Icono, Activada) VALUES ('".$guid."', '".$input["item"]["Nombre"]."', '".$input["item"]["Icono"]."', 0)";
                    }else{
                        $query = "UPDATE servicios SET Nombre = '".$input["item"]["Nombre"]."', Icono = '".$input["item"]["Icono"]."' WHERE Id_Servicios = '".$input["item"]["Id_Subcategoria"]."'";
                    }
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        //Multimedia Productes
        public function LoadFiles(){
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

                    $query = "SELECT Id_Multimedia, Url FROM p_multimedia order by ID";

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

        public function DeleteFile(){
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
                    $query = "SELECT * FROM p_multimedia_productos WHERE Id_Multimedia = '".$input["item"]["id"]."'";
                    if($res = mysqli_query($conn, $query)){
                        if(mysqli_num_rows($res) > 0){
                            $result->SetMsg("Dicho archivo se esta usando en un producto. Para eliminar dicho archivo elimina primero el producto.");
                        }else{
                            $select = "SELECT * FROM p_multimedia WHERE Id_Multimedia = '".$input["item"]["id"]."'";
                            if($res = mysqli_query($conn, $select)){
                                while($row = mysqli_fetch_assoc($res)){
                                    $url = explode("cms/", $row["Url"]);
                                    unlink($_SERVER["DOCUMENT_ROOT"]."/cms/".$url[1]);

                                }
                            }
                            $delete = "DELETE FROM p_multimedia WHERE Id_Multimedia = '".$input["item"]["id"]."'";
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

        //Ficha Productos
        public function SaveProduct(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input["item"] != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $date = date("Y-m-d H:i:s");
                    $guid = Data::GUID();
                    $item = $input["item"];

                    $query = "INSERT INTO productos (Id_Producto, Titulo, Descripcion, Video, Referencia, Comparativa, pdf, Ficha_Tecnica, FechaC, FechaM, Descripcio_min, Anogarantia, Ocasion, Habilitado, Titulo_Video, DEscripcion_Video) VALUES ('".$guid."', '".$item["Titulo"]."', '".$item["Descripcion"]."', '".$item["Video"]."', '".$item["Sage"]."', '".$item["Comparativa"]."', ' ', '".$item["Ficha_Tecnica"]."', '".$date."', '".$date."', '".$item["DescMin"]."', '".$item["Garantia"]."', 0, 0, '".$item["TituloVideo"]."', '".$item["DescVideo"]."')";

                    if($res = mysqli_query($conn, $query)){

                        foreach($item["imagenes"] as $img){

                            $imagen = "SELECT * FROM p_multimedia WHERE Url = '".$img."'";

                            if($r = mysqli_query($conn, $imagen)){
                                while($row = mysqli_fetch_assoc($r)){
                                    $query = "INSERT INTO p_multimedia_productos (Id_Multimedia, Id_Producto) VALUES ('".$row["Id_Multimedia"]."', '".$guid."')";
                                    mysqli_query($conn, $query);
                                }
                            }
                        }
                        foreach($item["categorias"] as $cat ){
                            $q = "INSERT INTO productos_categorias (Id_Producto, Id_Categoria) VALUES ('".$guid."', '".$cat["Id_Categoria"]."')";
                            mysqli_query($conn, $q);
                        }
                        foreach($item["filtres"] as $filtro ){
                            $q = "INSERT INTO productos_filtros (Id_Producto, Id_Filtro) VALUES ('".$guid."', '".$filtro["Id_Subcategoria"]."')";
                            mysqli_query($conn, $q);
                        }
                        foreach($item["serveis"] as $servei ){
                            $q = "INSERT INTO productos_servicio (Id_Servicio, Id_Producto) VALUES ('".$servei["Id_Servicios"]."', '".$guid."')";
                            mysqli_query($conn, $q);
                        }
                        $result->SetStatus(true);
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

        public function LoadListProductos(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $total = "SELECT * FROM productos";
                    if($res_total = mysqli_query($conn, $total)){
                        $result->total = mysqli_num_rows($res_total);
                    }
                    $query = "SELECT * FROM productos LIMIT ".$input["items"]." OFFSET ".$input["pagina"];
                    if($res = mysqli_query($conn, $query)){

                        while($row = mysqli_fetch_assoc($res)){
                            $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                            $cat->SetHome($row["Home"]);
                            $cat->SetId($row["Indice"]);
                            $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$cat->Id_Producto."' LIMIT 1";
                            if($r = mysqli_query($conn, $imagen)){
                                while($img = mysqli_fetch_assoc($r)){
                                    $cat->SetImage($img["Url"]);
                                }
                            }
                            $relacionados = "SELECT * FROM productos_relacionados WHERE Id_Producto = '".$cat->Id_Producto."'";
                            if($res_relacionados = mysqli_query($conn, $relacionados)){
                                $cat->SetCountRelacionados($res_relacionados->num_rows);
                            }
                            array_push($result->list, $cat);
                        }
                    }
                    mysqli_close($conn);
                    $result->pagina = $input["pagina"];
                    $result->items = $input["items"];
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function ActiveOcasion(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Servicios.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", "");
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "UPDATE productos SET Ocasion = ".$input["item"]["Ocasion"].", PVP = '".$input["item"]["PVP"]."', PVP_Ocasion = '".$input["item"]["PVPOcasion"]."' WHERE Id_Producto = '".$input["item"]["Id_Producto"]."'";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function ActiveProducto(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Servicios.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", "");
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "UPDATE productos SET Habilitado = ".$input["item"]["Habilitado"]." WHERE Id_Producto = '".$input["item"]["Id_Producto"]."'";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function Buscador(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 20, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM productos WHERE Titulo LIKE '%".$input["item"]."%' ORDER BY FechaC DESC";
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                            $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$cat->Id_Producto."' LIMIT 1";
                            if($r = mysqli_query($conn, $imagen)){
                                while($img = mysqli_fetch_assoc($r)){
                                    $cat->SetImage($img["Url"]);
                                }
                            }
                            array_push($result->list, $cat);
                        }
                    }
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function HomeProduct(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Servicios.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", "");
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $update = "UPDATE productos SET Home = 0";
                    mysqli_query($conn, $update);
                    $query = "UPDATE productos SET Home = ".$input["item"]["Home"]." WHERE Id_Producto = '".$input["item"]["Id_Producto"]."'";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function LoadProducto(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/ServiceItemResult.php");

            $result = new Result(false, "", "");
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM productos WHERE Id_Producto = '".$input["id"]."'";
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $producto = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                            $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$producto->Id_Producto."' LIMIT 1";
                            if($r = mysqli_query($conn, $imagen)){
                                while($img = mysqli_fetch_assoc($r)){
                                    $producto->SetImage($img["Url"]);
                                }
                            }
                            $result->item = $producto;
                        }
                    }
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function LoadProductoCategoria(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $query = "";
                    if($input["id"] != 0){
                        $query = "SELECT * FROM productos INNER JOIN productos_categorias ON productos.Id_Producto = productos_categorias.Id_Producto INNER JOIN productos_filtros ON productos.Id_Producto = productos_filtros.Id_Producto WHERE productos_categorias.Id_Categoria = '".$input["id"]."' AND productos.Habilitado = 1 GROUP BY productos.Indice";
                    }else{
                        $query = "SELECT * FROM productos INNER JOIN productos_categorias ON productos.Id_Producto = productos_categorias.Id_Producto group by productos.Id_Producto";
                    }

                    if($res = mysqli_query($conn, $query)){

                        while($row = mysqli_fetch_assoc($res)){
                            $cat = new Producto($row["Id_Producto"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                            $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$cat->Id_Producto."' LIMIT 1";
                            if($r = mysqli_query($conn, $imagen)){
                                while($img = mysqli_fetch_assoc($r)){
                                    $cat->SetImage($img["Url"]);
                                }
                            }
                            array_push($result->list, $cat);
                        }
                    }
                    mysqli_close($conn);
                    $result->pagina = $input["pagina"];
                    $result->items = $input["items"];
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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

        public function SetRelacionado(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");

            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $query = "SELECT * FROM productos_relacionados WHERE Id_Producto = '".$input["id"]."' AND Productos_Relacionados = '".$input["idProducto"]."'";
                    if($res = mysqli_query($conn, $query)){
                        if(mysqli_num_rows($res) == 0){
                            $query = "INSERT INTO productos_relacionados (Id_Producto, Productos_Relacionados) VALUES ('".$input["id"]."', '".$input["idProducto"]."')";
                            mysqli_query($conn, $query);
                            mysqli_close($conn);
                            return true;
                        }
                    }
                    mysqli_close($conn);
                    return false;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function DeleteRelacionados(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");

            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    $query = "DELETE FROM productos_relacionados WHERE Productos_Relacionados = '".$input["item"]["Id_Producto"]."' AND Id_Producto = '".$input["idficha"]."'";
                    mysqli_query($conn, $query);
                    mysqli_close($conn);
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function LoadProductoRelacionados(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/Productos.php");
            require_once("../../clases/ServiceListResult.php");

            $result = new Listado(false, "", 0, 0, 0);
            $input = json_decode(file_get_contents('php://input'), true);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){
                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM productos INNER JOIN productos_relacionados ON productos.Id_Producto = productos_relacionados.Productos_Relacionados";

                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $cat = new Producto($row["Productos_Relacionados"], $row["Titulo"], $row["FechaC"], $row["PVP"], $row["PVP_Ocasion"], $row["Ocasion"], $row["Habilitado"]);
                            $imagen = "SELECT Url FROM globalpack.p_multimedia inner join p_multimedia_productos on p_multimedia.Id_Multimedia = p_multimedia_productos.Id_Multimedia WHERE Id_Producto ='".$cat->Id_Producto."' LIMIT 1";
                            if($r = mysqli_query($conn, $imagen)){
                                while($img = mysqli_fetch_assoc($r)){
                                    $cat->SetImage($img["Url"]);
                                }
                            }
                            array_push($result->list, $cat);
                        }
                    }
                    mysqli_close($conn);
                    $result->pagina = $input["pagina"];
                    $result->items = $input["items"];
                    $result->SetStatus(true);
                    $result->SetMsg('SUCCESS');
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