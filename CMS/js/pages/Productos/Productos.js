var token = '';
var tabposition = 1;
var imagenes = [];
var createProducto = new Object();

function LoadWizard() {
    tabposition = 1;
    createProducto = new Object();
    createProducto.categorias = [];
    createProducto.filtres = [];
    createProducto.serveis = [];
    createProducto.imagenes = [];

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
            beforeSend: function () {

            },
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
            '<div class="col-lg-2">' + data.list[a].relacionados + '&nbsp; <input type="button" class="btn" value="Agregar Producto" style="float:right;" /></div>';
        if (data.list[a].home == 1) {
            code += '<div class="col-lg-1"> &nbsp;&nbsp; ' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox" checked>' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        } else {
            code += '<div class="col-lg-1"> &nbsp;&nbsp; ' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox">' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        }
        if (data.list[a].Ocasion == 1) {
            code += '<div class="col-lg-1"> &nbsp;&nbsp; ' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox" checked>' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        } else {
            code += '<div class="col-lg-1"> &nbsp;&nbsp; ' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox">' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        }
        if (data.list[a].Habilitado == 1) {
            code += '<div class="col-lg-1"> &nbsp;&nbsp; ' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox" checked>' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        } else {
            code += '<div class="col-lg-1"> &nbsp;&nbsp; ' +
                '<label class="switch float-right" style="margin-top:10px;">' +
                '<input type="checkbox">' +
                '<span class="slider round"></span>' +
                '</label>' +
                '&nbsp;&nbsp;</div>';
        }
        code += '</div>';
        var fila = $(body).append(code);

        var relacionado = $($(fila).children()[a]).find('input')[0];
        var home = $($(fila).children()[a]).find('.col-lg-1')[2];
        var ocasion = $($(fila).children()[a]).find('.col-lg-1')[3];
        var habilitado = $($(fila).children()[a]).find('.col-lg-1')[4];

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
    }
    paginacion(data);
}

function paginacion(list) {
    $('.pagination').children().remove();
    var pages = $('.pagination');
    var paginas = 1;
    
    paginas = list.total / list.items;
    
    console.log(paginas);
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
                LoadList(token, $(this).data('pagina'));
            });
        } else {
            item = '<li class="paginate_button previous disabled" id="example2_previous">' +
                '<span>' + (a+1) + '</span>' +
                '</li>';
            row = $(pages).append(item);
            
            $($($(row).children()[a])[0]).data('pagina', list.pagina+2);
            
            $($($(row).children()[a])[0]).on('click', function (ev) {

                ev.preventDefault();
                LoadList(token, $(this).data('pagina'));
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
                        code = '<li><img src="' + data.list[a].url + '" style="width:250px;" /></li>';
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

        request.item = createProducto;
               
        var formData = new FormData();
        if ($('#pdf').prop('files') != undefined) {
            formData.append("file", $('#pdf').prop('files')[0]);
        }
        request.item.imagenes = imagenes;
        formData.append("item", request.item);
        formData.append("token", token);
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
    });
}

function Buscar() {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
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
}