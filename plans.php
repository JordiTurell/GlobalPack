<?php
use WEB\Constantes\Constantes;
require_once('Constantes.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  
    <title>
        <?php echo Constantes::ProjectName; ?>
    </title>
    <?php echo Constantes::SEO; ?>

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
    "link": "Leer mÃÂ¡s",
    "href": "/legal/Coockies.php"
  }
})});
    </script>
</head>

<body id="page-top" class="container-fuild" onload="LoadPage();">

    <!-- Navigation -->
    <?php include_once(dirname(__FILE__).'/Menus/menutop.php'); ?>

    <div class="plans-info row" style="padding-bottom:40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <center>
                        <h1 style="text-transform:uppercase; width:590px;" class="titleplans">Servicio de Postventa Globalpack</h1>
                    </center>
                </div>
            </div>
            <div class="row" style="margin-top:45px;">
                <div class="col-lg-12 plans">
                   
                </div>
            </div>
            <div class="row" id="listplanes">
                
            </div>
        </div>
    </div>

    
    <!-- Google Maps-->
    <div class="row" style="padding-bottom:20px;">
        <iframe src="https://www.google.com/maps/d/embed?mid=1-2y-3Fot5hB6rnSUW8qwPeoknv8" width="100%" height="480"></iframe>
    </div>
    <!-- Contacte -->
    <?php include_once(dirname(__FILE__).'/Formularis/PopupContacte.php'); ?>
    <!-- Footer -->
    <footer class="row">
        <?php include_once(dirname(__FILE__).'/Footer/footer.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/mobile.js"></script>
    <script type="text/javascript" src="/js/pages/plans.js"></script>
</body>

</html>