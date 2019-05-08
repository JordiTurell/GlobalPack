<?php
use Api\WCF\PostVenta;
require_once("../../wcf/admin/PostVenta.php");

switch($_GET['fun']){
    case 'SaveDescripcion':
        $wcf = new PostVenta();
        echo json_encode($wcf->SaveDescripcion());
        break;
    case 'LoadDescripcion':
        $wcf = new PostVenta();
        echo json_encode($wcf->LoadDescripcion());
        break;
    case 'SavePlan':
        $wcf = new PostVenta();
        echo json_encode($wcf->SavePlan());
        break;
    case 'LoadPlans':
        $wcf = new PostVenta();
        echo json_encode($wcf->LoadPlans());
        break;
    case 'HabilitarPlan':
        $wcf = new PostVenta();
        echo json_encode($wcf->HabilitarPlan());
        break;
    case 'DeletePlan':
        $wcf = new PostVenta();
        echo json_encode($wcf->DeletePlan());
        break;
    case 'EditPlan':
        $wcf = new PostVenta();
        echo json_encode($wcf->EditPlan());
        break;

}

?>