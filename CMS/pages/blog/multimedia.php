<?php
use CMS\Constantes\Constantes;
require_once('../../Constantes.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>
        <?php echo Constantes::ProjectName; ?> | Dashboard
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/cms/css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/cms/vendor/components/font-awesome/css/fontawesome-all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="/cms/css/Ionicons/css/ionicons.min.css" />
    <!-- Theme Base -->
    <link rel="stylesheet" href="/cms/css/base.min.css" />
    <link rel="stylesheet" href="/cms/css/skins/_all-skins.min.css" />

    <link rel="stylesheet" href="/cms/css/admin.min.css" />
    <link rel="stylesheet" href="/cms/css/backend.min.css" />
</head>
<?php
session_start();
if(isset($_SESSION['SES'])){
    $ses = json_decode($_SESSION['SES']);
    if($ses->token != "" && $ses->status){
?>
<body class="hold-transition skin-blue sidebar-mini" onload="LoadFiles('<?php echo $ses->token; ?>');">
    <div class="wrapper">
        <?php require_once('../../Menus/TopBar.php'); ?><?php require_once('../../Menus/MenuLeft.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i> Blog Multimedia
                        </a>
                    </li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="box-header">
                                <div class="row">
                                    <div class="col-lg-1">
                                        <input type="button" value="Subir Archivos" class="btn" onclick="$('#update').click();" />
                                        <input type="file" style="display:none;" id="update" multiple />
                                    </div>
                                    <div class="col-lg-11">
                                        <span>Total: </span> <span id="totalfiles">0/0</span>
                                        <div id="progress-wrp">
                                            <div class="progress-bar"></div>
                                            <div class="status">0%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <ul id="listimagenes"></ul>
                            </div>
                            <div class="box-footer"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php require_once('../../footer.php'); ?>
        <?php require_once('../../Modals/ModalDeleteImage.php'); ?>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="/cms/js/jquery-3.3.1.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <script src="/cms/js/bootstrap.min.js"></script>
    <script src="/cms/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- Base App -->
    <script src="/cms/js/base.min.js"></script>
    <script src="/cms/js/demo.js"></script>
    <script src="/cms/js/pages/Blog/multimedia.js"></script>
</body>
</html>

<?php
    }else{
        header('Location: /cms/index.php');
    }
}else{
    header('Location: /cms/index.php');
}
?>

