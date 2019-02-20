function CrateAdmin(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;

        var admin = {};
        $('#admin').serializeArray().map(function (x) { admin[x.name] = x.value; });
        request.token = token;
        request.item = admin;

        if (request.item.contrasenya != "") {
            if (request.item.recontrasenya != "") {
                if (request.item.contrasenya === request.item.recontrasenya) {
                    if (request.item.login != "") {
                        if (request.item.Nombre != "") {
                            if (request.item.Apellidos != "") {
                                $.ajax({
                                    url: '/api/interfaces/admin/IAdmin.php?fun=CreateAdmin',
                                    type: "POST",
                                    data: JSON.stringify(request),
                                    cache: false,
                                    dataType: "json",
                                    contentType: "application/json; charset=utf-8",
                                    beforeSend: function () {
                                        $('#ModalLoading').modal('show');
                                    },
                                    success: function (data) {
                                        if (data.status) {
                                            window.location.href = "/cms/pages/administradores/Listar.php";
                                        } else {
                                            $('#ModalLoading').modal('hide');
                                            $('#msgerror').text('');
                                            $('#msgerror').text(data.msg);
                                            $('#ModalError').modal('show');
                                        }
                                    },
                                    error: function (request, status, error) {
                                        
                                        $('#msgerror').text('');
                                        $('#msgerror').text('Error al crear el administrador');
                                        $('#ModalLoading').modal('hide');
                                        $('#ModalError').modal('show');
                                    }
                                });
                            } else {
                                $('#msgerror').text('');
                                $('#msgerror').text('Falta poner los apellidos');
                                $('#ModalError').modal('show');
                            }
                        } else {
                            $('#msgerror').text('');
                            $('#msgerror').text('Falta poner un nombre');
                            $('#ModalError').modal('show');
                        }
                    } else {
                        $('#msgerror').text('');
                        $('#msgerror').text('Introducir un login');
                        $('#ModalError').modal('show');
                    }
                } else {
                    $('#msgerror').text('');
                    $('#msgerror').text('Las contraseñas no coinciden');
                    $('#ModalError').modal('show');
                }
            } else {
                $('#msgerror').text('');
                $('#msgerror').text('Hay que repetir la contraseña');
                $('#ModalError').modal('show');
            }
        } else {
            $('#msgerror').text('');
            $('#msgerror').text('Falta poner la contraseña');
            $('#ModalError').modal('show');
        }
    });
}