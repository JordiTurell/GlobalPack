<?php
use WEB\Constantes\Constantes;
require_once('Constantes.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

    <!-- Footer -->
    <footer></footer>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/components/jquery/jquery.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>