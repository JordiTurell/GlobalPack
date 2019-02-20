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
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet" />
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="/cms/css/Ionicons/css/ionicons.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/cms/vendor/components/font-awesome/css/fontawesome-all.min.css" />
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
<body class="hold-transition skin-blue sidebar-mini" onload="ListAdmin('<?php echo $ses->token; ?>');">
    <div class="wrapper"><?php require_once('../../Menus/TopBar.php'); ?><?php require_once('../../Menus/MenuLeft.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Creaci&oacute;n
                    <small>de administradores</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <?php echo Constantes::iconHomeHeader; ?>
                    </li>
                    <li class="active">List administradores    </li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
               <div class="row">
                   <div class="col-lg-12">
                       <div class="box" style="overflow:hidden;">
                           <div class="box-body" id="tabla">

                           </div>
                           <div class="box-footer">

                           </div>
                       </div>
                   </div>
               </div>
            </section>
                  
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
       <?php require_once('../../footer.php'); ?>
    </div>
    <!-- ./wrapper -->

    <!-- Modales -->
    <?php include_once('../../Modals/ModalLoading.php'); ?>
    <!-- jQuery 3 -->
    <script src="/cms/js/jquery-3.3.1.min.js"></script>
    
    <!-- Bootstrap 3.3.7 -->
    <script src="/cms/js/bootstrap.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script src="/cms/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- Base App -->
    <script src="/cms/js/base.min.js"></script>
    <script src="/cms/js/demo.js"></script>
    <script src="/cms/js/pages/ListarAdmin.js"></script>

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

