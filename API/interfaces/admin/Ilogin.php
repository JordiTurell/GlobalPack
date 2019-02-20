<?php
use Api\WCF\Login;
require_once("../../wcf/admin/Login.php");

switch($_GET['fun']){
    case 'LoginCMS':
        $wcf = new Login();
        echo json_encode($wcf->LoginAdmin());
        break;
}

?>