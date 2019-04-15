var filtroschecked = new Array();
var servicioschecked = new Array();
var list = null;
var cat = null;

function LoadCategoriasOcasion() {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadCategoriasOcasion",
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            var header = $('#listbenificios');
            for (var a = 0; a < data.list.length; a++) {
                var code = '<div class="categoria-item">' +
                    '<img src="' + data.list[a].Icono + '" /><br/>' +
                    '<div>' + data.list[a].Categoria + '</div>' +
                    '<div class="cat-vermas">VER MAS <img src="/assets/iconos/FLETXA_PRODUCTOS_CATEGORIAS_NEGRO.png" style="width:25px; height:25px; margin-top:0px;" /> </div>' +
                    '<div class="info-cat">' +
                    '<div class="title-cat">' + data.list[a].Categoria + '</div>' +
                    '<div class="desc-cat">' + data.list[a].Descripcion + '</div>' +
                    '<div class="cat-vermas">VER MAS <img src="/assets/iconos/FLETXA_PRODUCTOS_CATEGORIAS_BLANCA.png" style="width:25px; height:25px; margin-top:0px;" /> </div>' +
                    '</div>' +
                    '</div>';
                var item = $(header).append(code);
                $($($(item).children()[a])[0]).data('cat', data.list[a]);
                $($($(item).children()[a])[0]).on('click', function (ev) {
                    ev.preventDefault();
                    var cat = $(this).data('cat');
                    window.location.href = "/Productos/postventa.php?Cat=" + cat.Id_Subcategoria;
                });
            }
        }
    });
}

var show = false;
function Showcontact() {
    if (show) {
        $('.form-popup-contacto').addClass('form-popup-contacto-desactive');
        $('.form-popup-contacto').removeClass('form-popup-contacto-active');
        show = false;
    } else {
        $('.form-popup-contacto').removeClass('form-popup-contacto-desactive');
        $('.form-popup-contacto').addClass('form-popup-contacto-active');
        show = true;
    }
}


function LoadHomePostVenta(id) {
    LoadColumLeft(id);
    Filtros(id);
    Productos(id);
    LoadServicios(id);
    filtroschecked = [];
}

function Productos(id) {
    var request = { uuid: id };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadProductosPostVenta",
        cache: false,
        data: JSON.stringify(request),
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            list = data.list;
            CreateListProductos(data.list);
        }
    });
}

function CreateListProductos(list) {
    var content = $('.productes');
    $(content).children().remove();
    var a = 0;
    var code = '';

    if (filtroschecked.length > 0) {
        for (var b = 0; b < filtroschecked.length; b++) {
            for (a = 0; a < list.length; a++) {
                if (filtroschecked[b].Id_Subcategoria == list[a].Id_SubCategoria) {
                    if (servicioschecked.length > 0) {
                        for (var c = 0; c < servicioschecked.length; c++) {
                            for (var d = 0; d < list[a].servicios.length; d++) {
                                if (list[a].servicios[d] == servicioschecked[c].Id_Servicios) {
                                    if (list[a].Ocasion == 0) {
                                        code = '<div class="col-lg-4 text-center item-producto-list">' +
                                            '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
                                            '<h3>' + list[a].Titulo + '</h3>' +
                                            '<p>' + list[a].Descripcion_corta + '</p>' +
                                            '</div>';
                                    } else {
                                        code = '<div class="col-lg-4 text-center item-producto-list">' +
                                            '<h1>Ocasion</h1>' +
                                            '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
                                            '<h3>' + list[a].Titulo + '</h3>' +
                                            '<p>' + list[a].Descripcion_corta + '</p>' +
                                            '</div>';
                                    }
                                }
                            }
                        }
                    } else {
                        if (list[a].Ocasion == 0) {
                            code = '<div class="col-lg-4 text-center item-producto-list">' +
                                '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
                                '<h3>' + list[a].Titulo + '</h3>' +
                                '<p>' + list[a].Descripcion_corta + '</p>' +
                                '</div>';
                        } else {
                            code = '<div class="col-lg-4 text-center item-producto-list">' +
                                '<h1>Ocasion</h1>' +
                                '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
                                '<h3>' + list[a].Titulo + '</h3>' +
                                '<p>' + list[a].Descripcion_corta + '</p>' +
                                '</div>';
                        }
                    }
                    $(content).append(code);
                    var item = $(content).append(code);
                    list[a].cat = cat;
                    $($(item).children()[a]).data('item', list[a]);
                    $($(item).children()[a]).on('click', function (ev) {
                        ev.preventDefault();
                        var producto = $(this).data('item');
                        $.redirect('/Productos/Ficha.php', producto);
                    });
                }
            }
        }
    } else {
        var countitem = 0;
        for (a = 0; a < list.length; a++) {
            code = '';
            if (servicioschecked.length > 0) {
                for (var c = 0; c < servicioschecked.length; c++) {
                    for (var d = 0; d < list[a].servicios.length; d++) {
                        if (list[a].servicios[d] == servicioschecked[c].Id_Servicios) {
                            if (list[a].Ocasion == 0) {
                                code = '<div class="col-lg-4 text-center item-producto-list">' +
                                    '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
                                    '<h3>' + list[a].Titulo + '</h3>' +
                                    '<p>' + list[a].Descripcion_corta + '</p>' +
                                    '</div>';
                            } else {
                                code = '<div class="col-lg-4 text-center item-producto-list">' +
                                    '<h1>Ocasion</h1>' +
                                    '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
                                    '<h3>' + list[a].Titulo + '</h3>' +
                                    '<p>' + list[a].Descripcion_corta + '</p>' +
                                    '</div>';
                            }
                            var item2 = new Object();
                            if (code != '') {
                                item2 = $(content).append(code);
                                list[a].cat = cat;
                                $($(item2).children()[countitem]).data('item', list[a]);
                                $($(item2).children()[countitem]).on('click', function (ev) {
                                    ev.preventDefault();
                                    var producto = $(this).data('item');
                                    $.redirect('/Productos/Ficha.php', producto);
                                });
                                countitem = countitem + 1;
                            }
                        }
                    }
                }
            } else {
                if (list[a].Ocasion == 0) {
                    code = '<div class="col-lg-4 text-center item-producto-list">' +
                        '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
                        '<h3>' + list[a].Titulo + '</h3>' +
                        '<p>' + list[a].Descripcion_corta + '</p>' +
                        '</div>';
                } else {
                    code = '<div class="col-lg-4 text-center item-producto-list">' +
                        '<h1>Ocasion</h1>' +
                        '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
                        '<h3>' + list[a].Titulo + '</h3>' +
                        '<p>' + list[a].Descripcion_corta + '</p>' +
                        '</div>';
                }
                if (code != '') {
                    var item = $(content).append(code);
                    list[a].cat = cat;
                    $($(item).children()[a]).data('item', list[a]);
                    $($(item).children()[a]).on('click', function (ev) {
                        ev.preventDefault();
                        var producto = $(this).data('item');
                        $.redirect('/Productos/Ficha.php', producto);
                    });
                }
            }
        }
    }
}

function LoadColumLeft(id) {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadFiltrosProductos",
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            var header = $('#list-categorias');
            for (var a = 0; a < data.list.length; a++) {
                var code = '';
                var item = null;
                if (id == data.list[a].Id_Subcategoria) {
                    cat = data.list[a];
                    code = '<li class="cat-active" style="padding-right:0px;"><img src="' + data.list[a].Icono + '" /> <span>' + data.list[a].Categoria + '</span>';
                    item = $(header).append(code);
                } else {
                    code = '<li style="padding-right:0px;"><img src="' + data.list[a].Icono + '" /> <span>' + data.list[a].Categoria + '</span>';
                    item = $(header).append(code);
                    $($($(item).children()[a])[0]).data('cat', data.list[a]);
                    $($($(item).children()[a])[0]).on('click', function (ev) {
                        ev.preventDefault();
                        var cat = $(this).data('cat');
                        window.location.href = "/Productos/postventa.php?Cat=" + cat.Id_Subcategoria;
                    });
                }
            }
        }
    });
}

function Filtros(id) {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadCategoriasRelacionadasFiltrosProductos&cat="+id,
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            var ul = $('#list-filtros');
            for (var a = 0; a < data.list.length; a++) {
                var code = '<div class="form-check form-check-inline filtro-form">' +
                    '<input class="form-check-input" type="checkbox" id="inlineCheckbox' + a + '" value= "' + data.list[a].Id_Categoria + '" >' +
                    '<label class="form-check-label" for="inlineCheckbox' + a + '">' + data.list[a].Categoria + '</label>' +
                    '</div >';
                var item = $(ul).append(code);
                $($($(item).children()[a])[0]).data('cat', data.list[a]);
                $($($(item).children()[a])[0]).on('click', function (ev) {
                    ev.preventDefault();
                    var cat = $(this).data('cat');
                    if (IscheckedFiltro(cat)) {
                        filtroschecked = $.grep(filtroschecked, function (value) {
                            return value != cat;
                        });
                        CreateListProductos(list);
                        $($(this).find('input')[0]).prop('checked', false);
                    } else {
                        filtroschecked.push(cat);
                        CreateListProductos(list);
                        $($(this).find('input')[0]).prop('checked', true);
                    }
                });
                $($($(item).children()[a]).find('input')[0]).on('click', function (ev) {
                    ev.preventDefault();
                    var cat = $(this).data('cat');
                    if (IscheckedFiltro(cat)) {
                        filtroschecked = $.grep(filtroschecked, function (value) {
                            return value != cat;
                        });
                        CreateListProductos(list);
                        $($(this).find('input')[0]).prop('checked', false);
                    } else {
                        filtroschecked.push(cat);
                        CreateListProductos(list);
                        $($(this).find('input')[0]).prop('checked', true);
                    }
                });
            }
        }
    });

}

function LoadServicios(id) {
    $.ajax({
        type: "GET",
        url: '/api/interfaces/web/IProductos.php?fun=LoadAllServicios',
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            var ul = $('#list-servicios');
            for (var a = 0; a < data.list.length; a++) {
                var code = '<li style="cursor:pointer; display:inline-block;">' +
                    '<img src="' + data.list[a].Icono + '" style="width:50px;" />' +
                    '</li>';
                var item = $(ul).append(code);
                $($($(item).children()[a])[0]).data('cat', data.list[a]);
                $($($(item).children()[a])[0]).on('click', function (ev) {
                    ev.preventDefault();
                    var cat = $(this).data('cat');
                    if (IscheckedServicio(cat)) {
                        servicioschecked = $.grep(servicioschecked, function (value) {
                            return value != cat;
                        });
                        $(this).css('border-bottom', 'none');
                        CreateListProductos(list);
                    } else {
                        servicioschecked.push(cat);
                        $(this).css('border-bottom', 'solid 2px #ef3340');
                        CreateListProductos(list);
                    }
                });
            }
        }
    });
}

function IscheckedFiltro(cat) {
    for (var a = 0; a < filtroschecked.length; a++) {
        if (filtroschecked[a] != undefined) {
            if (filtroschecked[a].Id_Categoria == cat.Id_Categoria) {
                return true;
            }
        }
    }
    return false;
}

function SendMail() {
    var request = {
        Empresa: $('#empresa').val(),
        Email: $('#email').val(),
        Provincia: $('#provincia').val(),
        Telefono: $('#telefono').val(),
        Nombre: $('#nombre').val(),
        Pais: $('#pais').val(),
        Mensaje: $('#mensaje').val()
    };
    if ($("#terminos").is(':checked')) {
        if ($('#nombre').val() != "" || $('#email').val() != "" || $('#mensaje').val() != "") {
            $.ajax({
                url: '/sendmail.php',
                type: "POST",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {

                }
            });
            $('#error').text('Gracias por contactar con nosotros. Brevemente le informaremos.');
        } else {
            $('#error').fadeIn();
            $('#error').text('Hay que rellenar todos los campos');
        }
    } else {
        $('#error').fadeIn();
        $('#error').text('Hay que aceptar los terminos legales.');
    }
}

function IscheckedServicio(cat) {
    for (var a = 0; a < servicioschecked.length; a++) {
        if (servicioschecked[a].Id_Servicios == cat.Id_Servicios) {
            return true;
        }
    }
    return false;
}