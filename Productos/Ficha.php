<?php
use WEB\Constantes\Constantes;
require_once('../Constantes.php');

$producto = $_POST;

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
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom fonts for this template -->
    <link href="/vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/style.min.css" rel="stylesheet" type="text/css" />
</head>

<body id="page-top" class="container-fuild">

    <!-- Navigation -->
    <?php include_once('../Menus/menutop.php'); ?>

    <div class="row" style="margin-bottom:130px; margin-top:86px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:50px;">
                    <div class="row">
                        <div class="onback col-lg-1"><</div>
                        <div class="col-lg-11">
                            <h1 class="title">PRODUCTOS</h1>&nbsp;&nbsp;&nbsp;<h1 class="title2"><?php echo $producto["cat"]["Categoria"]?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <?php 
                        if(count($producto["imagen"]) > 1){
                            
                        }else{
                            echo '<img src="'.$producto["imagen"][0].'" style="width:100%;" />';
                        }
                    ?>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1><?php echo $producto["Titulo"]; ?></h1>
                        </div>
                        <div class="col-lg-12">
                            SERVEIS
                        </div>
                        <div class="col-lg-12">
                            <?php echo $producto["Descripcion"]; ?>
                            <div class="row">
                                <div class="col-md-6 btn btn-web" style="padding-top:15px;" onclick="ShowcontactComprar();">
                                    Comprar
                                </div>
                                <div class="col-md-6 btn btn-web" onclick="ShowcontactComprar();">
                                    Perdi Informaci&#243;n personalizada
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="col-lg-12">
                            <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#home">Ficha Tecnica</a></li>
                              <li><a data-toggle="tab" href="#menu1">Videos</a></li>
                              <li><a data-toggle="tab" href="#menu2">Comparativa</a></li>
                            </ul>

                            <div class="tab-content">
                              <div id="home" class="tab-pane fade in active">
                                <?php echo $producto["FichaTecnica"]; ?>
                              </div>
                              <div id="menu1" class="tab-pane fade">
                                <h3>Menu 1</h3>
                                <p>Some content in menu 1.</p>
                              </div>
                              <div id="menu2" class="tab-pane fade">
                                <h3>Menu 2</h3>
                                <p>Some content in menu 2.</p>
                              </div>
                            </div>
                        </div>
                </div>
                <div class="col-lg-12">
                    <?php echo var_dump($producto); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Contacte -->
    <?php include_once('../Formularis/PopupContacte.php'); ?>

    <!-- Footer -->
    <footer>
        <?php include_once('../Footer/footer.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/components/jquery/jquery.min.js"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/pages/Ficha_Producto.js"></script>
</body>

</html>