var token = '';
var titulolength = 31;
var desclength = 112;

function LoadHomeWeb(t) {
    token = t;
    LoadTextHome(t);
    LoadBoxHome(t);
}

function LoadBoxHome(t) {
    var request = {
        token: t
    };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IHomeWeb.php?fun=LoadBox",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            if (data.list.length > 0) {
                var boxs = $('.item-slider');
                
                for (var a = 0; a < data.list.length; a++) {
                    $($($(boxs)[a]).find('img')[0]).attr('src', data.list[a].imagen);
                    $($(boxs)[a]).find('input').each(function (i) {
                        switch (i) {
                            case 1:
                                $(this).val(data.list[a].nombre);
                                break;
                            case 2:
                                $(this).val(data.list[a].url);
                                break;
                        }
                    });
                }
            }
        }
    });
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
    
    var selected = $($(select).find('option')[select.selectedIndex]).data('cat');
    if (select.selectedIndex != 0) {
        $(select).parent().find('input').each(function (i) {
            switch (i) {
                case 1:
                    $(this).val(selected.Categoria);
                    
                    break;
                case 2:
                    if (selected.Id_Categoria != '') {
                        $(this).val('Productos/Home.php?Cat=' + selected.Id_Categoria);
                        $(this).prop('disabled', true);
                    } else {
                        $(this).val('Productos/postventa.php?Cat=' + selected.Id_Subcategoria);
                        $(this).prop('disabled', true);
                    }
                    break;
            }
        });
        $(select).parent().find('img').each(function () {
            $(this).attr('src', selected.Icono);
        });
    } else {
        $(select).parent().find('img').each(function () {
            $(this).attr('src', '/cms/img/default.png');
        });
        $(select).parent().find('input').each(function (i) {
            $(this).val('');
            $(this).prop('disabled', false);
        });
    }
}

function SaveTextHome(t) {
    var request = {
        token: t,
        titulo: $('#tituloHome').val(),
        descripcio: $('#descripcionHome').val()
    };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IHomeWeb.php?fun=SaveText",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
        }
    });
}

function LoadTextHome(t) {
    var request = {
        token: t
    };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IHomeWeb.php?fun=LoadText",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            $('#tituloHome').val(data.item.titulo);
            $('#descripcionHome').val(data.item.desc);
        }
    });
}

function SaveBox(t, box, btn) {
    var content = $(btn).parent();
    var icono = $($(content).find('img')[0]).attr('src');
    var nombre = $($(content).find('input')[1]).val();
    var url = $($(content).find('input')[2]).val();

    var request = {
        token: t,
        ico: icono,
        name: nombre,
        direccion: url,
        id: box
    };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IHomeWeb.php?fun=SaveBox",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
        }
    });
}

function UpdateFile(input) {
    var box = $(input).data('box');
    var file = $(input)[0].files[0];

    upload = new Upload(file, box);
    upload.doUpload();
}

var Upload = function (file, box) {
    this.file = file;
    this.box = box;
};

Upload.prototype.getType = function () {
    return this.file.type;
};
Upload.prototype.getSize = function () {
    return this.file.size;
};
Upload.prototype.getName = function () {
    return this.file.name;
};
Upload.prototype.doUpload = function () {
    var that = this;
    var formData = new FormData();

    // add assoc key values, this will be posts values
    formData.append("file", this.file, this.getName());
    formData.append("box", this.box);
    formData.append("token", token);
    

    $.ajax({
        type: "POST",
        url: "/cms/img/UpdateFile.php?FOLDER=icon-slider-home",
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,

        success: function (data) {
            // your callback here
            var date = new Date();
            $('#icon'+upload.box).attr('src', data.replace("Error", "") + '?d=' + date.getTime());
            upload = null;
        },
        error: function (error) {
            // handle error
        }
    });
};

Upload.prototype.progressHandling = function (event) {
   
};

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
                                    $(select).find('option').each(function (a) {
                                        if (($(select).find('option').length - 1) > a) {
                                            if (a != 0) {
                                                if (a < (listCategorias.length+1)) {
                                                    $(this).data('cat', listCategorias[(a - 1)]);
                                                } else {
                                                    $(this).data('cat', listFiltros[(a - (listCategorias.length+1))]);
                                                }
                                            }                                        
                                        } else {
                                            $(this).data('cat', listFiltros[(a - (listCategorias.length + 1))]);
                                        }
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