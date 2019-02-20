<?php
use Api\WCF\Productos;
require_once("../../wcf/admin/Productos.php");

switch($_GET['fun']){
    case 'SaveCategoria':
        $wcf = new Productos();
        echo json_encode($wcf->SaveCategoria());
        break;
    case 'LoadListCategorias':
        $wcf = new Productos();
        echo json_encode($wcf->LoadListCategorias());
        break;
    case 'ActiveCategorias':
        $wcf = new Productos();
        echo json_encode($wcf->ActiveCategorias());
        break;
    case 'LoadListSubCategorias':
        $wcf = new Productos();
        echo json_encode($wcf->LoadListSubCategorias());
        break;
    case 'ActiveSubCategorias':
        $wcf = new Productos();
        echo json_encode($wcf->ActiveSubCategorias());
        break;
    case 'SaveSubCategoria':
        $wcf = new Productos();
        echo json_encode($wcf->SaveSubCategoria());
        break;
    case 'LoadListServicios':
        $wcf = new Productos();
        echo json_encode($wcf->LoadListServicios());
        break;
    case 'ActiveServicios':
        $wcf = new Productos();
        echo json_encode($wcf->ActiveServicios());
        break;
    case 'SaveServicio':
        $wcf = new Productos();
        echo json_encode($wcf->SaveServicio());
        break;
    case 'LoadFiles':
        $wcf = new Productos();
        echo json_encode($wcf->LoadFiles());
        break;
    case 'DeleteFile':
        $wcf = new Productos();
        echo json_encode($wcf->DeleteFile());
        break;
    case 'SaveProduct':
        $wcf = new Productos();
        echo json_encode($wcf->SaveProduct());
        break;
    case 'LoadListProductos':
        $wcf = new Productos();
        echo json_encode($wcf->LoadListProductos());
        break;
    case 'ActiveOcasion':
        $wcf = new Productos();
        echo json_encode($wcf->ActiveOcasion());
        break;
    case 'ActiveProducto':
        $wcf = new Productos();
        echo json_encode($wcf->ActiveProducto());
        break;
    case 'Buscador':
        $wcf = new Productos();
        echo json_encode($wcf->Buscador());
        break;
}

?>