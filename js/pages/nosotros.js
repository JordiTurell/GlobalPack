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
                code = '<li><img src="'+ data.list[a].icon +'"/><p>'+ data.list[a].text +'</p></li>';
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