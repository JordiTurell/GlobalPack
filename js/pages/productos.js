var filtroschecked = [];
var list = null;
var cat = null;

function LoadCategoriasProductos() {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadCategoriasProductos",
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
                    '<div class="cat-vermas">VER MAS <img src="/assets/iconos/FLETXA_PRODUCTOS_CATEGORIAS_NEGRO.png" style="width:25px; height:25px;" /> </div>' +
                    '<div class="info-cat">' +
                    '<div class="title-cat">' + data.list[a].Categoria + '</div>' +
                    '<div class="desc-cat">' + data.list[a].Descripcion + '</div>' +
                    '<div class="cat-vermas">VER MAS <img src="/assets/iconos/FLETXA_PRODUCTOS_CATEGORIAS_BLANCA.png" style="width:25px; height:25px;" /> </div>' +
                    '</div>' +
                    '</div>';
                var item = $(header).append(code);
                $($($(item).children()[a])[0]).data('cat', data.list[a]);
                $($($(item).children()[a])[0]).on('click', function (ev) {
                    ev.preventDefault();
                    var cat = $(this).data('cat');
                    window.location.href = "/Productos/Home.php?Cat=" + cat.Id_Categoria;
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


function LoadHomeProductos(id) {
    LoadColumLeft(id);
    Filtros(id);
    Productos(id);
    filtroschecked = [];
}

function Productos(id) {
    var request = { uuid: id };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadProductosCat",
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
                    $(content).append(code);
                }
            }
        }
    } else {
        for (a = 0; a < list.length; a++) {
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

function LoadColumLeft(id) {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadCategoriasProductos",
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
                if (id == data.list[a].Id_Categoria) {
                    cat = data.list[a];
                    code = '<li class="cat-active"><img src="' + data.list[a].Icono + '" /> <span>' + data.list[a].Categoria + '</span>';
                    item = $(header).append(code);
                } else {
                    code = '<li><img src="' + data.list[a].Icono + '" /> <span>' + data.list[a].Categoria + '</span>';
                    item = $(header).append(code);
                    $($($(item).children()[a])[0]).data('cat', data.list[a]);
                    $($($(item).children()[a])[0]).on('click', function (ev) {
                        ev.preventDefault();
                        var cat = $(this).data('cat');
                        window.location.href = "/Productos/Home.php?Cat=" + cat.Id_Categoria;
                    });
                }
            }
        }
    });
}

function Filtros(id) {
    var urlapi = '';
    
    $.ajax({
        type: "GET",
        url: '/api/interfaces/web/IProductos.php?fun=LoadFiltrosConsumibles&cat='+id,
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            var ul = $('#list-filtros');
            for (var a = 0; a < data.list.length; a++) {
                var code = '<div class="form-check form-check-inline filtro-form">'+
                    '<input class="form-check-input" type="checkbox" id="inlineCheckbox'+ a +'" value= "' + data.list[a].Id_Subcategoria +'" >'+
                    '<label class="form-check-label" for="inlineCheckbox'+ a +'">' + data.list[a].Categoria +'</label>'+
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
                        $($(this).find('input')[0]).prop('checked', false);
                        CreateListProductos(list);
                    } else {
                        filtroschecked.push(cat);
                        $($(this).find('input')[0]).prop('checked', true);
                        CreateListProductos(list);
                    }
                });
                $($($($(item).children()[a])[0]).find('input')[0]).data('cat', data.list[a]);
                $($($($(item).children()[a])[0]).find('input')[0]).on('click', function (ev) {
                    ev.preventDefault();
                    var cat = $(this).data('cat');
                    if (IscheckedFiltro(cat)) {
                        filtroschecked = $.grep(filtroschecked, function (value) {
                            return value != cat;
                        });
                        CreateListProductos(list);
                        $(this).prop('checked', $(this).prop('checked'));
                        return;
                    } else {
                        filtroschecked.push(cat);
                        CreateListProductos(list);
                        $(this).prop('checked', $(this).prop('checked'));
                        return;
                    }
                });
            }
        }
    });

}

function IscheckedFiltro(cat) {
    for (var a = 0; a < filtroschecked.length; a++) {
        if (filtroschecked[a].Id_Subcategoria == cat.Id_Subcategoria) {
            return true;
        }
    }
    return false;
}