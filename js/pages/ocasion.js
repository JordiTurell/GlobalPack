
function LoadOcasion(t) {
    var request = { uuid: t };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IProductos.php?fun=LoadOcasion",
        cache: false,
        data: JSON.stringify(request),
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            console.log(data);
            CreateListProductos(data.list);
        }
    });
}

function CreateListProductos(list) {
    var content = $('#list-ocasion');
    $(content).children().remove();
    var a = 0;
    var code = '';
    var item = null;

    for (a = 0; a < list.length; a++) {
        code = '<div class="col-lg-4 text-center">' +
            '<div class="item-producto-ocasion">'+
            '<h1>Ocasion</h1>'+
            '<img src="' + list[a].imagen[0] + '" style="width:100%"; />' +
            '<h3>' + list[a].Titulo + '</h3>' +
            '<p>' + list[a].Descripcion_corta + '</p>' +
            '<div><label class="pvp_ocasion">' + list[a].PVP_Ocasion + '€</label> &nbsp; <label class="pvp">' + list[a].PVP + '€</label></div>' +
            '<div style="width:100%; position:relative; display:block; height:35px;">'+
            '<div class="anogarantia">' + list[a].anogarantia + '</div>' +
            '<div class="vermas"><span>VER MAS</span><img src="/assets/iconos/flecharoja.png" style="border:none; width:8px; margin-left:5px;" /></div>' +
            '</div>' +
            '</div>' +
            '</div>';
        
        item = $(content).append(code);
        $($(item).children()[a]).data('item', list[a]);
        $($(item).children()[a]).on('click', function (ev) {
            ev.preventDefault();
            var producto = $(this).data('item');
            $.redirect('/Productos/Ficha.php', producto);
        });
    }
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