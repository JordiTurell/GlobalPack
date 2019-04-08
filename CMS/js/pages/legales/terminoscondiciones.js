$(document).ready(function () {
    CKEDITOR.replace('editor1');
});

function SaveTerminosCondiciones(token, tipo) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        var nosotros = {};
        nosotros.tipo = tipo;
        nosotros.text = CKEDITOR.instances.editor1.getData();
        request.token = token;
        request.item = nosotros;
        $.ajax({
            url: "/api/interfaces/admin/ILegales.php?fun=SaveTerminosCondiciones",
            type: "POST",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                window.location.replace("/cms/principal.php");
            }
        });
    });
}

function LoadTerminosCondiciones(token, tipo) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.tipo = tipo;
        request.token = token;
        $.ajax({
            url: "/api/interfaces/admin/ILegales.php?fun=LoadTerminosCondiciones",
            type: "POST",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                $('#editor1').val(data.item);
            }
        });
    });
}