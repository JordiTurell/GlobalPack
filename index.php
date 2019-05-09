<?php
use WEB\Constantes\Constantes;
require_once('Constantes.php');

?>
<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>
          <?php echo Constantes::ProjectName; ?>
      </title>
      <?php echo Constantes::SEO; ?>

    <!-- Bootstrap core CSS -->
    <link href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
      <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" />

    <!-- Custom fonts for this template -->
    <link href="vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
      <link href="css/style.css" rel="stylesheet" type="text/css" />
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

  <body id="page-top" class="container-fuild" onload="Loadhome();">

    <!-- Navigation -->      
          <?php include_once(dirname(__FILE__).'/Menus/menutop.php'); ?>
     
    <div class="row section-head">
        <div class="filter"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div id="title_home">
                        <div class="h1">Expertos en envases y embalajes</div>
                        <div class="h3">
                            Get direct access to the best instructors in each field, lorem
ipsum dolor sit amet consectetur adipisicing elit
                        </div>
                        <p>&nbsp;</p>
                        <img src="/assets/iconos/ICON_FLETXA_BANNER.png" onclick="DownSection();" id="arrow-down" />
                    </div>
                </div>
                <div class="col-lg-8 d-none d-lg-block">
                    <div class="row flex-row-reverse" style="padding-top:18px;">
                        <div class="col-lg-5 item-slider box1"></div>
                        <div class="col-lg-5 item-slider box0"></div>
                        <div class="col-lg-5 item-slider box3"></div>
                        <div class="col-lg-5 item-slider box2"></div>
                        <div class="col-lg-5 item-slider box5"></div>
                        <div class="col-lg-5 item-slider box4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <div class="row">
          <div class="col-lg-8 d-none blockscategoriasHome">
              <div class="row flex-row-reverse" style="padding-top:18px;">
                  <div class="col-lg-5 item-slider box1"></div>
                  <div class="col-lg-5 item-slider box0"></div>
                  <div class="col-lg-5 item-slider box3"></div>
                  <div class="col-lg-5 item-slider box2"></div>
                  <div class="col-lg-5 item-slider box5"></div>
                  <div class="col-lg-5 item-slider box4"></div>
              </div>
          </div>
      </div>
    <div class="row" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 old-blog">
                    <h1>¿Qué hay de nuevo?</h1>
                </div>
                <div class="col-lg-4 item-ocasion">
                </div>
            </div>
        </div>
    </div>
      <?php include_once(dirname(__FILE__).'/Formularis/ContacteAllPages.php'); ?>
    <!-- Footer -->
    <footer>
        <?php include_once(dirname(__FILE__).'/Footer/footer.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script type="text/javascript" src="/js/jquery.redirect.js"></script>
    <script type="text/javascript" src="/js/pages/home.js"></script>
      <script type="text/javascript" src="/js/mobile.js"></script>
  </body>

</html>