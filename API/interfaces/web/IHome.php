<?php
use Api\WCFWeb\Home;
require_once("../../wcf/web/Home.php");

switch($_GET['fun']){
    case 'Loadblog':
        $wcf = new Home();
        echo json_encode($wcf->Loadblog());;
        break;
    case 'LoadOcasion':
        $wcf = new Home();
        echo json_encode($wcf->LoadOcasion());
        break;
    case 'LoadBox':
        $wcf = new Home();
        echo json_encode($wcf->LoadBox());
        break;
    case 'LoadText':
        $wcf = new Home();
        echo json_encode($wcf->LoadText());
        break;
}

?>