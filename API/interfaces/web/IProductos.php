<?php
use Api\WCFWeb\Productos;
require_once("../../wcf/web/Productos.php");

switch($_GET['fun']){
    case 'LoadCategoriasProductos':
        $wcf = new Productos();
        echo json_encode($wcf->LoadCategoriasProductos());
        break;
    case 'LoadFiltrosProductos':
        $wcf = new Productos();
        echo json_encode($wcf->LoadFiltrosProductos());
        break;
    case 'LoadProductosCat':
        $wcf = new Productos();
        echo json_encode($wcf->LoadProductosCat());
        break;
    case 'LoadProducto':
        $wcf = new Productos();
        echo json_encode($wcf->LoadProducto());
        break;
    case'LoadCategoriasOcasion':
        $wcf = new Productos();
        echo json_encode($wcf->LoadFiltrosProductos());
        break;
    case 'LoadProductosPostVenta':
        $wcf = new Productos();
        echo json_encode($wcf->LoadProductosPostVenta());
        break;
    case 'LoadOcasion':
        $wcf = new Productos();
        echo json_encode($wcf->LoadOcasion());
        break;
    case 'LoadFiltrosConsumibles':
        $wcf = new Productos();
        echo json_encode($wcf->LoadFiltrosConsumibles());
        break;
}

?>