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

function LoadPage() {
    LoadDescripcion();
    LoadPlans();
}

function LoadDescripcion() {
    var request = {};
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IPostVenta.php?fun=LoadDescripcion",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            $('.plans').append(data.item.descripcion);
        }
    });
}

function LoadPlans() {
    var request = {};
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IPostVenta.php?fun=LoadPlans",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            var list = $('#listplanes');
            for (var a = 0; a < data.list.length; a++) {
                var code = '<div class="col-lg-4">' +
                    '<div class="col-lg-12 tipoplanoro" >' +
                    '<div class="row">' +
                    '<div class=" col-lg-12 titulo">' + data.list[a].Titulo + '</div>' +
                    '<div class=" col-lg-12 textplan">' + data.list[a].Descripcion + '</div>' +
                    '<div class="col-lg-12" style="text-align:right;">' +
                    'VER MÁS' +
                    '<img src="/assets/iconos/FLETXA_PRODUCTOS_CATEGORIAS_NEGRO.png" style="width:25px; height:25px;" />' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
                var row = $(list).append(code);
                $($($(row).children()[a]).find('.titulo')[0]).css({
                    'background-color': data.list[a].color
                });
                $($($(row).children()[a]).children()[0]).css({
                    'border-bottom': 'solid 4px '+ data.list[a].color
                });
            }
            $("html, body").animate({ scrollTop: 0 }, 1);
        }
    });
}