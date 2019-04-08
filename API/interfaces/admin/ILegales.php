<?php
use Api\WCF\Legales;
require_once("../../wcf/admin/Legales.php");

switch($_GET['fun']){
    case 'SaveTerminosCondiciones':
        $wcf = new Legales();
        echo json_encode($wcf->SaveTerminosCondiciones());
        break;
    case 'LoadTerminosCondiciones':
        $wcf = new Legales();
        echo json_encode($wcf->LoadTerminosCondiciones());
        break;
}

?>