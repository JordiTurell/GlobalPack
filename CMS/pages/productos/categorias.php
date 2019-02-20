<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Globalpack | Dashboard</title>
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
<body class="hold-transition skin-blue sidebar-mini" onload="LoadList('<?php echo $ses->token; ?>');">
    <div class="wrapper">
        <?php require_once('../../Menus/TopBar.php'); ?><?php require_once('../../Menus/MenuLeft.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Productos
                    <small>Categorí­as</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="#">
                            <i class="fa fa-dashboard"></i> Home
                        </a>
                    </li>
                    <li class="active">Productos</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <input type="button" class="btn" value="Crear Categorí­a" style="margin-bottom:10px;" onclick="ReloadForm();" />
                <div class="row">
                    <div class="col-md-6">
                          <div class="box">
                            <div class="box-header">
                                Listado de Categorias
                            </div>
                            <div class="box-body">
                                <ul id="listcategorias" style="list-style:none;">
                                    <li>No hay Categorias</li>
                                </ul>
                            </div>
                            <div class="box-footer"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                          <div class="box">
                            <div class="box-header">Crear/Editar Categorí­a</div>
                            <div class="box-body">
                                <div class="from-group">
                                    <label>Nombre de la categorí­a</label>
                                    <input type="text" id="Nombre" placeholder="Nombre de la categorí­a" class="form-control" />
                                </div>
                                <br />
                                <div class="from-group">
                                    <label>Descripción de la categorí­a</label>
                                    <textarea class="form-control" rows="5" placeholder="Descripción de la categorí­a" id="Descripcion"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Icono de la categorí­a</label>
                                    <br />
                                    <img src="/cms/img/default.png" style="width:50px; height:50px;" onclick="$('#updateicon').click();" id="icon" />
                                    <input type="file" style="display:none;" id="updateicon" />
                                </div>
                                <br />
                                <input type="button" value="Guardar categorí­a" id="SaveCat" class="btn" data-id="00000000-0000-0000-0000-000000000000" onclick="SaveCategoria('<?php echo $ses->token; ?>');" />
                            </div>
                            <div class="box-footer"></div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper --><?php require_once('../../footer.php'); ?>
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
    <script src="/cms/js/pages/Productos/Categorias.js"></script>
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

