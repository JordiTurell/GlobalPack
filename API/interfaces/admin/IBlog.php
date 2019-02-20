<?php

use Api\WCF\Blog;
require_once("../../wcf/admin/Blog.php");

switch($_GET['fun']){
    case 'LoadFiles':
        $wcf = new Blog();
        echo json_encode($wcf->LoadFiles());
        break;
    case 'SavePost':
        $wcf = new Blog();
        echo json_encode($wcf->SavePost());
        break;
    case 'DeleteFile':
        $wcf = new Blog();
        echo json_encode($wcf->DeleteFile());
        break;
    case 'ListPosts':
        $wcf = new Blog();
        echo json_encode($wcf->ListPosts());
        break;
    case 'ActivarPost':
        $wcf = new Blog();
        echo json_encode($wcf->ActivarPost());
        break;
    case 'DeletePost':
        $wcf = new Blog();
        echo json_encode($wcf->DeletePost());
        break;
    case 'EditPost':
        $wcf = new Blog();
        echo json_encode($wcf->EditPost());
        break;
}

?>