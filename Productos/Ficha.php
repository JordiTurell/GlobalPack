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
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
    <script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#EF3340",
      "text": "#ffdddd"
    },
    "button": {
      "background": "#ff0000"
    }
  },
  "content": {
    "message": "Este sitio web utiliza cookies para garantizar que obtenga la mejor experiencia en nuestro sitio web.",
    "dismiss": "Acepto",
    "link": "Leer más",
    "href": "/legal/Coockies.php"
  }
})});
    </script>
</head>

<body id="page-top" class="container-fuild" onload="Ficha_Producto('<?php echo $producto["Id_Producto"]; ?>');">
    
    <!-- Navigation -->
    <?php include_once('../Menus/menutop.php'); ?>

    <div class="row" style="margin-top:86px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:50px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="/assets/iconos/FLETXA_PRODUCTOS_FITXA.png" style="width:50px; cursor:pointer;" onclick="onBack();"/>

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
                                <div class="col-md-6 btn btn-web" style="padding-top:14px; display:none;" onclick="ShowcontactComprar();">
                                    <img src="/assets/iconos/cart.png" style="width:30px; float:left; margin-top:-1px; margin-left:30px;" />&nbsp;<div style="float:right; margin-top:2px; margin-right:22px;">COMPRAR</div>
                                </div>
                                <div class="col-md-6 btn btn-web btn-ficha" onclick="ShowcontactComprar();" style="margin-left:0px; margin-top:10px;">
                                    Pedir Informaci&#243;n personalizada
                                </div>
                            </div>
                            <div class="row" style="margin-top:30px; border-top:solid 2px rgba(206, 206, 206, 0.50); padding-top:20px;">
                                <div class="col-md-6 col-xs-6">
                                    <img src="/assets/iconos/impresora.png" style="width:30px; margin-right:10px;" onclick="Imprimir()" />
                                    <img src="/assets/iconos/pdf.png" style="width:30px; margin-right:10px;" id="pdf" />
                                    <img src="/assets/iconos/star.png" style="width:30px;" />
                                </div>
                                <div class="col-md-6 col-xs-6 text-right">
                                    <input type="button" class="btn btn-web btn-ficha" value="COMPARTIR" style="margin:0 auto;" onclick="Compartir();" />
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
                        <li id="tab_fichaTecnica">
                            <a data-toggle="tab" href="#ficha" onclick="ChangeStyleTab(0);">Ficha Tecnica</a></li>
                        <li id="tab_video">
                            <a data-toggle="tab" href="#content-video" onclick="ChangeStyleTab(1);">Videos</a>
                        </li>
                         <li id="tab_comparativa">
                             <a data-toggle="tab" href="#comparativa" onclick="ChangeStyleTab(2);">Comparativa</a>
                         </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="background-image:url('/assets/img/FONS_FICHA_PRODUCTOS.png'); background-size:100% 100%; background-repeat:no-repeat; padding-top:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                            <div class="tab-content">
                              <div id="ficha" class="tab-pane fade">
                                
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
    <div class="row">
        <div class="container" id="product_relacionados">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3>Productos relacionados</h3>
                </div>
                <div class="col-lg-12">
                    <div class="slider_relacionados" style="margin-left:10px;"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contacte -->
    <?php include_once('../Formularis/PopupContacte.php'); ?>
    <?php include_once('ModalCompartir.php'); ?>
    <!-- Footer -->
    <footer class="row">
        <?php include_once('../Footer/footer.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.redirect.js"></script>
    <script src="/js/slick.min.js"></script>
   
    <script type="text/javascript" src="/js/pages/Ficha_Producto.js"></script>
    <script>
        $(document).ready(function () {
            $($($('.nav-tabs').children()[0]).children()[0]).click();
            $($('.nav-tabs').children()[0]).css('border-bottom', 'solid 4px #ef3340');
        });
    </script>
    <script type="text/javascript" src="/js/mobile.js"></script>
</body>

</html>