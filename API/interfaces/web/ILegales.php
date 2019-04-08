<?php
use Api\WCFWeb\Legales;
require_once("../../wcf/web/Legales.php");

switch($_GET['fun']){
    case 'LoadTerminosCondiciones':
        $wcf = new Legales();
        echo json_encode($wcf->LoadTerminosCondiciones(1));
        break;
    case 'LoadPoliticadeprivacidad':
        $wcf = new Legales();
        echo json_encode($wcf->LoadTerminosCondiciones(2));
        break;
    case 'LoadPoliticadeCoockies':
        $wcf = new Legales();
        echo json_encode($wcf->LoadTerminosCondiciones(3));
        break;
    case 'LoadInfomracionlegal':
        $wcf = new Legales();
        echo json_encode($wcf->LoadTerminosCondiciones(4));
        break;
}

?>