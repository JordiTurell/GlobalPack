<?php
use CMS\Constantes\Constantes;
require_once('../../Constantes.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo Constantes::ProjectName; ?> | Dashboard</title>
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
?>
<body class="hold-transition skin-blue sidebar-mini" onload="LoadList('<?php echo $ses->token; ?>', 0);">
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
                            <i class="fa fa-dashboard"></i> Home
                        </a>
                    </li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12">
                            <input type="button" value="Crear Producto" class="btn" style="margin-bottom:10px;" onclick="LoadWizard();" />                        
                    </div>
                    <div class="col-lg-12">
                        <div class="box">
                            <div class="box-header">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" id="searchproduct" placeholder="Buscador" onkeypress="EnterSearch(event);" />
                                            <div class="input-group-prepend">
                                                <div class="input-group-text" onclick="Buscar(0);">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    <div class="col-lg-2">
                                        <select class="form-control" id="Filtrocategorias" onchange="SelectCategoria();">
                                            <option value="0">Selecciona una categoría</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <select class="form-control" id="Filtrotipo" onchange="SelectFiltro();">
                                            <option value="0">Selecciona un filtro</option>
                                            <option value="1">Habilitado</option>
                                            <option value="2">Deshabilitado</option>
                                            <option value="3">Ocasion</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1 text-center">
                                        <strong>Imagen</strong>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <strong>Titulo</strong>
                                    </div>
                                    <div class="col-lg-2 text-center">
                                        <strong>Relacionados</strong>
                                    </div>
                                    <div class="col-lg-1 text-center">
                                        <strong>Home Web</strong>
                                    </div>
                                    <div class="col-lg-1 text-center">
                                        <strong>Ocasion</strong>
                                    </div>
                                    <div class="col-lg-1 text-center">
                                        <strong>Habilitado</strong>
                                    </div>
                                    <div class="col-lg-1 text-center">
                                        <strong>Opciones</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body"></div>
                            <div class="box-footer">
                                <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                    <ul class="pagination">
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

            <!-- Modal -->
            <div class="modal fade" id="WizarProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="TituloModalCreation">Creaci&#243;n de un Producto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="tab tab-1 tab-active">
                                <div class="col-lg-12">
                                    <span>Categor&#205;as</span>
                                    <ul id="selectcat"></ul>
                                </div>
                            </div>
                            <div class="tab tab-2 tab-active">
                                <div class="col-lg-12">
                                    <span>Filtros</span>
                                    <ul id="selectsubcat"></ul>
                                </div>
                            </div>
                            <div class="tab tab-3 tab-active">
                                <div class="col-lg-12">
                                    <span>Serveis</span>
                                    <ul id="selectserveis"></ul>
                                </div>
                            </div>
                            <div class="tab tab-4 tab-active">
                                <input type="button" value="Agregar Imagen" onclick="ShowMultimedia();" class="btn" style="margin-bottom:10px;" />

                                <div id="noimage" style="text-align:center;">
                                    <p>Agrega 1 o + imagenes de la galer&#205;a para la ficha de producto.</p>
                                </div>
                                <ul id="listimagenesadd"></ul>
                            </div>
                            <div class="tab tab-5">
                                <div class="form-group">
                                    <label>T&#205;tulo del producto</label>
                                    <input type="text" id="Titulo" placeholder="T&#205;tulo del producto" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Descripci&#243;n del producto</label>
                                    <textarea id="editor1"></textarea>
                                </div>
                            </div>
                            <div class="tab tab-5-1">
                                <div class="form-group">
                                    <label>Garant&#205;a del equipo</label>
                                    <input type="text" id="garantia" placeholder="Garant&#205;a del equipo" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Descripci&#243;n corta del producto</label>
                                    <input type="text" id="desc_corta" placeholder="Descripci&#243;n corta del producto" class="form-control" />
                                </div>
                            </div>
                            <div class="tab tab-6">
                                <div class="form-group">
                                    <label>Ficha tecnica del producto</label>
                                    <textarea id="editor2"></textarea>
                                </div>
                            </div>
                            <div class="tab tab-7">
                                <div class="form-group">
                                    <label>Comparativa tecnica del producto</label>
                                    <textarea id="editor3"></textarea>
                                </div>
                            </div>
                            <div class="tab tab-8">
                                <div class="form-group">
                                    <label>Url del Video</label>
                                    <input type="text" id="Video" placeholder="Url del video" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>T&#205;tulo video</label>
                                    <input type="text" id="titlevideo" placeholder="T&#205;tulo del video" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Descripci&#243;n video</label>
                                    <input type="text" id="descvideo" placeholder="Descripci&#243;n del video" class="form-control" />
                                </div>
                            </div>
                            <div class="tab tab-9">
                                <div class="form-group">
                                    <label>Pdf</label>
                                    <input type="file" id="Pdf" placeholder="Pdf" class="form-control" onchange="SavePDF(this);" />
                                </div>
                                <div class="form-group">
                                    <label>Referencia del Sage</label>
                                    <input type="text" id="Sage" placeholder="Referencia del Sage" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="atras" class="btn" onclick="WizardBack();" disabled>Atras</button>
                            <button type="button" id="siguiente" class="btn" onclick="WizardNext();">Siguiente</button>
                            <button type="button" id="SaveProduct" style="display:none;" class="btn" onclick="SaveProduct();">Guardar Producto</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('../../Modals/ModalLoading.php'); ?>
        <?php include_once('../../Modals/ModalOcasion.php'); ?>
        <?php include_once('../../Modals/ModalProductosMultimedia.php'); ?>
        <?php include_once('../../Modals/ModalDeleteProducto.php'); ?>

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
    <script type="text/javascript" src="/cms/js/pages/Productos/multimedia.js"></script>
    <script type="text/javascript" src="/cms/js/pages/Productos/Productos.js"></script>

    <!-- CKEDITOR -->
    <script type="text/javascript" src="/cms/bower_components/ckeditor/ckeditor.js"></script>
    <script>
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
        $(document).ready(function () {
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2');
            CKEDITOR.replace('editor3');
        });
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

