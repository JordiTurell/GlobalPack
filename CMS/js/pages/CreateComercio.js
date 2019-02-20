
function SaveTmpLogo(fileinput) {
    var fd = new FormData();
    var files = $(fileinput)[0].files[0];
    fd.append('file', files);

    $.ajax({
        url: "/cms/img/UpdateFile.php?FOLDER=Logos",
        type: "POST",
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        error: function (msg) {
            alert(msg);
        },
        success: function (data) {
            $('#logotipo').attr('src', data);
            $(fileinput).val('');
        }
    });
}

function SaveComercio(token) {
    
    if ($('#nombre').val() != "") {
        if ($('#latitud').val() != "") {
            if ($('#longitud').val() != "") {
                $.getScript("/cms/js/pages/models/Comercio.js", function () {
                    var Comercio = comercio();
                    Comercio.Nombre = $('#nombre').val();
                    Comercio.Descripcion = $('#descripcion').val();
                    Comercio.Direccion = $('#direccion').val();
                    Comercio.Latitud = $('#latitud').val();
                    Comercio.Longitud = $('#longitud').val();
                    Comercio.Telefono = $('#telefono').val();
                    Comercio.Email = $('#email').val();
                    Comercio.Web = $('#web').val();
                    Comercio.Facebook = $('#facebook').val();
                    Comercio.Twitter = $('#twitter').val();
                    Comercio.Instagram = $('#instagram').val();
                    Comercio.Logo.Tmp_Logo = $('#logotipo').attr('src');
                    $.getScript("/cms/js/pages/models/requestitem.js", function () {
                        var request = requestitem;
                        request.item = Comercio;
                        request.token = token;
                        $.ajax({
                            url: "/api/interfaces/admin/IComercio.php?fun=CreateComercio",
                            type: "POST",
                            data: JSON.stringify(request),
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                $('#ModalLoading').modal('show');
                            },
                            success: function (data) {
                                window.location.href = "/cms/comercios/Listar.php";
                            }
                        });
                    });
                });
            } else {
                $('#msgerror').text('');
                $('#msgerror').text('Introducir la latitud del establecimiento');
                $('#ModalError').modal('show');
            }
        } else {
            $('#msgerror').text('');
            $('#msgerror').text('Introducir la latitud del establecimiento');
            $('#ModalError').modal('show');
        }
    }else {
        $('#msgerror').text('');
        $('#msgerror').text('Introducir un nombre del establecimiento');
        $('#ModalError').modal('show');
    }
}