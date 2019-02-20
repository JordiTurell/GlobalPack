<?php
use Api\WCFWeb\Productos;
require_once("../../wcf/web/Productos.php");

switch($_GET['fun']){
    case 'LoadCategoriasProductos':
        $wcf = new Productos();
        echo json_encode($wcf->LoadCategoriasProductos());;
        break;
    case 'LoadFiltrosProductos':
        $wcf = new Productos();
        echo json_encode($wcf->LoadFiltrosProductos());;
        break;
    case 'LoadProductosCat':
        $wcf = new Productos();
        echo json_encode($wcf->LoadProductosCat());;
        break;
}

?>