var token = '';
var tabposition = 1;
var imagenes = new Array();
var createProducto = new Object();
var UrlPDF = '';
var pagina = 0;
var buscador = false;
var filtrado = false;
var filtradoCategorias = false;


function LoadWizard() {
    tabposition = 1;
    $('#TituloModalCreation').text('Creación de un Producto');
    createProducto = new Object();
    createProducto.categorias = [];
    createProducto.filtres = [];
    createProducto.serveis = [];
    createProducto.imagenes = [];
    $('#SaveProduct').data('edit', false);
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;

        //Cateogrias
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=LoadListCategorias",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                if (data.status) {
                    var cat = $('#selectcat');
                    $(cat).children().remove();
                    for (var a = 0; a < data.list.length; a++) {
                        var html = '<li><img src="'+ data.list[a].Icono +'" style="width:50px; height:auto;" /><br/><span>'+ data.list[a].Categoria +'</span></li>';
                        var cat_item = $(cat).append(html);
                        var cat_li = $($(cat_item).children()[a]);
                        $(cat_li).data('cat', data.list[a]);
                        $(cat_li).data('selection', false);
                        $(cat_li).on('click', function () {
                            if ($(this).data('selection')) {
                                $(this).removeClass('cat_Active');
                                createProducto.categorias = createProducto.categorias.filter(product => product.Categoria != $(this).data('cat').Categoria);
                                $(this).data('selection', false);
                            } else {
                                $(this).addClass('cat_Active');
                                createProducto.categorias.push($(this).data('cat'));
                                $(this).data('selection', true);
                            }
                        });
                    }
                    //Filtres
                    $.ajax({
                        type: "POST",
                        url: "/api/interfaces/admin/IProductos.php?fun=LoadListSubCategorias",
                        data: JSON.stringify(request),
                        cache: false,
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        beforeSend: function () {

                        },
                        success: function (data) {

                            if (data.status) {
                                var cat = $('#selectsubcat');
                                $(cat).children().remove();
                                for (var a = 0; a < data.list.length; a++) {
                                    var html = '<li><img src="' + data.list[a].Icono + '" style="width:50px; height:auto;" /><span>' + data.list[a].Categoria + '</span></li>';
                                    var filtre = $(cat).append(html);
                                    
                                    var filtre_li = $($(filtre).children()[a]);
                                    $(filtre_li).data('cat', data.list[a]);
                                    $(filtre_li).data('selection', false);
                                    $(filtre_li).on('click', function () {
                                        if ($(this).data('selection')) {
                                            $(this).removeClass('cat_Active');
                                            createProducto.filtres = createProducto.filtres.filter(product => product.Categoria != $(this).data('cat').Categoria);
                                            $(this).data('selection', false);
                                        } else {
                                            $(this).addClass('cat_Active');
                                            createProducto.filtres.push($(this).data('cat'));
                                            $(this).data('selection', true);
                                        }
                                    });
                                }
                                $('#WizarProducto').modal({ backdrop: 'static', keyboard: false });
                                $('#WizarProducto').modal('show');
                                PositionTab();
                            }
                        }
                    });
                    //Serveis
                    $.ajax({
                        type: "POST",
                        url: "/api/interfaces/admin/IProductos.php?fun=LoadListServicios",
                        data: JSON.stringify(request),
                        cache: false,
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        beforeSend: function () {

                        },
                        success: function (data) {

                            if (data.status) {
                                var cat = $('#selectserveis');
                                $(cat).children().remove();
                                for (var a = 0; a < data.list.length; a++) {
                                    var html = '<li><img src="' + data.list[a].Icono + '" style="width:50px; height:auto;" /><span>' + data.list[a].Nombre + '</span></li>';
                                    var serveis = $(cat).append(html);

                                    var serveis_li = $($(serveis).children()[a]);
                                    $(serveis_li).data('cat', data.list[a]);
                                    $(serveis_li).data('selection', false);
                                    $(serveis_li).on('click', function () {
                                        if ($(this).data('selection')) {
                                            $(this).removeClass('cat_Active');
                                            createProducto.serveis = createProducto.serveis.filter(product => product.Nombre != $(this).data('cat').Nombre);
                                            $(this).data('selection', false);
                                        } else {
                                            $(this).addClass('cat_Active');
                                            createProducto.serveis.push($(this).data('cat'));
                                            $(this).data('selection', true);
                                        }
                                    });
                                }
                                $('#WizarProducto').modal({ backdrop: 'static', keyboard: false });
                                $('#WizarProducto').modal('show');
                                PositionTab();
                            }
                        }
                    });
                }
            }
        });
    });
}

function LoadList(t, p) {
    token = t;
    $.getScript("/cms/js/pages/models/requestlist.js", function (ev) {
        var request = requestlist;
        request.token = token;
        request.pagina = p;
        pagina = p;
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=LoadListCategorias",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                if (data.status) {
                    $('#Filtrocategorias').children().remove();
                    $('#Filtrocategorias').append('<option value="0">Selecciona una categorí­a</option>');
                    for (var a = 0; a < data.list.length; a++) {
                        $('#Filtrocategorias').append('<option value="' + data.list[a].Id_Categoria +'">' + data.list[a].Categoria +'</option>');
                    }
                }
            }
        });
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=LoadListProductos",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {
                
            },
            success: function (data) {
                if (data.status) {
                    CreateTableProductos(data);
                }
                $('#ModalLoading').modal('hide');
            }
        });
    });
}

function CreateTableProductos(data) {
    var body = $('.box-body');
    $(body).children().remove();
    for (var a = 0; a < data.list.length; a++) {
        var code = '';
        code = '<div class="row" style="padding-top:5px;">' +
            '<div class="col-lg-1"><img src="' + data.list[a].imagen + '" style="width:100%; height:auto;" /></div>' +
            '<div class="col-lg-2">' + data.list[a].Titulo + '</div>' +
            '<div class="col-lg-2"><span style="color:white; background-color:red; padding:5px; padding-left:10px; padding-right:10px; border-radius:5px; margin-top:5px; float:left;">' + data.list[a].relacionados + '</span>&nbsp; <i class="fas fa-plus-circle" onclick="$(\'#add' + a +'\').click();" style=" margin-top:5px; color:red; font-size:30px;" ></i> <input type="button" class="btn" id="add'+a+'" value="Agregar Producto" style="float:right; margin-top:5px; display:none;" /></div>';
        if (data.list[a].home == 1) {
            code += '<div class="col-lg-1">' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox" checked>' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        } else {
            code += '<div class="col-lg-1">' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox">' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        }
        if (data.list[a].Ocasion == 1) {
            code += '<div class="col-lg-1">' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox" checked>' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        } else {
            code += '<div class="col-lg-1">' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox">' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        }
        if (data.list[a].Habilitado == 1) {
            code += '<div class="col-lg-1">' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox" checked>' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        } else {
            code += '<div class="col-lg-1">' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox">' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        }
        code += '<div class="col-lg-2">' +
            '<i class="fas fa-edit" onclick="$(\'#edit' + a +'\').click();" style="color:red; font-size:30px; margin-top:10px; margin-right:5px;"></i><input type="button" value="Editar" class="btn" id="edit' + a +'" style="display:none;"/>&nbsp;' +
            '<i class="fas fa-trash" onclick="$(\'#trash' + a + '\').click();" style="color:red; font-size:30px; margin-top:10px; margin-right:5px;"></i><input type="button" value="Eliminar" class="btn" id="trash' + a + '" style="display:none;" />' +
            '<i class="fas fa-clone" onclick="$(\'#Duplicar' + a + '\').click();" style="color:red; font-size:30px; margin-top:10px; margin-right:5px;"></i><input type="button" value="Duplicar" class="btn" id="Duplicar' + a + '" style="display:none;" />' +
            '<i class="fas fa-question-circle" style="color:red; font-size:30px; margin-top:10px; margin-right:5px;"></i>'+
            '</div>';
        code += '<div class="col-lg-1">' +
            '<div class="input-group date">'+
            '<input type="text" class="form-control pull-right" placeholder="Orden" />' +
            '<div class="input-group-addon">' +
            '<i class="fa fa-plus" style="color:red;"></i>' +
            '</div>' +
                '</div>'+
            '</div>';
        code += '</div>';
        var fila = $(body).append(code);

        var relacionado = $($(fila).children()[a]).find('input')[0];
        var home = $($(fila).children()[a]).find('.col-lg-1')[1];
        var ocasion = $($(fila).children()[a]).find('.col-lg-1')[2];
        var habilitado = $($(fila).children()[a]).find('.col-lg-1')[3];
        var editar = $($($(fila).children()[a]).find('.col-lg-2')[2]).children()[1];
        var eliminar = $($($(fila).children()[a]).find('.col-lg-2')[2]).children()[3];
        var duplicar = $($($(fila).children()[a]).find('.col-lg-2')[2]).children()[5];
        var popover = $($($(fila).children()[a]).find('.col-lg-2')[2]).children()[6];
        var orden = $($($(fila).children()[a]).find('.col-lg-1')[4]).find('i')[0];

        $($(orden).parent().parent().find('input')[0]).val(data.list[a].Orden);
        $(popover).data('product', data.list[a].allProduct);
        $(popover).on('click', function () {
            
            var p = $(this).data('product');
            var code = '';
            if (p.Categoria.length == 0) {
                code += '<li>Agregar categoría</li>';
            }
            if (p.Descripcion == '') {
                code += '<li>Insertar Descripción</li>';
            }
            if (p.Descripcion_corta == '') {
                code += '<li>Insertar Descripción corta</li>';
            }
            if (p.FichaTecnica == '') {
                code += '<li>Insertar texto de la ficha tecnica.</li>';
            }
            if (p.Id_SubCategoria.length == 0) {
                code += '<li>Agregar Filtros</li>';
            }
            if (p.Titulo == '') {
                code += '<li>Agregar Titulo</li>';
            }
            if (p.anogarantia == '') {
                code += '<li>Agregar año de garantia</li>';
            }
            if (p.comparativa == '') {
                code += '<li>Agregar texto de comparativa.</li>';
            }
            if (p.imagen.length == 0) {
                code += '<li>Agregar imagen </li>';
            }
            if (p.list_relacionados.length == 0) {
                code += '<li> Agregar productos relacionado </li>';
            }
            if (p.pdf == '') {
                code += '<li>Agregar PDF </li>';
            }
            if (p.referencia == '') {
                code += '<li>Agregar Referencia SAGE</li>';
            }
            if (p.servicios.length == 0) {
                code += '<li>Agregar Servicios de la maquina </li>';
            }
            if (p.videodesc = '') {
                code += '<li>Agregar descripción breve del video.</li>';
            }
            if (p.videotitle == '') {
                code += '<li>Agregar tiutlo del video</li>';
            }
            if (p.videourl == '') {
                code += '<li>Agregar iframe del video de youtube </li>';
            }
            $('.quefalta ul').children().remove();
            $('.quefalta ul').append(code);
            $('#productoTitulo').text(p.Titulo);
            if (!$('.quefalta').hasClass('active')) {
                $('.quefalta').addClass('active');
            }
        });

        $(orden).data('item', data.list[a]);
        $(orden).on('click', function (ev) {
            ev.preventDefault();
            var cat = $(this).data('item');
            cat.orden = $($(this).parent().parent().find('input')[0]).val();
            console.log(cat.orden);
            var request = { token: '', item: null };
            request.token = token;
            request.item = cat;

            $.ajax({
                type: "POST",
                url: "/api/interfaces/admin/IProductos.php?fun=SetOrden",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    if (data.status) {
                        location.reload();
                    }
                }
            });
        });
        $(relacionado).data('id', data.list[a].Id_Producto);
        $(relacionado).on('click', function (ev) {
            ev.preventDefault();
            window.location.replace("/cms/pages/productos/Productos_Relacionados.php?id="+ $(this).data('id'));
        });

        $(home).data('item', data.list[a]);
        $(home).click('on', function (ev) {
            ev.preventDefault();
            var cat = $(this).data('item');
            var s = $(this);
            if ($($(this).find('input')[0]).is(':checked')) {
                cat.Home = 0;
            } else {
                cat.Home = 1;
            }

            var request = { token: '', item: null };
            request.token = token;
            request.item = cat;

            $.ajax({
                type: "POST",
                url: "/api/interfaces/admin/IProductos.php?fun=HomeProduct",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    if (data.status) {
                        location.reload();
                    }
                }
            });
        });

        $(ocasion).data('item', data.list[a]);
        $(ocasion).click('on', function (ev) {
            ev.preventDefault();
            var cat = $(this).data('item');
            var s = $(this);
            if ($($(this).find('input')[0]).is(':checked')) {
                ChangeOcasion(s, cat);
            } else {
                OcasionModal(s, cat);
            }
        });

        $(habilitado).data('item', data.list[a]);
        $(habilitado).click('on', function (ev) {
            ev.preventDefault();
            var cat = $(this).data('item');
            var s = $(this);
            if ($($(this).find('input')[0]).is(':checked')) {
                cat.Habilitado = 0;
            } else {
                cat.Habilitado = 1;
            }

            var request = { token: '', item: null };
            request.token = token;
            request.item = cat;

            $.ajax({
                type: "POST",
                url: "/api/interfaces/admin/IProductos.php?fun=ActiveProducto",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    if (data.status) {
                        if (cat.Habilitado === 1) {
                            $($(s).find('input')[0]).prop('checked', true);
                        } else {
                            $($(s).find('input')[0]).prop('checked', false);
                        }
                    }
                }
            });
        });

        $(editar).data('item', data.list[a]);
        $(editar).on('click', function (ev) {
            var producto = $(this).data('item');
            $('#TituloModalCreation').text('Edición de ' + producto.Titulo);
            ev.preventDefault();
            Editar(producto);
        });

        $(eliminar).data('item', data.list[a]);
        $(eliminar).on('click', function (ev) {
            var producto = $(this).data('item');
            ev.preventDefault();
            $('#ModalDeleteProducto').data('item', producto);
            $('#ModalDeleteProducto').modal('show');
        });
        $(duplicar).data('item', data.list[a]);
        $(duplicar).on('click', function (ev) {
            var producto = $(this).data('item');
            ev.preventDefault();
            Duplicar(producto);
        });
    }
    paginacion(data);
}

function OutInfo() {
    if ($('.quefalta').hasClass('active')) {
        $('.quefalta').removeClass('active');
    }
}

function Duplicar(producto) {
    $.getScript("/cms/js/pages/models/requestlist.js", function (ev) {
        var request = requestlist;
        request.token = token;
        request.item = producto;
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=Duplicar",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status) {
                    window.location.reload();
                }
            }
        });
    });
}

function SelectFiltro(pagina) {
    filtrado = true;
    if ($('#Filtrotipo :selected').val() == 0) {
        if (buscador) {
            filtrado = false;
            Buscar(0);
            return;
        } else {
            filtrado = false;
            LoadList(token, 0);
            return;
        }
    }
    if ($('#searchproduct').val() != "") {
        buscador = true;
        $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
            var request = requestitem;
            request.token = token;
            request.pagina = pagina;
            request.item = $('#searchproduct').val();
            request.filtro = $('#Filtrotipo :selected').val();
            request.categoria = $('#Filtrocategorias :selected').val();
            $.ajax({
                type: "POST",
                url: "/api/interfaces/admin/IProductos.php?fun=Filtrado",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    CreateTableProductos(data);
                }
            });
        });
    } else {
        buscador = false;
        $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
            var request = requestitem;
            request.token = token;
            request.pagina = pagina;
            request.filtro = $('#Filtrotipo :selected').val();
            request.categoria = $('#Filtrocategorias :selected').val();
            $.ajax({
                type: "POST",
                url: "/api/interfaces/admin/IProductos.php?fun=Filtrado",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    CreateTableProductos(data);
                }
            });
        });
    }
}

function SelectCategoria(pagina) {
    filtradoCategorias = true;
    if ($('#Filtrocategorias :selected').val() == 0) {
        if (buscador) {
            filtradoCategorias = false;
            Buscar(0);
            return;
        } else {
            filtradoCategorias = false;
            LoadList(token, 0);
            return;
        }
    }
    if ($('#searchproduct').val() != "") {
        buscador = true;
        $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
            var request = requestitem;
            request.token = token;
            request.pagina = pagina;
            request.item = $('#searchproduct').val();
            request.filtro = $('#Filtrotipo :selected').val();
            request.categoria = $('#Filtrocategorias :selected').val();
            $.ajax({
                type: "POST",
                url: "/api/interfaces/admin/IProductos.php?fun=Filtrado",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    CreateTableProductos(data);
                }
            });
        });
    } else {
        buscador = false;
        $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
            var request = requestitem;
            request.token = token;
            request.pagina = pagina;
            request.filtro = $('#Filtrotipo :selected').val();
            request.categoria = $('#Filtrocategorias :selected').val();
            $.ajax({
                type: "POST",
                url: "/api/interfaces/admin/IProductos.php?fun=Filtrado",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    CreateTableProductos(data);
                }
            });
        });
    }
}

function paginacion(list) {
    $('.pagination').children().remove();
    var pages = $('.pagination');
    var paginas = 1;
    
    paginas = list.total / list.items;
    
    console.log('Paginas: '+paginas);
    for (var a = 0; a < paginas; a++) {
        var item = '';
        var row = null;
        if (a == 0) {
            item = '<li class="paginate_button previous disabled" id="example2_previous">' +
                '<span>' + (a+1) + '</span>' +
                '</li>';
            row = $(pages).append(item);
            $($($(row).children()[a])[0]).data('pagina', a);
            $($($(row).children()[a])[0]).on('click', function (ev) {

                ev.preventDefault();
                if (buscador) {
                    Buscar($(this).data('pagina'));
                } else {
                    if (filtradoCategorias) {
                        SelectCategoria($(this).data('pagina'));
                    } else if (filtrado) {
                        SelectFiltro($(this).data('pagina'));
                    } else {
                        LoadList(token, $(this).data('pagina'));
                    }
                }
            });
        } else {
            item = '<li class="paginate_button previous disabled" id="example2_previous">' +
                '<span>' + (a+1) + '</span>' +
                '</li>';
            row = $(pages).append(item);
            
            $($($(row).children()[a])[0]).data('pagina', a+1);
            
            $($($(row).children()[a])[0]).on('click', function (ev) {

                ev.preventDefault();
                if (buscador) {
                    Buscar($(this).data('pagina'));
                } else {
                    if (filtradoCategorias) {
                        SelectCategoria($(this).data('pagina'));
                    } else if (filtrado) {
                        SelectFiltro($(this).data('pagina'));
                    } else {
                        LoadList(token, $(this).data('pagina'));
                    }
                }
            });
        }
    }
}

function ChangeOcasion(s, cat) {
    if ($('#pvp').val() != '' || $('#pvpocasion').val() != '') {

        cat.PVP = $('#pvp').val();
        cat.PVPOcasion = $('#pvpocasion').val();

        if ($($(s).find('input')[0]).is(':checked')) {
            cat.Ocasion = 0;
        } else {
            cat.Ocasion = 1;
        }

        var request = { token: '', item: null };
        request.token = token;
        request.item = cat;

        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=ActiveOcasion",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                if (data.status) {
                    $('#pvp').val('');
                    $('#pvpocasion').val('')
                    if (cat.Ocasion === 1) {
                        $($(s).find('input')[0]).prop('checked', true);
                    } else {
                        $($(s).find('input')[0]).prop('checked', false);
                    }
                    $('#ModalOcasion').modal('hide');
                }
            }
        });
    } else {
        if ($($(s).find('input')[0]).is(':checked')) {
            cat.Ocasion = 0;
        } else {
            cat.Ocasion = 1;
        }
        var request2 = { token: '', item: null };
        request2.token = token;
        request2.item = cat;

        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=ActiveOcasion",
            data: JSON.stringify(request2),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                if (data.status) {
                    $('#pvp').val('');
                    $('#pvpocasion').val('')
                    if (cat.Ocasion === 1) {
                        $($(s).find('input')[0]).prop('checked', true);
                    } else {
                        $($(s).find('input')[0]).prop('checked', false);
                    }
                    $('#ModalOcasion').modal('hide');
                }
            }
        });
    }
}

function OcasionModal(s, cat) {
    $('#ModalOcasion').modal('show');
    $($('#ModalOcasion .modal-footer').children()[0]).on('click', function (ev) {
        ev.preventDefault();
        ChangeOcasion(s, cat);
    });
}

function WizardNext() {
    tabposition = tabposition + 1;
    PositionTab();   
}

function WizardBack() {
    tabposition = tabposition-1;
    PositionTab();
}

function PositionTab() {
    switch (tabposition) {
        case 1:
            $('#atras').prop('disabled', true);
            $('.tab-1').addClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            break;
        case 2:
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').addClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            break;
        case 3:
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').addClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            break;
        case 4:
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').addClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            break;
        case 5:
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').addClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            
            break;
        case 6:
        //Descripcio petita
        //Garantia del equipo
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').addClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            break;
        case 7:
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').addClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            break;
        case 8:
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').addClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            break;
        case 9:
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-8').addClass('tab-active');
            $('.tab-9').removeClass('tab-active');
            break;
        case 10:
            $('#atras').prop('disabled', false);
            $('.tab-1').removeClass('tab-active');
            $('.tab-2').removeClass('tab-active');
            $('.tab-3').removeClass('tab-active');
            $('.tab-4').removeClass('tab-active');
            $('.tab-5').removeClass('tab-active');
            $('.tab-5-1').removeClass('tab-active');
            $('.tab-6').removeClass('tab-active');
            $('.tab-7').removeClass('tab-active');
            $('.tab-8').removeClass('tab-active');
            $('.tab-9').addClass('tab-active');
            $('#siguiente').attr('style', 'display:none;');
            $('#SaveProduct').attr('style', 'display:block;');
            break;
    }
}

function ShowMultimedia() {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        var t = token;

        $.ajax({
            url: "/api/interfaces/admin/IProductos.php?fun=LoadFiles",
            type: "POST",
            data: JSON.stringify(request)
            ,
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",

            error: function (msg) {
                alert(msg);
            },
            success: function (data) {
                if (data.status) {
                    $('#listimagenes').children().remove();
                    for (var a = 0; a < data.list.length; a++) {
                        var code = "";
                        code = '<li><img src="' + data.list[a].url + '" style="width:250px;" /><div style="width:100%; text-align:center;">' + data.list[a].nombre +'</div></li>';
                        var item = $('#listimagenes').append(code);
                        for (var b = 0; b < imagenes.length; b++) {
                            if (imagenes[b] == data.list[a].url) {
                                $($(item).children()[a]).addClass('imgActive');
                                $($(item).children()[a]).data('select', true);
                            }
                        }

                        $($(item).children()[a]).data('obj', data.list[a].url);
                        $($(item).children()[a]).on('click', function () {
                            if (!$(this).data('select')) {
                                if (imagenes == "") {
                                    imagenes = new Array();
                                }
                                imagenes.push($(this).data('obj'));
                                $(this).addClass('imgActive');
                                $(this).data('select', true);
                            } else {
                                for (var c = 0; c < imagenes.length; c++) {
                                    if (imagenes[c] == $(this).data('obj')) {
                                        imagenes.splice(imagenes[c], 1);
                                        $(this).removeClass('imgActive');
                                        $(this).data('select', false);
                                    }
                                }
                            }
                        });
                    }
                    $('#ModalProductosMultimedia').modal('show');
                } else {
                    alert(data.msg);
                }
            }
        });
    });
}

function AsignarImagenes() {
    $('#ModalProductosMultimedia').modal('hide');
    $('#listimagenesadd').children().remove();
    for (var a = 0; a < imagenes.length; a++) {
        var code = '<li style="display:inline-block; margin:5px;"><img src="' + imagenes[a] + '" style="width:100px;"/></li>';
        var item = $('#listimagenesadd').append(code);
        createProducto.imagenes.push($($($(item).children()[a]).children()[0]).attr('src'));
    }
}

function SaveProduct() {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        createProducto.Titulo = $('#Titulo').val();
        createProducto.Descripcion = CKEDITOR.instances.editor1.getData();
        createProducto.Video = $('#Video').val();
        createProducto.Sage = $('#Sage').val();
        createProducto.Comparativa = CKEDITOR.instances.editor3.getData();
        createProducto.Ficha_Tecnica = CKEDITOR.instances.editor2.getData();
        createProducto.TituloVideo = $('#titlevideo').val();
        createProducto.DescVideo = $('#descvideo').val();
        createProducto.DescMin = $('#desc_corta').val();
        createProducto.Garantia = $('#garantia').val();
        createProducto.Pdf = UrlPDF;

        request.item = createProducto;
               
        var formData = new FormData();
        if ($('#pdf').prop('files') != undefined) {
            formData.append("file", $('#pdf').prop('files')[0]);
        }
        request.item.imagenes = imagenes;
        formData.append("item", request.item);
        formData.append("token", token);
        if ($('#SaveProduct').data('edit')) {
            $.ajax({
                url: "/api/interfaces/admin/IProductos.php?fun=UpdateProduct",
                type: "POST",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    if (data.status) {
                        $('#WizarProducto').modal('hide');
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        } else {
            $.ajax({
                url: "/api/interfaces/admin/IProductos.php?fun=SaveProduct",
                type: "POST",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {
                    if (data.status) {
                        $('#WizarProducto').modal('hide');
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        }
    });
}

function SavePDF(input) {
    var formData = new FormData();
    UrlPDF = '';
    if ($('#SaveProduct').data('edit')) {
        $('#SaveProduct').prop('disabled', true);
        formData.append("idProducto", createProducto.item.Id_Producto);
    }
    if ($(input).prop('files') != undefined) {
        formData.append("file", $(input).prop('files')[0]);

        $.ajax({
            url: "/cms/img/UpdateFile.php?FOLDER=PDF",
            type: "POST",
            async: true,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                UrlPDF = data;
                $(input).val('');
                if ($('#SaveProduct').data('edit')) {
                    $('#SaveProduct').prop('disabled', false);
                }
            }
        });
    } else {
        $(input).val('');
        alert('Error al subir el PDF');
    }
}

function Buscar(page) {
    if ($('#searchproduct').val() != "") {
        buscador = true;
        $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
            request.token = token;
            request.pagina = page;
        request.item = $('#searchproduct').val();
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=Buscador",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {

            },
            success: function (data) {
                CreateTableProductos(data);
            }
        });
    });
    } else {
        buscador = false;
        LoadList(token, 0);
    }    
}

function Eliminar() {
    var p = $('#ModalDeleteProducto').data('item');
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        request.item = p;
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=DeleteProducto",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status) {
                    window.location.reload();
                }
            }
        });
    });
}

function Editar(producto) {

    tabposition = 1;
    createProducto = new Object();
    createProducto.categorias = [];
    createProducto.filtres = [];
    createProducto.serveis = [];
    createProducto.imagenes = [];
    createProducto.item = producto;

    var request = {
        token: '',
        item: null
    };
    request.token = this.token;
    request.item = producto;
    producto.Pdf = UrlPDF;
    //GetProducto
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IProductos.php?fun=GetAllProducto",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            if (data.status) {
                console.log(data);
                createProducto.itemdb = data.item;
                //Cateogrias
                $.ajax({
                    type: "POST",
                    url: "/api/interfaces/admin/IProductos.php?fun=LoadListCategorias",
                    data: JSON.stringify(request),
                    cache: false,
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    beforeSend: function () {

                    },
                    success: function (data) {
                        if (data.status) {
                            var cat = $('#selectcat');
                            $(cat).children().remove();
                            var catActive = false;
                            createProducto.categorias = data.list;
                            for (var a = 0; a < data.list.length; a++) {
                                for (var c = 0; c < createProducto.itemdb.Categoria.length; c++) {
                                    if (createProducto.itemdb.Categoria[c] === data.list[a].Id_Categoria) {
                                        catActive = true;
                                        break;
                                    } else {
                                        catActive = false;
                                    }
                                }

                                var html = '';
                                if (catActive) {
                                    html = '<li class="cat_Active"><img src="' + data.list[a].Icono + '" style="width:50px; height:auto;" /><br/><span>' + data.list[a].Categoria + '</span></li>';
                                } else {
                                    html = '<li><img src="' + data.list[a].Icono + '" style="width:50px; height:auto;" /><br/><span>' + data.list[a].Categoria + '</span></li>';
                                }
                                var cat_item = $(cat).append(html);
                                var cat_li = $($(cat_item).children()[a]);
                                $(cat_li).data('cat', data.list[a]);
                                $(cat_li).data('selection', catActive);
                                $(cat_li).on('click', function () {
                                    if ($(this).data('selection')) {
                                        $(this).removeClass('cat_Active');
                                        createProducto.itemdb.Categoria = createProducto.itemdb.Categoria.filter(product => product != $(this).data('cat').Id_Categoria);
                                        $(this).data('selection', false);
                                    } else {
                                        $(this).addClass('cat_Active');
                                        createProducto.itemdb.Categoria.push($(this).data('cat').Id_Categoria);
                                        $(this).data('selection', true);
                                    }
                                });
                            }
                            //Filtres
                            $.ajax({
                                type: "POST",
                                url: "/api/interfaces/admin/IProductos.php?fun=LoadListSubCategorias",
                                data: JSON.stringify(request),
                                cache: false,
                                dataType: "json",
                                contentType: "application/json; charset=utf-8",
                                beforeSend: function () {

                                },
                                success: function (data) {

                                    if (data.status) {
                                        var cat = $('#selectsubcat');
                                        $(cat).children().remove();
                                        var catActive = false;
                                        for (var a = 0; a < data.list.length; a++) {
                                            if (createProducto.itemdb.Id_SubCategoria != null) {
                                                for (var c = 0; c < createProducto.itemdb.Id_SubCategoria.length; c++) {
                                                    if (createProducto.itemdb.Id_SubCategoria[c] === data.list[a].Id_Subcategoria) {
                                                        catActive = true;
                                                        break;
                                                    } else {
                                                        catActive = false;
                                                    }
                                                }
                                            }
                                            var html = '';
                                            if (catActive) {
                                                html = '<li class="cat_Active"><img src="' + data.list[a].Icono + '" style="width:50px; height:auto;" /><span>' + data.list[a].Categoria + '</span></li>';
                                            } else {
                                                html = '<li><img src="' + data.list[a].Icono + '" style="width:50px; height:auto;" /><span>' + data.list[a].Categoria + '</span></li>';
                                            }

                                            var filtre = $(cat).append(html);

                                            var filtre_li = $($(filtre).children()[a]);
                                            $(filtre_li).data('cat', data.list[a]);
                                            $(filtre_li).data('selection', catActive);
                                            $(filtre_li).on('click', function () {
                                                if ($(this).data('selection')) {
                                                    $(this).removeClass('cat_Active');
                                                    createProducto.itemdb.Id_SubCategoria = createProducto.itemdb.Id_SubCategoria.filter(product => product != $(this).data('cat').Id_Subcategoria);
                                                    $(this).data('selection', false);
                                                } else {
                                                    $(this).addClass('cat_Active');
                                                    createProducto.itemdb.Id_SubCategoria.push($(this).data('cat').Id_Subcategoria);
                                                    $(this).data('selection', true);
                                                }
                                            });
                                        }
                                        $('#WizarProducto').modal({ backdrop: 'static', keyboard: false });
                                        $('#WizarProducto').modal('show');
                                        PositionTab();
                                    }
                                }
                            });
                            //Serveis
                            $.ajax({
                                type: "POST",
                                url: "/api/interfaces/admin/IProductos.php?fun=LoadListServicios",
                                data: JSON.stringify(request),
                                cache: false,
                                dataType: "json",
                                contentType: "application/json; charset=utf-8",
                                beforeSend: function () {

                                },
                                success: function (data) {
                                    if (data.status) {
                                        var cat = $('#selectserveis');
                                        $(cat).children().remove();
                                        for (var a = 0; a < data.list.length; a++) {
                                            for (var c = 0; c < createProducto.itemdb.servicios.length; c++) {
                                                if (createProducto.itemdb.servicios[c].Id_Servicios === data.list[a].Id_Servicios) {
                                                    catActive = true;
                                                    break;
                                                } else {
                                                    catActive = false;
                                                }
                                            }
                                            var html = '';
                                            if (catActive) {
                                                html = '<li class="cat_Active"><img src="' + data.list[a].Icono + '" style="width:50px; height:auto;" /><span>' + data.list[a].Nombre + '</span></li>';
                                            } else {
                                                html = '<li><img src="' + data.list[a].Icono + '" style="width:50px; height:auto;" /><span>' + data.list[a].Nombre + '</span></li>';
                                            }
                                            var serveis = $(cat).append(html);

                                            var serveis_li = $($(serveis).children()[a]);
                                            $(serveis_li).data('cat', data.list[a]);
                                            $(serveis_li).data('selection', catActive);
                                            $(serveis_li).on('click', function () {
                                                if ($(this).data('selection')) {
                                                    $(this).removeClass('cat_Active');
                                                    createProducto.itemdb.servicios = createProducto.itemdb.servicios.filter(product => product != $(this).data('cat').Id_Servicios);
                                                    $(this).data('selection', false);
                                                } else {
                                                    $(this).addClass('cat_Active');
                                                    createProducto.itemdb.servicios.push($(this).data('cat'));
                                                    $(this).data('selection', true);
                                                }
                                            });
                                        }
                                        $('#WizarProducto').modal({ backdrop: 'static', keyboard: false });
                                        $('#WizarProducto').modal('show');
                                        PositionTab();
                                    }
                                }
                            });
                            //Imatges
                            imagenes = createProducto.itemdb.imagen;
                            AsignarImagenes();

                            $('#Titulo').val(createProducto.itemdb.Titulo);
                            CKEDITOR.instances.editor1.setData(createProducto.itemdb.Descripcion);
                            $('#garantia').val(createProducto.itemdb.anogarantia);
                            $('#desc_corta').val(createProducto.itemdb.Descripcion_corta);
                            CKEDITOR.instances.editor2.setData(createProducto.itemdb.FichaTecnica);
                            CKEDITOR.instances.editor3.setData(createProducto.itemdb.comparativa);
                            $('#Video').val(createProducto.itemdb.videourl);
                            $('#titlevideo').val(createProducto.itemdb.videotitle);
                            $('#descvideo').val(createProducto.itemdb.videodesc);
                            $('#Sage').val(createProducto.itemdb.referencia);

                            if (createProducto.itemdb.pdf != '') {
                                $('#viewpdf').css('display', 'block');
                                $('#viewpdf').data('pdf', createProducto.itemdb.pdf);
                                $('#viewpdf').on('click', function () {
                                    var win = window.open($(this).data('pdf'), '_blank');
                                    if (win) {
                                        //Browser has allowed it to be opened
                                        win.focus();
                                    } 
                                });
                            }

                            $('#SaveProduct').data('edit', true);
                        }
                    }
                });
            }
        }
    });
}

function EnterSearch(e) {
    if (e.keyCode == 13) {
        Buscar();
    }
}

function ExportDB() {
    window.open('/cms/exportDB.php?token=' + token, '_blank');
}