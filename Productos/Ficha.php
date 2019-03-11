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
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="/vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/slick.css" rel="stylesheet" type="text/css" />
    <link href="/css/slick-theme.css" rel="stylesheet" type="text/css" />
    <link href="/css/style.min.css" rel="stylesheet" type="text/css" />
</head>

<body id="page-top" class="container-fuild" onload="Ficha_Producto('<?php echo $producto["Id_Producto"]; ?>');">
    
    <!-- Navigation -->
    <?php include_once('../Menus/menutop.php'); ?>

    <div class="row" style="margin-bottom:130px; margin-top:86px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:50px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="/assets/iconos/FLETXA_PRODUCTOS_FITXA.png" style="width:50px;" />

                            <h1 class="title">PRODUCTOS</h1>&nbsp;&nbsp;&nbsp;
                            <h1 class="title2">
                                <?php echo $producto["cat"]["Categoria"]?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 imgproducto">
                    
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 id="titleproducto"></h1>
                        </div>
                        <div class="col-lg-12" id="list-serveis">
                            
                        </div>
                        <div class="col-lg-12">
                            <div id="descripcion"></div>
                            <div id="garantia"></div>
                            <div class="row" style="margin-top:20px;">
                                <div class="col-md-6 btn btn-web" style="padding-top:15px;" onclick="ShowcontactComprar();">
                                    <img src="/assets/iconos/cart.png" style="width:30px;"/>&nbsp;Comprar
                                </div>
                                <div class="col-md-6 btn btn-web" onclick="ShowcontactComprar();">
                                    Pedir Informaci&#243;n personalizada
                                </div>
                            </div>
                            <div class="row" style="margin-top:30px;">
                                <div class="col-md-6">
                                    <img src="/assets/iconos/impresora.png" style="width:30px; margin-right:10px;" onclick="Imprimir()"/>
                                    <img src="/assets/iconos/pdf.png" style="width:30px; margin-right:10px;" id="pdf"/>
                                    <img src="/assets/iconos/star.png" style="width:30px;"/>
                                </div>
                                <div class="col-md-6 text-right">
                                    <!--<img src="/assets/iconos/mail.png" style="width:30px; margin-right:10px;" onclick="SharedMail();"/>-->
                                    <img src="/assets/iconos/facebook.png" style="width:10px; margin-right:10px;" onclick="SharedFacebook();"/>
                                    <img src="/assets/iconos/tweeter.png" style="width:20px; margin-right:10px;" onclick="SharedTweeter();"/>
                                    <img src="/assets/iconos/linkedin.png" style="width:20px;" onclick="SharedLinkedin();"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                     <ul class="nav nav-tabs">
                        <li id="tab_fichaTecnica" class="active"><a data-toggle="tab" href="#ficha">Ficha Tecnica</a></li>
                        <li id="tab_video"><a data-toggle="tab" href="#content-video">Videos</a></li>
                         <li id="tab_comparativa">
                             <a data-toggle="tab" href="#comparativa">Comparativa</a>
                         </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="background-color:#F7F7F7; padding-top:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                            <div class="tab-content">
                              <div id="ficha" class="tab-pane fade in active show">
                                
                              </div>
                              <div id="content-video" class="tab-pane fade">
                                  <div class="row">
                                    <div class="col-lg-6" id="video">
                                        
                                    </div>
                                    <div class="col-lg-6">
                                        <h3 id="titulovideo"></h3>
                                        <p id="descripcion-video"></p>
                                    </div>
                                </div>
                              </div>
                              <div id="comparativa" class="tab-pane fade">
                                
                              </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="background-color:#F7F7F7;">
        <div class="container" id="product_relacionados">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Productos relacionados</h3>
                </div>
                <div class="col-lg-12">
                    <div class="slider_relacionados">
                       
                      </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contacte -->
    <?php include_once('../Formularis/PopupContacte.php'); ?>

    <!-- Footer -->
    <footer class="row" style="background-color:#F7F7F7;">
        <?php include_once('../Footer/footer.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/slick.min.js"></script>
   
    <script type="text/javascript" src="/js/pages/Ficha_Producto.js"></script>

</body>

</html>