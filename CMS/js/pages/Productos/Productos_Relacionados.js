var token;
function LoadPage(t, id) {
    token = t;
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        request.id = id;
        LoadCategorias(request);
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=LoadProducto",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status) {
                    $('#img_producto').attr('src', data.item.imagen);
                    $('#titulo_producto').text(data.item.Titulo);
                    $('#infoproducto').data('id', data.item.Id_Producto);
                }
            }
        });

        LoadRelacionados(request);

    });
}

function LoadRelacionados(request) {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IProductos.php?fun=LoadProductoRelacionados",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            if (data.status) {
                var list = $('#list-relacionados');
                $(list).children().remove();
                for (var a = 0; a < data.list.length; a++) {
                    var code = '<div class="col-lg-12" style="margin-bottom:10px; margin-top:10px; z-index:999;"><img src="' + data.list[a].imagen + '" style="width:100px; height:auto;" />&nbsp;&nbsp;' + data.list[a].Titulo + ' <i class="fas fa-trash-alt delete_relacionados" style="float:right;"></i></div>';
                    var item = $(list).append(code);
                    $($(item).children()[a]).data('item', data.list[a]);
                    $($(item).children()[a]).draggable({ return: false });
                    $($($(item).children()[a]).find('.delete_relacionados')[0]).data('item', data.list[a]);
                    $($($(item).children()[a]).find('.delete_relacionados')[0]).on('click', function (ev) {
                        ev.preventDefault();
                        DeleteRelacionados($(this).data('item'));
                    });
                }
            }
        }
    });
}

function DeleteRelacionados(item) {
    var request = {};
    request.token = token;
    request.item = item;
    request.idficha = $('#infoproducto').data('id');

    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IProductos.php?fun=DeleteRelacionados",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            LoadRelacionados(request);
        }
    });
}

function LoadCategorias(request) {
    //Cateogrias
    LoadProductos(0);
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
                $(cat).append('<option value="0">Todas las categorías</option>');
                for (var a = 0; a < data.list.length; a++) {
                    var html = '<option value="' + data.list[a].Id_Categoria + '">' + data.list[a].Categoria + '</option>';
                    $(cat).append(html);
                }
            }
        }
    });
}

function LoadProductos(select) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        if (select == 0) {
            request.id = 0;
        } else {
            request.id = $(select).val();
        }
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=LoadProductoCategoria",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {

            },
            success: function (data) {
                if (data.status) {
                    var list = $('#list_productos');
                    $(list).children().remove();
                    for (var a = 0; a < data.list.length; a++) {
                        var code = '<div class="col-lg-12 move" style="margin-bottom:10px; margin-top:10px; z-index:999;"><img src="' + data.list[a].imagen + '" style="width:100px; height:auto;" />&nbsp;&nbsp;' + data.list[a].Titulo +'</div>';
                        var item = $(list).append(code);
                        $($(item).children()[a]).data('item', data.list[a]);
                        $($(item).children()[a]).draggable({ revert: true });
                    }
                }
                $('#relacionados').droppable({
                    drop: function (event, ui) {
                        valor = ui.draggable;
                        SetRelacionados($(valor).data('item'), valor);
                    }
                });
            }
        });
    });
}

function SetRelacionados(item, valor) {
    var request = {};
    request.token = token;
    request.idProducto = item.Id_Producto;
    request.id = $('#infoproducto').data('id');
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IProductos.php?fun=SetRelacionado",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            if (data) {
                $(valor).append('<i class="fas fa-trash-alt delete_relacionados" style="float:right;"></i>');
                $('#relacionados').append(valor);
            }
        }
    });
}