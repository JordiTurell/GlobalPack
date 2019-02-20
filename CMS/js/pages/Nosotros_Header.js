function Updatefile(fileinput) {

    var fd = new FormData();
    var files = $(fileinput)[0].files[0];
    fd.append('file', files);

    $.ajax({
        url: "/cms/img/UpdateFile.php?FOLDER=Nosotros_Header",
        type: "POST",
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        error: function (msg) {
            alert(msg);
        },
        success: function (data) {
            $('#img_header').attr('src', data);
            $(fileinput).val('');
        }
    });
}

function SaveHeader(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        var beneficio = {
            imagen: $('#img_header').attr('src'),
            texto: $('#text_header').val()
        };

        request.token = token;
        request.item = beneficio;

        $.ajax({
            url: "/api/interfaces/admin/INosotros.php?fun=SaveHeader",
            type: "POST",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            error: function (msg) {
                alert(msg);
            },
            success: function (data) {
                $('#img_header').attr('src', '/cms/img/default.png');
                $('#text_header').val('');
                if (data.status) {
                    LoadHeader(token);
                } else {
                    $('#listado').append('<div class="col-lg-12" style="text-align:center;"><h3>' + data.msg + '</h3></div>');
                }
            }
        });
    });
}

function LoadHeader(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;

        $.ajax({
            url: "/api/interfaces/admin/INosotros.php?fun=LoadHeader",
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
                    $('#img_header').attr('src', data.item.imagen);
                    $('#text_header').val(data.item.texto);
                } else {
                    $('#img_header').attr('src', '/cms/img/default.png');
                    $('#text_header').val('');
                }
            }
        });
    });
}