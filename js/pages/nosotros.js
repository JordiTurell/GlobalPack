function LoadNosotors() {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/INosotros.php?fun=LoadCabecera",
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            
            var header = $('.cabecera-nosotros');
            $(header).css('background-image', 'url(' + data.item.imagen + ')');
            $('#texto-header').text(data.item.texto);
        }
    });

    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/INosotros.php?fun=LoadInformacion",
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            $('#textonosotros').append(data.item.text);
            $('#img-info-nosotros').attr('src', data.item.img);
        }
    });

    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/INosotros.php?fun=LoadBeneficios",
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            var list = $('#listbenificios');
            for (var a = 0; a < data.list.length; a++) {
                var code = '';
                code = '<li><img src="//'+ data.list[a].icon +'"/><p>'+ data.list[a].text +'</p></li>';
                $(list).append(code);
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

function DownSection() {
    $('html, body').animate({
        scrollTop: $("#nosotros-section").offset().top
    }, 2000);
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