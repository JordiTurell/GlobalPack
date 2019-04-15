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
    case 'HomeProduct':
        $wcf = new Productos();
        echo json_encode($wcf->HomeProduct());
        break;
    case 'LoadProducto':
        $wcf = new Productos();
        echo json_encode($wcf->LoadProducto());
        break;
    case 'LoadProductoCategoria':
        $wcf = new Productos();
        echo json_encode($wcf->LoadProductoCategoria());
        break;
    case 'SetRelacionado':
        $wcf = new Productos();
        echo json_encode($wcf->SetRelacionado());
        break;
    case 'LoadProductoRelacionados':
        $wcf = new Productos();
        echo json_encode($wcf->LoadProductoRelacionados());
        break;
    case 'DeleteRelacionados':
        $wcf = new Productos();
        echo json_encode($wcf->DeleteRelacionados());
        break;
    case 'DeleteProducto':
        $wcf = new Productos();
        echo json_encode($wcf->DeleteProducto());
        break;
    case 'GetAllProducto':
        $wcf = new Productos();
        echo json_encode($wcf->GetAllProducto());
        break;
    case 'UpdateProduct':
        $wcf = new Productos();
        echo json_encode($wcf->UpdateProduct());
        break;
    case 'Duplicar':
        $wcf = new Productos();
        echo json_encode($wcf->Duplicar());
        break;
    case 'Filtrado':
        $wcf = new Productos();
        echo json_encode($wcf->Filtrado());
        break;
    case 'AsignarFiltroCategoria':
        $wcf = new Productos();
        echo json_encode($wcf->AsignarFiltroCategoria());
        break;
    case 'GetListFiltrosenCategorias':
        $wcf = new Productos();
        echo json_encode($wcf->GetListFiltrosenCategorias());
        break;
    case 'SortableCategoria':
        $wcf = new Productos();
        echo json_encode($wcf->SortableCategoria());
        break;
    case 'SortableSubCategoria':
        $wcf = new Productos();
        echo json_encode($wcf->SortableFiltres());
        break;
}

?>