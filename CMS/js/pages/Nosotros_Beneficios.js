
function LoadItems(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        var t = token;
        $.ajax({
            url: "/api/interfaces/admin/INosotros.php?fun=LoadBeneficios",
            type: "POST",
            data: JSON.stringify(request)
            ,
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            error: function (msg) {
                alert(msg);
            },
            success: function (data) {
                if (data.status) {
                    LoadBeneficios(data.list, t);
                } else {
                    $('#listado').append('<div class="col-lg-12" style="text-align:center;"><h3>'+ data.msg +'</h3></div>');
                }
            }
        });
    });
}

function LoadBeneficios(items, token) {
    $('#listado').children().remove();
    for (var a = 0; a < items.length; a++) {
        var code = '';
        code += '<li id="'+ a +'">' +
            '<img src="//' + items[a].icon + '" />' +
            '<span>' + items[a].text + '</span>' +
            
            '<i class="fas fa-trash" onclick="DeleteBeneficio(' + items[a].id + ', \'' + token + '\');" style="cursor:pointer;"></i>' +
            '<i class="fas fa-arrows-alt"></i>'+
        
            '</li>';
        $('#listado').append(code);
    }

    $('#listado').disableSelection();
    $('#listado').children().each(function (index) {
        $(this).data('item', items[index]);
        $(this).data('token', token);
        $(this).css('cursor', 'all-scroll');
    })

    //$('#listado').selectable();
    $('#listado').sortable({
        axis: 'y',
        placeholder: "ui-state-highlight",
        start: function (e, ui) {
            // creates a temporary attribute on the element with the old index
            $(this).attr('data-previndex', ui.item.index());
        },
        update: function (event, ui) {
            var newIndex = ui.item.index();
            var oldIndex = $(this).attr('data-previndex');
            $(this).removeAttr('data-previndex');
            var item = $($(ui.item)[0]).data('item');
            
            var request = {
                token: $(ui.item).data('token'),
                newindex: newIndex,
                item: $(ui.item).data('item')
            };
            
            $.ajax({
                url: "/api/interfaces/admin/INosotros.php?fun=SortableBeneficios",
                type: "POST",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                error: function (msg) {
                    alert(msg);
                },
                success: function (data) {
                    if (data.status) {
                        LoadBeneficios(data.list, token);
                    } else {
                        $('#listado').children().remove();
                        $('#listado').append('<div class="col-lg-12" style="text-align:center;"><h3>' + data.msg + '</h3></div>');
                    }
                }
            });
        }
    });
    $('#listado').disableSelection();
}

function DeleteBeneficio(id, token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;

        request.token = token;
        request.item = id;
        $.ajax({
            url: "/api/interfaces/admin/INosotros.php?fun=DeleteBeneficios",
            type: "POST",
            data: JSON.stringify(request)
            ,
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            error: function (msg) {
                alert(msg);
            },
            success: function (data) {
                if (data.status) {
                    LoadBeneficios(data.list, token);
                } else {
                    $('#listado').children().remove();
                    $('#listado').append('<div class="col-lg-12" style="text-align:center;"><h3>' + data.msg + '</h3></div>');
                }
            }
        });
    });
}

function Updatefile(fileinput) {

    var fd = new FormData();
    var files = $(fileinput)[0].files[0];
    fd.append('file', files);

    $.ajax({
        url: "/cms/img/UpdateFile.php?FOLDER=Nosotros_Beneficios",
        type: "POST",
        data: fd,
        cache: false,
        contentType: false,
        processData: false,
        error: function (msg) {
            alert(msg);
        },
        success: function (data) {
            $('#icono').attr('src', data);
            $(fileinput).val('');
        }
    });
}

function SaveBeneficio(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        var beneficio = {
            icono: $('#icono').attr('src'),
            texto: $('#beneficio_text').val()
        };

        request.token = token;
        request.item = beneficio;

        $.ajax({
            url: "/api/interfaces/admin/INosotros.php?fun=SaveBeneficios",
            type: "POST",
            data: JSON.stringify(request)
            ,
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            error: function (msg) {
                alert(msg);
            },
            success: function (data) {
                $('#icono').attr('src', '/cms/img/default.png');
                $('#beneficio_text').val('');
                if (data.status) {
                    LoadBeneficios(data.list, token);
                } else {
                    $('#listado').append('<div class="col-lg-12" style="text-align:center;"><h3>' + data.msg + '</h3></div>');
                }
            }
        });
    });
}