<?php
use Api\WCFWeb\Nosotros;
require_once("../../wcf/web/Nosotros.php");

switch($_GET['fun']){
    case 'LoadCabecera':
        $wcf = new Nosotros();
        echo json_encode($wcf->LoadCabecera());;
        break;
    case 'LoadInformacion':
        $wcf = new Nosotros();
        echo json_encode($wcf->LoadInformacion());
        break;
    case 'LoadBeneficios':
        $wcf = new Nosotros();
        echo json_encode($wcf->LoadBeneficios());
        break;
}

?>