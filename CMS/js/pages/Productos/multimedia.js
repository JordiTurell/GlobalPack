var token = '';
var upload = null;
var count = 1;

$(document).ready(function () {
    $("#update").on("change", function (e) {
        var file = null;
        if ($(this)[0].files.length > 1) {
            for (var a = 0; a < $(this)[0].files.length; a++) {
                
                file = $(this)[0].files[a];
                upload = new Upload(file);
                // maby check size or type here with upload.getSize() and upload.getType()
                // execute upload
                upload.doUpload($(this)[0].files.length);
            }
        } else {
            file = $(this)[0].files[0];
            $('#totalfiles').text("1/1");
            upload = new Upload(file);
            // maby check size or type here with upload.getSize() and upload.getType()
            // execute upload
            upload.doUpload();
        }
    });
});

var Upload = function (file) {
    this.file = file;
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
Upload.prototype.doUpload = function (total) {
    var that = this;
    var formData = new FormData();
    
    $('#totalfiles').text(count + "/" + total + 1);
    count = count+1;
    // add assoc key values, this will be posts values
    formData.append("file", this.file, this.getName());
    formData.append("upload_file", true);
    $('.progress-bar').css("width", "0%");
    $.ajax({
        type: "POST",
        url: "/cms/img/UpdateFile.php?FOLDER=Productos",
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', that.progressHandling, false);
            }
            return myXhr;
        },
        success: function (data) {
            // your callback here
            upload = null;
            LoadFiles(token);
        },
        error: function (error) {
            // handle error
        },
        async: true,
        data: formData,
        cache: false,
        contentType: false,
        processData: false
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

function LoadFiles(t) {
    token = t;

    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        var t = token;

        $.ajax({
            url: "/api/interfaces/admin/IProductos.php?fun=LoadFiles",
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
                        var code = '<li><img src="' + data.list[a].url + '" /><i class="fas fa-trash-alt"></i></li>';
                        var item = $('#listimagenes').append(code);
                        var delete_img = $($(item).children()[a]).children()[1];
                        $(delete_img).data('img', data.list[a]);
                        $(delete_img).on('click', function () {
                            $('#ModalDeleteImagen').data('img', $(this).data('img'));
                            $('#ModalDeleteImagen').modal('show');
                        });
                    }
                } else {
                    alert(data.msg);
                }
            }
        });
    });
}

function Delete() {
    $.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
        var request = requestitem;
        request.token = token;
        var t = token;
        var img = $('#ModalDeleteImagen').data('img');
        request.item = img;

        $.ajax({
            url: "/api/interfaces/admin/IProductos.php?fun=DeleteFile",
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
                    LoadFiles(token);
                    $('#ModalDeleteImagen').modal('hide');
                } else {
                    alert(data.msg);
                }
            }
        });
    });
}