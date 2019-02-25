<?php
use WEB\Constantes\Constantes;
require_once('Constantes.php');

$post = $_POST;

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

<body id="page-top" class="container-fuild" onload="LoadPost();">
    <!-- Navigation -->
    <?php include_once(dirname(__FILE__).'/Menus/menutop.php'); ?>

    <div class="row" style="margin-top:20px;">
        <div class="container" style="padding:0px;">
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:20px; padding-top:50px;">
                    <div class="row">
                        <div class="onback col-lg-1"><</div>
                        <div class="col-lg-11">
                            <h1 class="title" style="width:106px;">BLOG</h1>&nbsp;&nbsp;&nbsp;<h1 class="title2" style="width:87%;"><?php echo $post["Titulo"]?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-bottom:20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <?php 
                        for($a = 0; $a < count($post["imagenes"]); $a++){
                            echo '<img src="'.$post["imagenes"][$a].'" style="width:100%; margin-top:20px;" />';
                        }
                    ?>
                </div>
                <div class="col-lg-6">
                    <h3 class="title-post-ficha"> <?php echo $post["Titulo"]; ?></h3>
                    <label class="fecha-desc">
                        <?php 
                            $date = new DateTime($post["FechaC"]);
                            echo $date->format('d-m-Y');
                        ?>
                    </label>
                    <div class="descripcion-blog">
                    <?php echo $post["Descripcion"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <?php include_once(dirname(__FILE__).'/Footer/footer.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/pages/blog.js"></script>
</body>

</html>