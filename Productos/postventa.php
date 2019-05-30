<?php
use WEB\Constantes\Constantes;
require_once('../Constantes.php');

$id = $_GET["Cat"];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>
        <?php echo Constantes::ProjectName; ?>
    </title>
    
    <?php echo Constantes::SEO; ?>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" />
    <!-- Custom fonts for this template -->
    <link href="/vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
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

<body id="page-top" class="container-fuild" onload="LoadHomePostVenta('<?php echo $id; ?>');">

    <!-- Navigation -->
    <?php include_once('../Menus/menutop.php'); ?>

    <div class="row" style="margin-bottom:130px; margin-top:86px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:50px;">
                    <center>
                        <h1 class="title">SOLUCIÓN</h1>
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3" style="border-right: 1px solid rgba(155,155,155,0.15);">
                    <div class="colum-left">
                        <h1 class="list-title-left">CATEGORIAS</h1>
                        <ul id="list-categorias"></ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row filtros">
                        <h3>FILTRO POR SOLUCIÓN</h3>
                        <ul id="list-filtros"></ul>
                    </div>
                    <div class="row autosemi" style="padding-left:20px;">
                        <br />
                        <h3>FILTRO POR NIVEL DE ASISTENCIA</h3>
                        <ul id="list-servicios" style="list-style:none; padding:0; margin-left:-14px;"></ul>
                    </div>
                    <div class="row productes" style="padding-top:38px;"></div>
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
    <script type="text/javascript" src="/js/jquery.redirect.js"></script>
    <script type="text/javascript" src="/js/pages/postventa.js"></script>
    <script type="text/javascript" src="/js/mobile.js"></script>
</body>

</html>