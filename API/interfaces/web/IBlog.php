<?php
use Api\WCFWeb\Blog;
require_once("../../wcf/web/Blog.php");

switch($_GET['fun']){
    case 'ListBlog':
        $wcf = new Blog();
        echo json_encode($wcf->ListBlog());;
        break;
    case 'LoadPost':
        $wcf = new Blog();
        echo json_encode($wcf->LoadPost());
        break;
}

?>