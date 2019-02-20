$(document).ready(function () {
    CKEDITOR.replace('editor1');
});
function Updatefile(fileinput) {

        var fd = new FormData();
        var files = $(fileinput)[0].files[0];
        fd.append('file', files);

        $.ajax({
            url: "/cms/img/UpdateFile.php?FOLDER=Nosotros",
            type: "POST",
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            error: function (msg) {
                alert(msg);
            },
            success: function (data) {
                $('#imagen_nosotros').attr('src', data);
                $(fileinput).val('');
            }
        });
}

function saveNosotros(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        var nosotros = {};

        nosotros.text = CKEDITOR.instances.editor1.getData();
        nosotros.img = $('#imagen_nosotros').attr('src');

        request.token = token;
        request.item = nosotros;
        $.ajax({
            url: "/api/interfaces/admin/INosotros.php?fun=SaveNosotros",
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
                window.location.replace("/cms/principal.php");
            }
        });
    });
}

function LoadNosotros(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        
        request.token = token;
        $.ajax({
            url: "/api/interfaces/admin/INosotros.php?fun=LoadNosotros",
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

                $('#imagen_nosotros').attr('src', "//"+data.item.img);
                $('#editor1').val(data.item.text);
            }
        });
    });
}