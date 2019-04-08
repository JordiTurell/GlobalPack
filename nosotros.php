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
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" />
    <!-- Custom fonts for this template -->
    <link href="vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.min.css" rel="stylesheet" type="text/css" />
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

<body id="page-top" class="container-fuild" onload="LoadNosotors();">

    <!-- Navigation -->
    <?php include_once(dirname(__FILE__).'/Menus/menutop.php'); ?>

    <!-- Historia -->
    <div class="cabecera-nosotros row">
        <div>
            <img src="/assets/img/LOGO_GLOBALPACK_NOSOTROS.png" style="z-index:9999;" />
        </div>
        <div id="texto-header"></div>
        <div class="arrow-down" style="margin-bottom:60px;">
            <img src="/assets/iconos/ICON_FLETXA_BANNER.png" onclick="DownSection();" id="nosotros-arrow-down" />
        </div>
        <div class="nosotros-header-alhpa"></div>
    </div>

    <!-- Benificios -->
    <div class="beneficios row" id="nosotros-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <h1 class="los-beneficios-con-g">Los beneficios con Globalpack</h1>
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul id="listbenificios" class="text-center"></ul>
                </div>
            </div>
        </div>
    </div>
    <!-- InformaciÃÂÃÂ³ Corporativa de GlobalPack -->
    <div class="nosotros-info row" style="padding-bottom:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <h1>SOBRE NOSOTROS</h1>
                    </center>
                </div>
            </div>
            <div class="row" style="margin-top:45px;">
                <div class="col-lg-6" style="text-align:center;">
                    <img src="" id="img-info-nosotros" />
                </div>
                <div class="col-lg-6" id="textonosotros"></div>
            </div>
        </div>
    </div>

    
    <!-- Google Maps-->
    <?php include_once(dirname(__FILE__).'/assets/mapa.php'); ?>
    <!-- Contacte -->
    <?php include_once(dirname(__FILE__).'/Formularis/PopupContacte.php'); ?>
    <!-- Footer -->
    <footer class="row">
        <?php include_once(dirname(__FILE__).'/Footer/footer.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/pages/nosotros.js"></script>
    <script type="text/javascript" src="/js/mobile.js"></script>
</body>

</html>