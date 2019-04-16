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
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" />
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
    "link": "Leer mÃÂ¡s",
    "href": "/legal/Coockies.php"
  }
})});
    </script>
</head>

<body id="page-top" class="container-fuild" onload="LoadPost();">
    <!-- Navigation -->
    <?php include_once(dirname(__FILE__).'/Menus/menutop.php'); ?>

    <div class="row" style="margin-top:20px;">
        <div class="container" style="padding:0px;">
            <div class="row">
                <div class="col-lg-12" style="padding-bottom:20px; padding-top:50px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="/assets/iconos/FLETXA_PRODUCTOS_FITXA.png" style="width:50px; cursor:pointer;" onclick="onBack();" />
                            <h1 class="title" style="width:106px; font-weight:700;">BLOG</h1>&nbsp;&nbsp;&nbsp;<h1 class="title2" style="width:84%; font-weight:300;"><?php echo $post["Titulo"]?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="padding-bottom:20px;">
        <div class="container">
            <div class="row" style="margin-top:20px;">
                <div class="col-lg-6">
                    <div id="video" style="width:100%;"></div>
                    <?php
                        for($a = 0; $a < count($post["imagenes"]); $a++){
                            echo '<img src="'.$post["imagenes"][$a].'" style="width:100%; margin-bottom:20px;" />';
                        }
                    ?>
                </div>
                <div class="col-lg-6" id="contentDesc">
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
                    <div class="col-lg-12" style="padding-top:10px;">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="button" class="btn btn-web btn-ficha" value="COMPARTIR" style="margin-left:0px;" onclick="Compartir();" />
                            </div>
                            <div class="col-lg-6 text-right">
                                <img src="/assets/iconos/impresora.png" style="width:30px; margin-right:10px;" onclick="Imprimir()" />
                                <img src="/assets/iconos/star.png" style="width:30px;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer>
        <?php include_once(dirname(__FILE__).'/Footer/footer.php'); ?>
    </footer>

    <?php include_once(dirname(__FILE__).'/Productos/ModalCompartir.php'); ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/pages/blog.js"></script>
    <script type="text/javascript" src="/js/mobile.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var video = '<?php echo $post["video"]; ?>';
            if(video != ''){
               $('#video').append(video);
               $($('#video').find('iframe')[0]).attr('width', '100%');
            }
            });
        </script>
</body>

</html>