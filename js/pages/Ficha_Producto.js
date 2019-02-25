var show = false;
var ficha;
function Showcontact() {
    $('.title-form h1').text('¿Necesitas ayuda?');
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

function ShowcontactComprar() {
    $('.title-form h1').text('Solicitar pedido');
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

function Ficha_Producto(id) {
    var request = { uuid: id };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadProducto",
        cache: false,
        data: JSON.stringify(request),
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            ficha = data.item;
            if (data.item.imagen.length > 1) {
                alert('Crear Slider');
            } else {
                $('.imgproducto').append('<img src="'+ data.item.imagen[0] +'" style = "width:100%;" />');
            }
            $('#titleproducto').text(data.item.Titulo);
            $('#descripcion').append(data.item.Descripcion);
            $('#garantia').text(data.item.anogarantia);
            $('#ficha').append(data.item.FichaTecnica);
            $('#video').append('<iframe width="100%" height="415" src="' + data.item.videourl + '"> </iframe>');
            $('#titulovideo').text(data.item.videotitle);
            $('#descripcion-video').text(data.item.videodesc);
            $('#comparativa').append(data.item.comparativa);
            if (data.item.pdf != undefined) {
                $('#pdf').on('click', function (data) {
                    window.open(ficha.pdf);
                });
            } else {
                $('#pdf').css('display', 'none');
            }

            if (data.item.servicios != undefined) {
                for (var a = 0; a < data.item.servicios.length; a++) {
                    var code = '<img class="icono-servicios" src="' + data.item.servicios[a].Icono + '" />';
                    $('#list-serveis').append(code);
                }
            }

            for (var a = 0; a < data.item.list_relacionados.length; a++) {
                var code = '<div class="item-slider" style="margin-right:5px;"><div class="item-slider-info"><h3>' + data.item.list_relacionados[a].Titulo + '</h3><p>ver más</p></div><img src="' + data.item.list_relacionados[a].imagen + '" style="width:100%; height:auto;" /></div>';
                $('.slider_relacionados').append(code);
            }
            $('.slider_relacionados').slick({
                infinite: false,
                arrows: true,
                dots: true,
                slidesToShow: 3,
                slidesToScroll: 3
            });
        }
    });
}

function SharedMail() {
    var url = 'http://www.sharethis.com/share?url=' + window.location.href + '&title=' + ficha.Titulo + '&summary=' + ficha.Descripcion_corta + '&img=' + ficha.imagen[0];
    //window.location.href = url;
}

function SharedFacebook() {
    var url = 'https://www.facebook.com/sharer.php?u=' + window.location.href.split('//')[1];
    window.open(url);
}

function SharedTweeter() {
    var url = 'http://twitter.com/share?text=text goes here&url=' + window.location.href.split('//')[1];
    window.open(url);
}
function SharedLinkedin() {
    var url = 'https://www.linkedin.com/sharing/share-offsite/?url=' + window.location.href;
    window.open(url);
}
function Imprimir() {
    window.print();
}