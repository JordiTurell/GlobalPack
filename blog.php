<?php
use WEB\Constantes\Constantes;
require_once('Constantes.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>
        <?php echo Constantes::ProjectName; ?>
    </title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom fonts for this template -->
    <link href="vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body id="page-top" class="container-fuild" onload="LoadBlog();">

    <!-- Navigation -->
    <?php include_once(dirname(__FILE__).'/Menus/menutop.php'); ?>

    <div class="row" style="margin-top:20px;">
        <div class="container" style="padding:0px;">
            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <h1 class="blog-title">BLOG</h1>
                    </center>
                </div>
            </div>
            
        </div>
    </div>
    <div class="row" style="background-color:#F7F7F7">
        <div class="container">
            <div class="row text-center" id="list-blog" style="text-align:center;"></div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <?php include_once(dirname(__FILE__).'/Footer/footer.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/jquery.redirect.js"></script>
    <script type="text/javascript" src="/js/pages/blog.js"></script>
</body>

</html>