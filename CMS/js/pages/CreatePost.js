var imagenes = [];
var post = null;

function ShowMultimedia(token) {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        var t = token;

        $.ajax({
            url: "/api/interfaces/admin/IBlog.php?fun=LoadFiles",
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
                    $('#listimagenes').children().remove();
                    for (var a = 0; a < data.list.length; a++) {
                        var code = "";
                        code = '<li><img src="' + data.list[a].url + '" /></li>';
                        var item = $('#listimagenes').append(code);
                        for (var b = 0; b < imagenes.length; b++) {
                            if (imagenes[b] == data.list[a].url) {
                                $($(item).children()[a]).addClass('imgActive');
                                $($(item).children()[a]).data('select', true);
                            }
                        }
                        
                        $($(item).children()[a]).data('obj', data.list[a].url);
                        $($(item).children()[a]).on('click', function () {
                            if (!$(this).data('select')) {
                                imagenes.push($(this).data('obj'));
                                $(this).addClass('imgActive');
                                $(this).data('select', true);
                            } else {
                                for (var c = 0; c < imagenes.length; c++) {
                                    if (imagenes[c] == $(this).data('obj')) {
                                        imagenes.splice(imagenes[c], 1);
                                        $(this).removeClass('imgActive');
                                        $(this).data('select', false);
                                    }
                                }
                            }
                        });
                    }
                    $('#ModalBlogMultimedia').modal('show');
                } else {
                    alert(data.msg);
                }
            }
        });
    });
}

function AsignarImagenes() {
    $('#ModalBlogMultimedia').modal('hide');
    $('#post_images').children().remove();
    for (var a = 0; a < imagenes.length; a++) {
        var code = '<li><img src="' + imagenes[a] + '" style="width:150px;"/></li>';
        var item = $('#post_images').append(code);
    }
}

function SavePost(token) {
    if ($('#video').val() !== '' || imagenes.length > 0) {
        $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
            var request = requestitem;
            request.token = token;
            var t = token;
            request.item = {
                titulo: $('#post_title').val(),
                curta: CKEDITOR.instances.editor1.getData(),
                llarga: CKEDITOR.instances.editor2.getData(),
                url: $('#video').val(),
                img: imagenes
            };
            if (post == null) {
                //Creem el post
                $.ajax({
                    url: "/api/interfaces/admin/IBlog.php?fun=SavePost",
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
                            window.location.replace("/cms/pages/blog/Listar.php");
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            } else {
                //Editem el post
                request.item.idBlog = post.item.idBlog;
                $.ajax({
                    url: "/api/interfaces/admin/IBlog.php?fun=EditPost",
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
                            window.location.replace("/cms/pages/blog/Listar.php");
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            }
        });
    } else {
        alert('Hay que introducir una url de video o insertar una imagen.');
    }
}

function GetPost(post) {
    this.post = post;
    if (post.item != null) {
        $('#post_title').val(post.item.Titulo);
        CKEDITOR.instances.editor1.setData(post.item.Descripcion_corta);
        CKEDITOR.instances.editor2.setData(post.item.Descripcion);
        $('#video').val(post.item.video);
        imagenes = post.item.imagenes;

        AsignarImagenes();
    }
}