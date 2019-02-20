<?php
use Api\WCF\WcfAdmin;
require_once("../../wcf/admin/WcfAdmin.php");

switch($_GET['fun']){
    case 'CreateAdmin':
        $wcf = new WcfAdmin();
        echo json_encode($wcf->CreateAdmin());;
        break;
    case 'ListAdmin':
        $wcf = new WcfAdmin();
        echo json_encode($wcf->ListAdmin());
        break;
    case 'ActiveAdmin':
        $wcf = new WcfAdmin();
        $success = $wcf->ActiveAdmin();
        echo json_encode(array("success" => (bool)$success));
        break;
        
}

?>