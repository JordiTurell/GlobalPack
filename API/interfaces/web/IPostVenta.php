<?php
use Api\WCF\PostVenta;
require_once("../../wcf/web/PostVenta.php");

switch($_GET['fun']){
    case 'LoadDescripcion':
        $wcf = new PostVenta();
        echo json_encode($wcf->LoadDescripcion());
        break;
    case 'LoadPlans':
        $wcf = new PostVenta();
        echo json_encode($wcf->LoadPlans());
        break;
}

?>