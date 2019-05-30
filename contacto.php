<?php
use WEB\Constantes\Constantes;
require_once('Constantes.php');
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

<body id="page-top" class="container-fuild">

    <!-- Navigation -->
    <?php include_once(dirname(__FILE__).'/Menus/menutop.php'); ?>
    <div class="col-lg-12" style="text-align:center;">

        <center>
            <h1 class="contacto-title">CONTACTO</h1>
        </center>

    </div>
    <div class="col-lg-12 mapacontacto">
        <!-- Google Maps-->
        <?php include_once(dirname(__FILE__).'/assets/mapa.php'); ?>
    </div>

    <div class="col-lg-12 col-form-contacto">
        <div class="container" style="margin-top:20px;">
            <div class="row">
                <div class="col-lg-6 footer-box" style="padding:0; margin-left:-10px;">
                    <div class="row">
                        <ul class="row lis-option">
                            <li class="option-contact">
                                <h3>LL&#193;MANOS</h3>
                                <br />
                                <div class="icon-imatge">
                                    <img src="/assets/iconos/mobile.png" class="ico-phone" />
                                </div>
                                <div class="footer-telf">
                                    <span>
                                        <a href="tel:+34934327181">+34 93 432 71 81</a>
                                    </span>
                                    <br />
                                    <span>
                                        <a href="tel:+34934225257">+34 93 422 52 57</a>
                                    </span>
                                </div>
                            </li>

                            <li class="option-contact" style="cursor:pointer;" onclick="window.location='mailto:globalpack@globalpack.es';">
                                <h3>ESCR&#205;BENOS</h3>
                                <br />
                                <div class="icon-imatge">
                                    <img src="/assets/iconos/escribenos.png" class="ico-write" />
                                </div>
                                <div class="footer-telf">
                                    <br />
                                    <span>
                                        <i class="far fa-envelope"></i>
                                        <span style="font-size:15px;">globalpack@globalpack.es </span>
                                    </span>
                                    <br />
                                </div>
                            </li>
                            <li class="option-contact">
                                <h3>HORARIO</h3>
                                <br />
                                <div class="icon-imatge">
                                    <img src="/assets/iconos/calendario.png" class="ico-calendar" />
                                </div>
                                <div class="footer-telf">
                                    <span>
                                        De lunes a viernes
                                    </span>
                                    <br />
                                    <span>
                                        de 8:00 a 13:30<br />
                                        de 15:00 a 18:00
                                    </span>
                                </div>
                            </li>

                                <li class="option-contact">
                                    <h3>VIS&#205;TANOS</h3>
                                    <br />
                                    <div class="icon-imatge">
                                        <img src="/assets/iconos/localizacion.png" class="ico-location" />
                                    </div>
                                    <div class="footer-telf">
                                        <span>
                                            Mol&#237; d'en Xec N.15
                                        </span>
                                        <br />
                                        <span>
                                            08291 Ripollet
                                        </span>
                                    </div>
                                </li>
</ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="/assets/img/LOGO_CONTACTO.png" style="margin-left:25px; width:90%;" />
                        </div>
                        <div class="col-lg-6" style="padding-left:20px;">
                            P.I Mol&#237; d'en Xec N.15 <br />
                            08291 Ripollet <br />
                            T (+34) 93 432 71 81 <br />
                            F (+34) 93 432 71 82 <br />
                            www.globalpack.es
                            www.globalpack-e.com
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 form-contacto">
                    <div class="content-form" style="margin:0px; margin-bottom:20px;">
                        <div class="title-form">
                            <h1>&#191;Necesitas ayuda?</h1>
                        </div>
                        <div class="row formulario-allpages">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Empresa" class="form-control" id="empresa" />
                                <input type="email" placeholder="Email" class="form-control" id="email" />
                                <input type="text" placeholder="Provincia" class="form-control" id="provincia" />
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Tel&#233;fono" class="form-control" id="telefono" />
                                <input type="text" placeholder="Nombre" class="form-control" id="nombre" />
                                <input type="text" placeholder="Pa&#237;s" class="form-control" id="pais" />
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Escribe tu mensaje..." class="form-control" rows="5" id="mensaje"></textarea>
                            </div>
                            <div class="col-lg-12" style="padding-top:12px;">
                                <div class="row">
                                    <div class="col-lg-12 text-left">
                                        <input type="checkbox" id="terminos" />
                                        <span>He le&#237;do y acepto el aviso legal y la pol&#237;tica de privacidad.</span>
                                    </div>
                                    <div class="col-lg-12 text-left">
                                        <input type="checkbox" />
                                        <span>Autorizo el env&#237;o de informaci&#243;n.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" id="error"></div>
                            <div class="col-lg-12 text-center">
                                <input type="button" class="btn" value="ENVIAR" onclick="SendMail();" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <?php include_once(dirname(__FILE__).'/Footer/footer_origin.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/js/mobile.js"></script>
    <script type="text/javascript">
    function SendMail() {
        var request = {
            Empresa: $('#empresa').val(),
            Email: $('#email').val(),
            Provincia: $('#provincia').val(),
            Telefono: $('#telefono').val(),
            Nombre: $('#nombre').val(),
            Pais: $('#pais').val(),
            Mensaje: $('#mensaje').val()
        };
        if ($("#terminos").is(':checked')) {
            if ($('#nombre').val() != "" || $('#email').val() != "" || $('#mensaje').val() != "") {
                $.ajax({
                    url: '/sendmail.php',
                    type: "POST",
                    data: JSON.stringify(request),
                    cache: false,
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    success: function (data) {

                    }
                });
                $('#error').text('Gracias por contactar con nosotros. Brevemente le informaremos.');
            } else {
                $('#error').fadeIn();
                $('#error').text('Hay que rellenar todos los campos');
            }
        } else {
            $('#error').fadeIn();
            $('#error').text('Hay que aceptar los terminos legales.');
        }
    }
    </script>
</body>

</html>