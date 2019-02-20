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

    <!-- Custom fonts for this template -->
    <link href="vendor/components/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body id="page-top">

    <!-- Navigation -->
    <?php include_once(dirname(__FILE__).'/Menus/menutop.php'); ?>
    <div class="col-lg-12" style="text-align:center;">
        <p>
            <h1>CONTACTO</h1>
        </p>
    </div>
    <div class="col-lg-12">
        <!-- Google Maps-->
        <?php include_once(dirname(__FILE__).'/assets/mapa.php'); ?>
    </div>
    
    <div class="col-lg-12">
        <div class="container" style="margin-top:20px;">
            <div class="row">
                <div class="col-lg-6" style="padding:0; margin-left:-10px;">
                    <ul class="row lis-option">
                        <li class="option-contact">
                            <h3>LLAMANOS</h3>
                            <br />
                            <div class="icon-imatge">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="footer-telf">
                                <span>
                                    <i class="fas fa-phone"></i>&nbsp;
                                    <a href="tel:+34934327181">+34 93 4327181</a>
                                </span>
                                <br />
                                <span>
                                    <i class="fas fa-fax"></i>&nbsp;
                                    <a href="tel:+34934327181">+34 93 4327181</a>
                                </span>
                            </div>
                        </li>

                        <li class="option-contact">
                            <h3>ESCRIBENOS</h3>
                            <br />
                            <div class="icon-imatge">
                                <i class="far fa-edit"></i>
                            </div>
                            <div class="footer-telf">
                                <br />
                                <span>
                                    <i class="far fa-envelope"></i>&nbsp;
                                    <a href="mailto:info@globalpack-e.com">info@globalpack-e.com</a>
                                </span>
                                <br />
                            </div>
                        </li>

                        <li class="option-contact">
                            <h3>HORARIO</h3>
                            <br />
                            <div class="icon-imatge">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="footer-telf">
                                <span>
                                    De lunes a viernes
                                </span>
                                <br />
                                <span>
                                    de 9:00 a 18:30
                                </span>
                            </div>
                        </li>

                        <li class="option-contact">
                            <h3>VISITANOS</h3>
                            <br />
                            <div class="icon-imatge">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="footer-telf">
                                <span>
                                    P.I Molí d'en Xec N.15
                                </span>
                                <br />
                                <span>
                                    08291 Ripollet
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    Formulari
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer>
        <?php include_once(dirname(__FILE__).'/Footer/footer_contact.php'); ?>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>