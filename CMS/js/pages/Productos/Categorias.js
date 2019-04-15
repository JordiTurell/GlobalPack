var token = '';
var ischangeicon = false;
var selectcat = null;

$(document).ready(function () {
    $('#updateicon').on('change', function () {
        ischangeicon = true;
        readURL(this);
    });
    $('#filtroscategoria').slideUp();
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#icon').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function SlideFiltros() {
    if (selectcat != null) {
        $('#filtroscategoria').slideDown();
        if ($('#filtrosrow').hasClass('fa-sort-down')) {
            $('#filtrosrow').removeClass('fa-sort-down');
            $('#filtrosrow').addClass('fa-sort-up');
        } else {
            $('#filtrosrow').removeClass('fa-sort-up');
            $('#filtrosrow').addClass('fa-sort-down');
            $('#filtroscategoria').slideUp();
        }

        $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
            var request = requestitem;
            request.token = token;
            request.categoria = selectcat;
            $.ajax({
                type: "POST",
                url: "/api/interfaces/admin/IProductos.php?fun=GetListFiltrosenCategorias",
                data: JSON.stringify(request),
                cache: false,
                dataType: "json",
                contentType: "application/json; charset=utf-8",
                success: function (data) {

                    if (data.status) {
                        var list = $('#listfiltros');
                        $(list).children().remove();
                        for (var a = 0; a < data.list.length; a++) {
                            var code = '<div class="form-check form-check-inline filtro-form" style="width:45%;"><img src="/cms/img/checked.png" style="width:18px; margin-right:5px;" /><input class="form-check-input" type="checkbox" style="display:none;"/><label class="form-check-label" for="inlineCheckbox' + a + '">' + data.list[a].Categoria.toLowerCase() +'</label></div>';
                            var row = $(list).append(code);
                            if (data.list[a].asign) {
                                $($($(row).children()[a]).find('input')[0]).prop('checked', true);
                                $($($(row).children()[a]).find('img')[0]).attr('src', '/cms/img/uncheck.png');
                            }
                            $($(row).children()[a]).data('id_filtro', data.list[a].Id_Subcategoria);
                            $($(row).children()[a]).click('on', function (ev) {
                                ev.preventDefault();
                                var idfiltro = $(this).data('id_filtro');
                                var check = $(this).find('input')[0];
                                var img = $(this).find('img')[0];
                                var request = {
                                    token: token,
                                    filtro: idfiltro,
                                    categoria: selectcat
                                };
                                $.ajax({
                                    type: "POST",
                                    url: "/api/interfaces/admin/IProductos.php?fun=AsignarFiltroCategoria",
                                    data: JSON.stringify(request),
                                    cache: false,
                                    dataType: "json",
                                    contentType: "application/json; charset=utf-8",
                                    success: function (data) {
                                        if (data.status) {
                                            $(check).prop('checked', $(check).is('checked'));
                                            if ($(img).attr('src') == '/cms/img/uncheck.png') {
                                                $(img).attr('src', '/cms/img/checked.png');
                                            } else {
                                                $(img).attr('src', '/cms/img/uncheck.png');
                                            }
                                        }
                                    }
                                });
                            });
                        }
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });

    } else {
        alert('Se tiene que seleccionar una categoría para poderle asignar los filtros correspondientes.');
    }
}

function LoadList(token) {
    this.token = token;
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IProductos.php?fun=LoadListCategorias",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {

            },
            success: function (data) {

                if (data.status) {
                    $('#listcategorias').children().remove();
                    for (var a = 0; a < data.list.length; a++) {
                        var item = '<li><img src="' + data.list[a].Icono + '" style="width:50px; height:50px;"/> &nbsp; <label>' + data.list[a].Categoria + '</label>&nbsp;';
                        if (data.list[a].Activada == 1) {
                            item += '&nbsp;&nbsp;' +
                                '<label class="switch float-right" style="margin-top:10px;">' +
                                '<input type="checkbox" checked>' +
                                '<span class="slider round"></span>' +
                                '</label>' +
                                '&nbsp;&nbsp;';
                        } else {
                            item += '&nbsp;&nbsp;' +
                                '<label class="switch float-right" style="margin-top:10px;">'+
                                    '<input type="checkbox">'+
                                        '<span class="slider round"></span>'+
                                '</label>'+
                                '&nbsp;&nbsp;';
                        }

                        $('#listcategorias').append(item);
                        $($('#listcategorias').children()[a]).data('item', data.list[a]);
                        $($($('#listcategorias').children()[a]).find('.switch')[0]).data('cat', data.list[a]);
                        $($($('#listcategorias').children()[a]).find('.switch')[0]).on('click', function (ev) {
                            ev.preventDefault();
                            var cat = $(this).data('cat');
                            var s = $(this);
                            if ($($(this).children()[0]).is(':checked')) {
                                cat.Activada = 0;
                            } else {
                                cat.Activada = 1;
                            }
                            
                            var request = { token: '', item : null };
                            request.token = token;
                            request.item = cat;
                                
                            $.ajax({
                                type: "POST",
                                url: "/api/interfaces/admin/IProductos.php?fun=ActiveCategorias",
                                data: JSON.stringify(request),
                                cache: false,
                                dataType: "json",
                                contentType: "application/json; charset=utf-8",
                                success: function (data) {
                                    if (data.status) {
                                        if (cat.Activada === 1) {
                                            $($(s).find('input')[0]).prop('checked', true);
                                        } else {
                                            $($(s).find('input')[0]).prop('checked', false);
                                        }
                                    }
                                }
                            });
                        });
                        $($('#listcategorias').children()[a]).on('click', function () {
                            var item = $(this).data('item');
                            selectcat = item;
                            SlideFiltros();
                            $('#SaveCat').data('id', item.Id_Categoria);
                            $('#Nombre').val(item.Categoria);
                            $('#Descripcion').val(item.Descripcion);
                            $('#icon').attr('src', item.Icono);
                        });

                        $('#listcategorias').disableSelection();
                        $('#listcategorias').children().each(function (index) {
                            $(this).data('item', data.list[index]);
                            $(this).data('token', token);
                            $(this).css('cursor', 'all-scroll');
                        });
                        $('#listcategorias').sortable({
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
                                    url: "/api/interfaces/admin/IProductos.php?fun=SortableCategoria",
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
                                            window.location.reload();
                                        } else {
                                            $('#listado').children().remove();
                                            $('#listado').append('<div class="col-lg-12" style="text-align:center;"><h3>' + data.msg + '</h3></div>');
                                        }
                                    }
                                });
                            }
                        });
                        $('#listcategorias').disableSelection();
                    }
                } else {
                    alert(data.msg);
                }
            },
            error: function (request, status, error) {
                alert('Error');
            }
        });
    });
}

function ReloadForm() {
    $('#Nombre').val('');
    $('#Descripcion').val('');
    $('#icon').attr('src', '/cms/img/default.png');
    selectcat = null;
}

function SaveCategoria(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        var t = token;
        request.item = {
            Nombre: $('#Nombre').val(),
            Descripcion: $('#Descripcion').val()
        };

        var file = $('#updateicon')[0].files[0];
        if ($(this).data('id') !== '00000000-0000-0000-0000-000000000000') {
            request.item.Id_Categoria = $('#SaveCat').data('id');
            if (ischangeicon) {
                upload = new Upload(file, request, true);
                upload.doUpload();
            } else {
                request.item.Icono = $('#icon').attr('src');
                EditCat(request, null);
            }
        } else {
            upload = new Upload(file, request, false);
            upload.doUpload();
        }
    });
}

function EditCat(request, upload) {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IProductos.php?fun=SaveCategoria",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {

            if (data.status) {
                upload = null;
                location.reload();
            } else {
                alert(data.msg);
            }
        },
        error: function (request, status, error) {
            alert('Error');
        }
    });
}

var Upload = function (file, request, isedit) {
    this.file = file;
    this.request = request;
    this.edit = isedit;
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
    formData.append("upload_file", true);
    formData.append("token", token);
    if (ischangeicon) {
        formData.append("edit", ischangeicon);
        formData.append("nombre", $('#icon').attr('src').split('/')[6].split('.')[0]);
        formData.append("edit", ischangeicon);
    }
    
    $.ajax({
        type: "POST",
        url: "/cms/img/UpdateFile.php?FOLDER=icon-categorias-productos",
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,

        success: function (data) {
            // your callback here
            var date = new Date();
            $('#icon').attr('src', data.replace("Error", "") + '?d=' + date.getTime());
            upload.request.item.Icono = data;
            EditCat(upload.request);
        },
        error: function (error) {
            // handle error
        }
    });
};

Upload.prototype.progressHandling = function (event) {
    var percent = 0;
    var position = event.loaded || event.position;
    var total = event.total;
    var progress_bar_id = "#progress-wrp";
    if (event.lengthComputable) {
        percent = Math.ceil(position / total * 100);
    }
    // update progressbars classes so it fits your code
    $(progress_bar_id + " .progress-bar").css("width", +percent + "%");
    $(progress_bar_id + " .status").text(percent + "%");
};