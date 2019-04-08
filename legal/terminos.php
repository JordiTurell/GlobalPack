<?php
use WEB\Constantes\Constantes;
require_once('../Constantes.php');

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
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" />
    <!-- Custom fonts for this template -->
    <link href="/vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
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

<body id="page-top" class="container-fuild" onload="LoadLegales(1);">
    <!-- Navigation -->
    <?php include_once('../Menus/menutop.php'); ?>

    <div class="row" style="padding-bottom:20px;">
        <div class="container">
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-12" id="textolegales"></div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <?php include_once('../Footer/footer.php'); ?>
    </footer>

    <?php include_once('../Productos/ModalCompartir.php'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/components/jquery/jquery.min.js"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/pages/blog.js"></script>
    <script type="text/javascript" src="/js/pages/legales.js"></script>
    <script type="text/javascript" src="/js/mobile.js"></script>
</body>

</html>