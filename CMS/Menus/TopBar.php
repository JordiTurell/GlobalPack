<?php

use CMS\Constantes\Constantes;
require_once(dirname(__DIR__).'/Constantes.php');
?>
<header class="main-header">
    <!-- Logo -->
    <a href="/cms/principal.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            <?php echo Constantes::MinProjectName; ?>
        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            <?php echo Constantes::ProjectName; ?>
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" data-toggle="push-menu" role="button">
            <i class="fas fa-bars" style="color:white;"></i>
        </a>
    </nav>
</header>