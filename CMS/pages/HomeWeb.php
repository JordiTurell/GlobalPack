<?php
use CMS\Constantes\Constantes;
require_once('../Constantes.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
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

    <link rel="stylesheet" href="/cms/css/admin.min.css" />
    <link rel="stylesheet" href="/cms/css/backend.min.css" />
</head>
<?php
session_start();
if(isset($_SESSION['SES'])){
    $ses = json_decode($_SESSION['SES']);
    if($ses->token != "" && $ses->status){
?>
<body class="hold-transition skin-blue sidebar-mini" onload="LoadHomeWeb('<?php echo $ses->token; ?>');">
    <div class="wrapper">

        <?php require_once('../Menus/TopBar.php'); ?>

        <?php require_once('../Menus/MenuLeft.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Información
                    <small> Global pack</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <?php echo Constantes::iconHomeHeader; ?>
                    </li>
                    <li class="active">HomeWeb</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="box">
                    <div class="box-header">
                        Edición del apartado de la cabecera de la Home.
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-3">
                    <div class="box">
                        <div class="box-header">
                            Edición del texto del slide de la home.
                        </div>
                        <div class="box-body">
                             <div class="form-group">
                                <label for="tituloHome">Título</label>
                                <input type="text" class="form-control" id="tituloHome" placeholder="Título" onkeypress="TituloKey(this);" required />
                                <label>Max Caracters: <span id="titulomax">31</span></label>
                            </div>
                            <div class="form-group">
                                <label for="tituloHome">Descripción</label>
                                <input type="text" class="form-control" id="descripcionHome" placeholder="Descripción" onkeypress="DescripcioKey(this);" required />
                                <label>
                                    Max Caracters:
                                    <span id="descmax">112</span>
                                </label>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn" onclick="SaveTextHome('<?php echo $ses->token; ?>');">Guardar</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                <div class="box">
                    <div class="box-header">
                        Cajas de links de la home.
                    </div>
                    <div class="box-body">
                        <div class="row" id="cajas">
                            <div class="col-lg-5 item-slider">
                                <select class="form-control" onchange="LoadBox(this);">
                                    <option value="0">Selecciona una categoría o filtro</option>
                                </select>
                                <br />
                                <img src="/cms/img/default.png" style="width:125px; background-color: #9a9a9a;" onclick="$('#UpdateImage1').click();" id="icon1" />
                                <input type="file" onchange="UpdateFile(this);" style="display:none;" id="UpdateImage1" data-box="1"/>
                                <br />
                                <input type="text" placeholder="Nombre" class="form-control" />
                                <br />
                                <input type="text" placeholder="Url" class="form-control" />
                                <br />
                                <button type="button" class="btn" onclick="SaveBox('<?php echo $ses->token; ?>', 1, this);">Guardar</button>
                            </div>
                            <div class="col-lg-5 item-slider">
                                <select class="form-control" onchange="LoadBox(this);">
                                    <option value="0">Selecciona una categoría o filtro</option>
                                </select>
                                <br />
                                <img src="/cms/img/default.png" style="width:125px; background-color: #9a9a9a;" onclick="$('#UpdateImage2').click();" id="icon2" />
                                <input type="file" onchange="UpdateFile(this);" style="display:none;" id="UpdateImage2" data-box="2"/>
                                <br />
                                <input type="text" placeholder="Nombre" class="form-control" />
                                <br />
                                <input type="text" placeholder="Url" class="form-control" />
                                <br />
                                <button type="button" class="btn" onclick="SaveBox('<?php echo $ses->token; ?>', 2, this);">Guardar</button>
                            </div>
                            <div class="col-lg-5 item-slider">
                                <select class="form-control" onchange="LoadBox(this);">
                                    <option value="0">Selecciona una categoría o filtro</option>
                                </select>
                                <br />
                                <img src="/cms/img/default.png" style="width:125px; background-color: #9a9a9a;" onclick="$('#UpdateImage3').click();" id="icon3" />
                                <input type="file" onchange="UpdateFile(this);" style="display:none;" id="UpdateImage3" data-box="3"/>
                                <br />
                                <input type="text" placeholder="Nombre" class="form-control" />
                                <br />
                                <input type="text" placeholder="Url" class="form-control" />
                                <br />
                                <button type="button" class="btn" onclick="SaveBox('<?php echo $ses->token; ?>', 3, this);">Guardar</button>
                            </div>
                            <div class="col-lg-5 item-slider">
                                <select class="form-control" onchange="LoadBox(this);">
                                    <option value="0">Selecciona una categoría o filtro</option>
                                </select>
                                <br />
                                <img src="/cms/img/default.png" style="width:125px; background-color: #9a9a9a;" onclick="$('#UpdateImage4').click();" id="icon4" />
                                <input type="file" onchange="UpdateFile(this);" style="display:none;" id="UpdateImage4" data-box="4"/>
                                <br />
                                <input type="text" placeholder="Nombre" class="form-control" />
                                <br />
                                <input type="text" placeholder="Url" class="form-control" />
                                <br />
                                <button type="button" class="btn" onclick="SaveBox('<?php echo $ses->token; ?>', 4, this);">Guardar</button>
                            </div>
                            <div class="col-lg-5 item-slider">
                                <select class="form-control" onchange="LoadBox(this);">
                                    <option value="0">Selecciona una categoría o filtro</option>
                                </select>
                                <br />
                                <img src="/cms/img/default.png" style="width:125px; background-color: #9a9a9a;" onclick="$('#UpdateImage5').click();" id="icon5" />
                                <input type="file" onchange="UpdateFile(this);" style="display:none;" id="UpdateImage5" data-box="5"/>
                                <br />
                                <input type="text" placeholder="Nombre" class="form-control" />
                                <br />
                                <input type="text" placeholder="Url" class="form-control" />
                                <br />
                                <button type="button" class="btn" onclick="SaveBox('<?php echo $ses->token; ?>', 5, this);">Guardar</button>
                            </div>
                            <div class="col-lg-5 item-slider">
                                <select class="form-control" onchange="LoadBox(this);">
                                    <option value="0">Selecciona una categoría o filtro</option>
                                </select>
                                <br />
                                <img src="/cms/img/default.png" style="width:125px; background-color: #9a9a9a;" onclick="$('#UpdateImage6').click();" id="icon6" />
                                <input type="file" onchange="UpdateFile(this);" style="display:none;" id="UpdateImage6" data-box="6"/>
                                <br />
                                <input type="text" placeholder="Nombre" class="form-control" />
                                <br />
                                <input type="text" placeholder="Url" class="form-control" />
                                <br />
                                <button type="button" class="btn" onclick="SaveBox('<?php echo $ses->token; ?>', 6, this);">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
                    </div>
                    </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php require_once('../footer.php'); ?>
    </div>
    <!-- ./wrapper -->
    <!-- Modales -->
    <?php include_once('../Modals/ModalLoading.php'); ?>
    <?php include_once('../Modals/ModalError.php'); ?>

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
    <!-- Morris.js charts -->
    <script src="/cms/js/raphael/raphael.min.js"></script>
    <script src="/cms/js/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="/cms/js/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="/cms/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/cms/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <script src="/cms/js/moment/min/moment.min.js"></script>
    <script src="/cms/js/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="/cms/js/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="/cms/js/jquery-knob/dist/jquery.knob.min.js"></script>

    <!-- Slimscroll -->
    <script src="/cms/js/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="/cms/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Base App -->
    <script src="/cms/js/base.min.js"></script>
    <script src="/cms/js/demo.js"></script>
    <script src="/cms/js/pages/HomeWeb.js"></script>
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

