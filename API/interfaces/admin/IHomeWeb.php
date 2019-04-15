<?php

use Api\WCF\HomeWeb;
require_once("../../wcf/admin/HomeWeb.php");

switch($_GET['fun']){
    case 'LoadText':
        $wcf = new HomeWeb();
        echo json_encode($wcf->LoadText());
        break;
    case 'SaveText':
        $wcf = new HomeWeb();
        echo json_encode($wcf->SaveText());
        break;
    case 'SaveBox':
        $wcf = new HomeWeb();
        echo json_encode($wcf->SaveBox());
        break;
    case 'LoadBox':
        $wcf = new HomeWeb();
        echo json_encode($wcf->LoadBox());
        break;
}

?>