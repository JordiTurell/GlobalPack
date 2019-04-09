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

function LoadBox(select) {
    var op = select.options[select.selectedIndex];
    var optgroup = op.parentNode;
    alert("selected option text is:  " + op.text + " \noptGroup label is:  " + optgroup.label);

    var selected = $(select).find(":selected").data('cat');
    //var parent = $(select).parent();
    //$($(parent).find('img')[0]).attr('src', selected.Icono);
    //$($(parent).find('input')[0]).val(selected.Categoria);

  
}

$(function () {
    var listCategorias = [];
    var listFiltros = [];
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
    $.getScript("/cms/js/pages/models/requestlist.js", function (ev) {
        var request = requestlist;
        request.token = token;

        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=LoadListCategorias",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                if (data.status) {
                    listCategorias = data.list;
                    $('#cajas').find('select').each(function (i) {
                        $(this).children().remove();
                        $(this).append('<option value="0">Selecciona una categorí­a o filtro</option>');
                        $(this).append('<optgroup label="Categorías" id="Group1Box'+i+'">');
                        for (var a = 0; a < data.list.length; a++) {
                            var option = $(this).append('<option value="' + data.list[a].Id_Categoria + '" >' + data.list[a].Categoria + '</option>');
                        }
                        $(this).append('</optgroup>');
                    });

                    $.ajax({
                        type: "POST",
                        url: "/api/interfaces/admin/IProductos.php?fun=LoadListSubCategorias",
                        data: JSON.stringify(request),
                        cache: false,
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        success: function (data) {
                            if (data.status) {
                                listFiltros = data.list;
                                $('#cajas').find('select').each(function (i) {
                                    $(this).append('<optgroup label="Filtros" id="Group2Box' + i +'">');
                                    for (var a = 0; a < data.list.length; a++) {
                                        var option = $(this).append('<option value="' + data.list[a].Id_Subcategoria + '">' + data.list[a].Categoria + '</option>');
                                    }
                                    var select = $(this).append('</optgroup>');
                                    $(select).find('optgroup').each(function (a) {
                                        $(this).children().each(function (i) {
                                            if (a == 0) {
                                                $(this).data('cat', listCategorias[i]);
                                            } else {
                                                $(this).data('cat', listFiltros[i]);
                                            }
                                        });
                                    });
                                });
                            }
                        }
                    });
                }
            }
        });
    });
});