<?php
use Api\WCF\Nosotros;
require_once("../../wcf/admin/Nosotros.php");

switch($_GET['fun']){
    case 'SaveNosotros':
        $wcf = new Nosotros();
        echo json_encode($wcf->SaveNosotros());;
        break;
    case 'LoadNosotros':
        $wcf = new Nosotros();
        echo json_encode($wcf->LoadNosotros());
        break;
    case 'LoadBeneficios':
        $wcf = new Nosotros();
        echo json_encode($wcf->LoadBeneficios());
        break;
    case 'SaveBeneficios':
        $wcf = new Nosotros();
        echo json_encode($wcf->SaveBeneficios());
        break;
    case 'DeleteBeneficios':
        $wcf = new Nosotros();
        echo json_encode($wcf->DeleteBeneficios());
        break;
    case 'SortableBeneficios':
        $wcf = new Nosotros();
        echo json_encode($wcf->SortableBeneficios());
        break;
    case 'SaveHeader':
        $wcf = new Nosotros();
        echo json_encode($wcf->SaveHeader());
        break;
    case 'LoadHeader':
        $wcf = new Nosotros();
        echo json_encode($wcf->LoadHeader());
        break;
}

?>