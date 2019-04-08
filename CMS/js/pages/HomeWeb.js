var token = '';
var titulolength = 31;
var desclength = 112;

function LoadHomeWeb(t) {
    token = t;
}

function TituloKey(input) {
    var totalvalue = $(input).val().length;
    $('#titulomax').text(titulolength - totalvalue);
    if (totalvalue <= titulolength) {
        if ($(input).hasClass('is-invalid')) {
            $(input).removeClass('is-invalid');
        }
        $(input).addClass('is-valid');
    } else {
        $(input).addClass('is-invalid');
    }
}

function DescripcioKey(input) {
    var totalvalue = $(input).val().length;
    $('#descmax').text(desclength - totalvalue);

    if (totalvalue <= desclength) {
        if ($(input).hasClass('is-invalid')) {
            $(input).removeClass('is-invalid');
        }
        $(input).addClass('is-valid');
    } else {
        $(input).addClass('is-invalid');
    }
}

$(function () {
    $('#tituloHome').bind("keypress keyup keydown", function (event) {
        var ekeyCode = event.keyCode;
        switch (ekeyCode) {
            case 8:
                var totalvalue = $('#tituloHome').val().length-1;
                $('#titulomax').text(titulolength - totalvalue);
                if (totalvalue <= desclength) {
                    if ($('#tituloHome').hasClass('is-invalid')) {
                        $('#tituloHome').removeClass('is-invalid');
                    }
                    $('#tituloHome').addClass('is-valid');
                } else {
                    $('#tituloHome').addClass('is-invalid');
                }
                break;
        }
    });
    $('#descripcionHome').bind("keypress keyup keydown", function (event) {
        var ekeyCode = event.keyCode;
        switch (ekeyCode) {
            case 8:
                var totalvalue = $('#descripcionHome').val().length - 1;
                $('#descmax').text(desclength - totalvalue);
                if (totalvalue <= desclength) {
                    if ($('#descripcionHome').hasClass('is-invalid')) {
                        $('#descripcionHome').removeClass('is-invalid');
                    }
                    $('#descripcionHome').addClass('is-valid');
                } else {
                    $('#descripcionHome').addClass('is-invalid');
                }
                break;
        }
    });
});