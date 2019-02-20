var token = '';
function LoadList(token) {
    this.token = token;
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        var t = token;

        $.ajax({
            url: "/api/interfaces/admin/IBlog.php?fun=ListPosts",
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
                    var content = $('.box-body');
                    if ($(content).children().length > 0){
                        $(content).children().remove();
                    }
                    var code = '';
                    code = '<div class="row">' +
                        '<div class="col-lg-2 title-table">Título</div>' +
                        '<div class="col-lg-2 title-table">Fecha de Creación</div>' +
                        '<div class="col-lg-1 title-table">Activado</div>' +
                        '<div class="col-lg-2 title-table">Opciones</div>' +
                        '<div>';
                    $(content).append(code);
                    for (var a = 0; a < data.list.length; a++) {
                        code = '<div class="row">' +
                            '<div class="col-lg-2">' + data.list[a].Titulo + '</div>' +
                            '<div class="col-lg-2">' + data.list[a].FechaC + '</div>';
                        if (data.list[a].Activado == 1) {
                            code += '<div class="col-lg-1"><i class="fas fa-check-circle" style="color:#27843e; cursor:pointer;"></i></div>';
                        } else {
                            code += '<div class="col-lg-1"><i class="fas fa-times-circle" style="color:red; cursor:pointer;"></i></div>';
                        }
                            
                            code += '<div class="col-lg-2"><i class="fas fa-edit" style="cursor:pointer;"></i>&nbsp;&nbsp;<i class="fas fa-trash-alt" style="cursor:pointer;"></i> </div>'+
                            '<div>';
                        var item = $(content).append(code);
                        var icons = $($(item).children()[a + 1]).find('i');
                        //Activar
                        $(icons[0]).data('item', data.list[a]);
                        //Editar
                        $(icons[1]).data('item', data.list[a]);
                        //Eliminar
                        $(icons[2]).data('item', data.list[a]);
                        //Onclick Activar
                        $(icons[0]).on('click', function () {
                            Activar($(this).data('item'));
                        });
                        //Onclick Editar
                        $(icons[1]).on('click', function () {
                            window.location.replace("/cms/pages/blog/create_post.php?Id=" + $(this).data('item').idBlog);
                        });
                        //Onclick Eliminar
                        $(icons[2]).on('click', function () {
                            $('#ModalDeletePost').modal('show');
                            $('#ModalDeletePost').data('item', $(this).data('item'));
                        });
                    }
                } else {
                    alert(data.msg);
                }
            }
        });
    });
}

function Eliminar() {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        request.item = $('#ModalDeletePost').data('item');
        var t = token;

        $.ajax({
            url: "/api/interfaces/admin/IBlog.php?fun=DeletePost",
            type: "POST",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            error: function (msg) {
                alert(msg);
            },
            success: function (data) {
                $('#ModalDeletePost').modal('hide');
                LoadList(token);
            }
        });
    });
}

function Activar(item) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        request.item = item;
        var t = token;

        $.ajax({
            url: "/api/interfaces/admin/IBlog.php?fun=ActivarPost",
            type: "POST",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            error: function (msg) {
                alert(msg);
            },
            success: function (data) {
                LoadList(token);
            }
        });
    });
}