<?php
use CMS\Constantes\Constantes;
require_once('../../Constantes.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
    <!-- Morris chart -->
    <link rel="stylesheet" href="/cms/js/morris.js/morris.css" />
    <!-- jvectormap -->
    <link rel="stylesheet" href="/cms/js/jvectormap/jquery-jvectormap.css" />
    <!-- Date Picker -->
    <link rel="stylesheet" href="/cms/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/cms/js/bootstrap-daterangepicker/daterangepicker.css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/cms/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" />
    
   <!-- CKEDITOR -->
    <link rel="stylesheet" type="text/css" href="/cms/bower_components/ckeditor/skins/moono-lisa/editor.css" />
    <link rel="stylesheet" href="/cms/css/admin.min.css" />
    <link rel="stylesheet" href="/cms/css/backend.min.css" />
</head>
<?php
session_start();
if(isset($_SESSION['SES'])){
    $ses = json_decode($_SESSION['SES']);
    if($ses->token != "" && $ses->status){
        $post = null;
        if(!empty($_GET["Id"])){
            
            require_once('../../../api/wcf/admin/Blog.php');
            $wcf = new \Api\WCF\Blog();
            $post = $wcf->GetPost($_GET["Id"], $ses->token);
        }

?>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">

            <?php require_once('../../Menus/TopBar.php'); ?>

            <?php require_once('../../Menus/MenuLeft.php'); ?>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Blog
                        <small> Global pack</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <?php echo Constantes::iconHomeHeader; ?>
                        </li>
                        <li class="active">Crear Post</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="box">
                                <div class="box-header">
                                    <label>Tí­tulo del post</label>
                                    <input class="form-control" type="text" placeholder="Insertar el tí­tulo del post" id="post_title" />
                                </div>
                                <div class="box-body">
                                    <label>Descripción corta</label>
                                    <textarea id="editor1" name="editor1" rows="10" cols="80"></textarea>
                                    <br />
                                    <label>Descripción larga</label>
                                    <textarea id="editor2" name="editor2" rows="10" cols="80"></textarea>
                                </div>
                                <div class="box-footer">
                                    <input type="button" value="Guardar" class="btn float-right" onclick="SavePost('<?php echo $ses->token; ?>');" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="box">
                                <div class="box-header">
                                    <label>Insertar url del video</label>
                                </div>
                                <div class="box-body">
                                    <input type="text" placeholder="Url del video" id="video" class="form-control" />
                                </div>
                            </div>
                            <div class="box">
                                <div class="box-header">
                                    <label>Insertar imagen del post</label>
                                </div>
                                <div class="box-body">
                                    <input type="button" class="btn" value="Insertar Imagen" onclick="ShowMultimedia('<?php echo $ses->token; ?>');" />
                                    <input type="file" id="updateimage" style="display:none;" onchange="UpdateImage(this);" />
                                    <ul id="post_images"></ul>
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
        <?php include_once('../../Modals/ModalError.php'); ?>
        <?php include_once('../../Modals/ModalBlogMultimedia.php'); ?>

        <!-- ./wrapper -->
        <!-- jQuery 3 -->
        <script src="/cms/js/jquery-3.3.1.min.js"></script>
        <script src="/cms/js/Popper.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="/cms/js/jquery-ui/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <script src="/cms/js/bootstrap.min.js"></script>

        <!-- Slimscroll -->
        <script src="/cms/js/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/cms/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Base App -->
        <script src="/cms/js/base.min.js"></script>
        <script src="/cms/js/demo.js"></script>

        <script src="/cms/js/pages/CreatePost.js"></script>
        <!-- CKEDITOR -->
        <script type="text/javascript" src="/cms/bower_components/ckeditor/ckeditor.js"></script>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            $(document).ready(function () {
                CKEDITOR.replace('editor1');
                CKEDITOR.replace('editor2');
                <?php 
                    if($post != null){
                ?>
                        GetPost(<?php echo json_encode($post) ?>);
                <?php
                    }
                ?>
            })
        </script>
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

