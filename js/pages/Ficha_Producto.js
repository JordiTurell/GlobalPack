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

function onBack() {
    window.history.back();
}

function Compartir() {
    $('#ModalCompartir').modal('show');
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

function ChangeStyleTab(index) {
    $('.nav-tabs').children().each(function () {
        $(this).css('border-bottom', 'solid 4px #9b9b9b');
    });
    $($('.nav-tabs').children()[index]).css('border-bottom', 'solid 4px #ef3340');
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
                CreateSlider(data);
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

            if (data.item.FichaTecnica == "") {
                $('#tab_fichaTecnica').css('display', 'none');
                $('#ficha').css('display', 'none');
            }

            if (data.item.videourl == "") {
                $('#tab_video').css('display', 'none');
                $('#content-video').css('display', 'none');
            }

            if (data.item.comparativa == "") {
                $('#tab_comparativa').css('display', 'none');
                $('#comparativa').css('display', 'none');
            }

            if (data.item.list_relacionados.length > 0) {
                for (var a = 0; a < data.item.list_relacionados.length; a++) {
                    var code = '<div class="item-slider" style="margin-right:5px;"><div class="item-slider-info"><h3>' + data.item.list_relacionados[a].Titulo + '</h3><p>ver más</p></div><img src="' + data.item.list_relacionados[a].imagen + '" style="width:100%; height:auto;" /></div>';
                    var item = $('.slider_relacionados').append(code);
                    $($(item).children()[a]).data('producte', data.item.list_relacionados[a]);
                    $($(item).children()[a]).on('click', function () {
                        var producto = $(this).data('producte');
                        $.redirect('/Productos/Ficha.php', producto);
                    });
                }
                $('.slider_relacionados').slick({
                    infinite: false,
                    arrows: true,
                    dots: true,
                    slidesToShow: 3,
                    slidesToScroll: 3
                });
            } else {
                $('#product_relacionados').css('display', 'none');
            }
        }
    });
}

function CreateSlider(data) {
    var code = '<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">' +
        '<div class="carousel-inner" > ';
    for (var a = 0; a < data.item.imagen.length; a++) {
        if (a == 0) {
            code += '<div class="carousel-item active">' +
                '<img class="d-block w-100" src="' + data.item.imagen[a] + '" />' +
                '</div>';
        } else {
            code += '<div class="carousel-item">' +
                '<img class="d-block w-100" src="' + data.item.imagen[a] + '" />' +
                '</div>';
        }
    }
            
        code += '</div>'+
                '<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">'+
                    '<span class="carousel-control-prev-icon" aria-hidden="true"></span>'+
                    '<span class="sr-only">Previous</span>'+
                '</a>'+
                '<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">'+
                    '<span class="carousel-control-next-icon" aria-hidden="true"></span>'+
                    '<span class="sr-only">Next</span>'+
                    '</a>'+
        '</div>';
    $('.imgproducto').append(code);
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