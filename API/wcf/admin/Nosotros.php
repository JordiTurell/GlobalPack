<?php

namespace Api\WCF
{
	/**
	 * Nosotros short summary.
	 *
	 * Nosotros description.
	 *
	 * @version 1.0
	 * @author Caperucitorojo
	 */

    use Api\Models\ServiceItemResult as Result;
    use Api\Models\ServiceListResult as Listado;
    use Api\Config\Setup as Data;
    use Api\Config\Token;
    use Api\Config\DataContext;
    use Api\Models\Nosotros as RequestNosotros;
    use Api\Models\Beneficios as RequestBeneficios;
    use Api\Models\Nosotros_Cabecera;

	class Nosotros
	{
        function __construct(){

        }

        function SaveNosotros(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    if($this->IsTemporal($input["item"]["img"], "Nosotros", true)){
                        $filename = explode('/', $input["item"]["img"]);

                        $filename = $_SERVER["HTTP_HOST"]."/cms/img/Nosotros/".$filename[count($filename)-1];
                        $query = "UPDATE nosotros Set Imagen = '".$filename."', Texto = '".$input["item"]["text"]."' Where Indice = 1";
                    }else{
                        $query = "UPDATE nosotros Set Texto = '".$input["item"]["text"]."' Where Indice = 1";
                    }
                    if($res = mysqli_query($conn, $query)){

                        mysqli_close($conn);

                        $result->SetStatus(true);
                        $result->SetMsg('SUCCESS');
                        return $result;
                    }else{
                        mysqli_close($conn);
                        $result->SetStatus(true);
                        $result->SetMsg('Error al guardar los cambios');
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

        function LoadNosotros(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/Nosotros.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM Nosotros Where Indice = 1";

                    if($res = mysqli_query($conn, $query)){
                        $item = null;
                        while($row = mysqli_fetch_assoc($res)){
                            $item = new RequestNosotros($row["Imagen"], $row["Texto"], null);
                        }
                        $result->SetStatus(true);
                        $result->SetMsg('SUCCESS');
                        $result->item = $item;

                        mysqli_close($conn);

                        return $result;
                    }else{
                        mysqli_close($conn);
                        $result->SetStatus(false);
                        $result->SetMsg('Error al guardar los cambios');
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

        function LoadBeneficios(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Beneficios.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Listado(false, '', null, 0, 0);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM beneficios order by Orden ASC";

                    if($res = mysqli_query($conn, $query)){
                        $item = null;
                        if(mysqli_num_rows($res) > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $item = new RequestBeneficios($row["Icono"], $row["Texto"], $row["Orden"], $row["ID"]);
                                array_push($result->list, $item);
                            }
                            $result->SetStatus(true);
                            $result->SetMsg('SUCCESS');
                            $result->item = $item;
                        }else{
                            $result->SetStatus(false);
                            $result->SetMsg('No hay beneficios creados.');
                        }

                        mysqli_close($conn);

                        return $result;
                    }else{
                        mysqli_close($conn);
                        $result->SetStatus(false);
                        $result->SetMsg('Error al guardar los cambios');
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

        function SortableBeneficios(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");
            require_once("../../clases/Beneficios.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Listado(false, '', null, 0, 0);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                      $query = "SELECT * FROM beneficios order by Orden Asc";
                      $normal_list = array();
                      if($res = mysqli_query($conn, $query)){
                          $item = null;
                          if(mysqli_num_rows($res) > 0){
                              while($row = mysqli_fetch_assoc($res)){
                                  $item = new RequestBeneficios($row["Icono"], $row["Texto"], $row["Orden"], $row["ID"]);
                                  array_push($normal_list, $item);
                              }
                              $query_orden = "SELECT Orden FROM beneficios order by Orden Desc Limit 1";
                              $orden = 0;
                              if($res = mysqli_query($conn, $query_orden)){
                                  while($row = mysqli_fetch_assoc($res)){
                                      $orden = $row["Orden"];
                                  }
                              }

                              if($input["newindex"] > $input["item"]["orden"]){
                                  $ascendent = true;
                              }else{
                                $ascendent = false;
                              }

                              for($a = 0; $a < count($normal_list); $a++){

                                  if(!$ascendent){
                                      if($normal_list[$a]->id != $input["item"]["id"]){
                                            if($input["newindex"] > $normal_list[$a]->orden){

                                            }else{
                                                if(!$normal_list[$a]->orden <= $input["item"]["orden"]){
                                                    $query = "UPDATE beneficios SET Orden = ".($normal_list[$a]->orden + 1)." WHERE ID = ".$normal_list[$a]->id;
                                                    mysqli_query($conn, $query);
                                                }
                                            }
                                      }else{
                                          $query = "UPDATE beneficios SET Orden = ".($input["newindex"])." WHERE ID = ".$input["item"]["id"];
                                          mysqli_query($conn, $query);
                                          break;
                                      }
                                  }else{
                                      if($normal_list[$a]->id != $input["item"]["id"]){
                                          if($normal_list[$a]->orden > $input["newindex"]){
                                              break;
                                          }else{
                                              if($input["item"]["orden"] == 0){
                                                  $query = "UPDATE beneficios SET Orden = ".($normal_list[$a]->orden - 1)." WHERE ID = ".$normal_list[$a]->id;
                                                  mysqli_query($conn, $query);
                                              }else{
                                                  if(!$normal_list[$a]->orden < $input["item"]["orden"]){
                                                      $query = "UPDATE beneficios SET Orden = ".($normal_list[$a]->orden - 1)." WHERE ID = ".$normal_list[$a]->id;
                                                      mysqli_query($conn, $query);
                                                  }
                                              }
                                          }
                                      }else{
                                          $query = "UPDATE beneficios SET Orden = ".($input["newindex"])." WHERE ID = ".$input["item"]["id"];
                                          mysqli_query($conn, $query);
                                      }
                                  }
                              }
                          }
                          mysqli_close($conn);
                      }

                    return $this->LoadBeneficios();
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

        function DeleteBeneficios(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Listado(false, '', null, 0, 0);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT Icono FROM beneficios WHERE ID = ". $input["item"];
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $url = $row["Icono"];
                            if($url != ""){
                                $url_split = explode("/", $url);
                                $delete = $_SERVER["DOCUMENT_ROOT"].$config::Barra_Server()."cms".$config::Barra_Server()."img".$config::Barra_Server()."Nosotros_Beneficios".$config::Barra_Server().$url_split[4];
                                unlink($delete);
                            }
                        }
                    }

                    $sortable = "SELECT * FROM beneficios WHERE ID = ".$input["item"];
                    if($res = mysqli_query($conn, $sortable)){
                        while($row = mysqli_fetch_assoc($res)){
                            $sortable = "SELECT * FROM beneficios WHERE Orden > ".$row["Orden"];
                            if($res = mysqli_query($conn, $sortable)){
                                while($row = mysqli_fetch_assoc($res)){
                                    $sortable = "UPDATE beneficios SET Orden = ".($row["Orden"] -1)." WHERE ID = ". $row["ID"];
                                    mysqli_query($conn, $sortable);
                                }
                            }
                        }
                    }
                    $q = "DELETE FROM beneficios WHERE ID =". $input["item"];
                    mysqli_query($conn, $q);
                    mysqli_close($conn);
                    return $this->LoadBeneficios();
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

        function SaveBeneficios(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceListResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Listado(false, '', null, 0, 0);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query_orden = "SELECT Orden FROM globalpack.beneficios order by Orden Desc Limit 1";
                    $orden = 0;
                    if($res = mysqli_query($conn, $query_orden)){
                        while($row = mysqli_fetch_assoc($res)){
                            $orden = $row["Orden"]+1;
                        }
                    };
                    //$query = "SELECT Orden beneficios Desc";
                    $query = "INSERT INTO beneficios (Texto, Orden, Icono) VALUES ('".$input["item"]["texto"]."', ".$orden.", '')";
                    if($res = mysqli_query($conn, $query)){
                        $id = mysqli_insert_id($conn);

                        if($this->IsTemporal($input["item"]["icono"], "Nosotros_Beneficios", false)){
                            $filename = explode('/', $input["item"]["icono"]);

                            $filename = $_SERVER["HTTP_HOST"]."/cms/img/Nosotros_Beneficios/".$filename[count($filename)-1];
                            $query = "UPDATE beneficios Set Icono = '".$filename."' Where ID = ".$id;
                            mysqli_query($conn, $query);
                        }
                    }
                    mysqli_close($conn);
                    return $this->LoadBeneficios();
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

        function SaveHeader(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();
                    if($this->IsTemporal($input["item"]["imagen"], "Nosotros_Header", true)){
                        $filename = explode('/', $input["item"]["imagen"]);

                        $filename = "//".$_SERVER["HTTP_HOST"]."/cms/img/Nosotros_Header/".$filename[count($filename)-1];
                        $query_insert = "SELECT * FROM header_nosotors WHERE Indice = 1";
                        $count = 0;
                        if($res = mysqli_query($conn, $query_insert)){
                            $count = $res->num_rows;
                        }
                        if($count != 1){
                            
                            $query = "INSERT INTO header_nosotors (Imagen, Descripcion) VALUES ('".$filename."', '".$input["item"]["texto"]."')";
                        }else{
                            $query = "UPDATE header_nosotors Set Imagen = '".$filename."', Descripcion = '".$input["item"]["texto"]."' Where Indice = 1";
                        }
                    }else{
                        $query = "UPDATE header_nosotors SET Descripcion = '".$input["item"]["texto"]."' Where Indice = 1";
                    }
                    if($res = mysqli_query($conn, $query)){

                        mysqli_close($conn);
                        $input["item"]["imagen"] = $filename;
                        $result->SetStatus(true);
                        $result->SetMsg('SUCCESS');
                        $result->item = $input["item"];
                        return $result;
                    }else{
                        mysqli_close($conn);
                        $result->SetStatus(true);
                        $result->SetMsg('Error al guardar los cambios');
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

        function LoadHeader(){
            require_once("../../Config/Token.php");
            require_once("../../Config/Config.php");
            require_once("../../Config/DataContext.php");
            require_once("../../clases/ServiceItemResult.php");
            require_once("../../clases/Nosotros_Cabecera.php");

            $input = json_decode(file_get_contents('php://input'), true);
            $result = new Result(false, "", null);
            if($input != null){
                if(Token::CheckTokenAdmin($input['token'])){

                    $config = new Data(DataContext::Admin);
                    $conn = $config->Conect();

                    $query = "SELECT * FROM header_nosotors";
                    if($res = mysqli_query($conn, $query)){
                        while($row = mysqli_fetch_assoc($res)){
                            $result->item = new Nosotros_Cabecera($row["Imagen"], $row["Descripcion"]);
                        }
                        mysqli_close($conn);
                        $result->SetStatus(true);
                        $result->SetMsg('SUCCESS');

                        return $result;
                    }else{
                        mysqli_close($conn);
                        $result->SetStatus(true);
                        $result->SetMsg('Error al guardar los cambios');
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

        function IsTemporal($url, $folder, $deletefolder){
            if($deletefolder){
                $tmp = explode('/tmp/', $url);
                if(count($tmp) > 1){
                    $filename = explode('/', $url);
                    $filename = $filename[count($filename)-1];


                    $files = glob($_SERVER["DOCUMENT_ROOT"]."/cms/img/".$folder."/*"); // get all file names
                    foreach($files as $file){ // iterate files
                        if(is_file($file))
                            unlink($file); // delete file
                    }
                    $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$folder."/".$filename;
                    rename($_SERVER["DOCUMENT_ROOT"].parse_url($url)["path"], $location);
                    return true;
                }else{
                    return false;
                }
            }else{
                $tmp = explode('/tmp/', $url);
                if(count($tmp) > 1){
                    $filename = explode('/', $url);
                    $filename = $filename[count($filename)-1];

                    $location = $_SERVER["DOCUMENT_ROOT"]."/cms/img/".$folder."/".$filename;
                    rename($_SERVER["DOCUMENT_ROOT"].parse_url($url)["path"], $location);
                    return true;
                }else{
                    return false;
                }
            }
        }
	}
}