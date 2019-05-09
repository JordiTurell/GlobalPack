var token;

var ckeditordescpostventa = null;
var descripcionpage = '';
function LoadDescripcion(t) {
    
    token = t;
    ckeditordescpostventa = CKEDITOR.instances.descpostventa;
    
    var request = {
        token: t
    };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IPostVenta.php?fun=LoadDescripcion",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            descripcionpage = data.item.descripcion;
            ShowBoxDesc(data);
        }
    });
    LoadPlans();

    setTimeout(insertdescripcion, 1000);
}

function insertdescripcion() {
    ckeditordescpostventa.setData(descripcionpage);
}

function SaveDEscripcion() {
    var request = {
        token: this.token,
        desc: CKEDITOR.instances.descpostventa.getData()
    };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IPostVenta.php?fun=SaveDescripcion",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            window.location.reload();
        }
    });
}

function ShowBoxDesc() {
    $('#descbody').slideToggle();
    $('#descfooter').slideToggle();
}

function ShowModalCrearPlan(isedit) {
    if (isedit) {
        var plan = $('#ModalCrearPlan').data('plan');
        $('#titulo').val(plan.Titulo);
        CKEDITOR.instances.descripcionplan.setData(plan.Descripcion);
        $('#color').val(plan.color);
        $('#ModalCrearPlan').modal('show');
    } else {
        $('#ModalCrearPlan').data('plan', null);
        $('#titulo').val('');
        CKEDITOR.instances.descripcionplan.setData('');
        $('#ModalCrearPlan').modal('show');
    }
}

function SavePlan(){
    var request = {
        token: this.token,
        titulo: $('#titulo').val(),
        desc: CKEDITOR.instances.descripcionplan.getData(),
        color: $('#color').val()
    };
    var plan = $('#ModalCrearPlan').data('plan');
    if (plan == null) {
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IPostVenta.php?fun=SavePlan",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                window.location.reload();
            }
        });
    } else {
        request.id = plan.Id_Plan;
        $.ajax({
            type: "POST",
            url: "/api/interfaces/admin/IPostVenta.php?fun=EditPlan",
            data: JSON.stringify(request),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                window.location.reload();
            }
        });
    }
}

function LoadPlans() {
    var request = {
        token: this.token
    };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/admin/IPostVenta.php?fun=LoadPlans",
        data: JSON.stringify(request),
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            console.log(data);
            var table = $('#tableplans');
            $(table).children().remove();
            var header = '<div class="row text-center" id="table-header">'+
                '<div class="col-lg-1">'+
                    '<strong>Titulo Plan</strong>'+
                '</div>' +
                '<div class="col-lg-1">' +
                    '<strong>Habilitar</strong>' +
                '</div>' +
                '<div class="col-lg-1">' +
                '<strong>Opciones</strong>' +
                '</div>' +
                '</div>';
            $(table).append(header);
            for (var a = 0; a < data.list.length; a++) {
                code = '<div class="row">' +
                    '<div class="col-lg-1" style="margin-top:10px;" >' + data.list[a].Titulo + '</div>';
                if (data.list[a].Habilitado === "1") {
                    code += '<div class="col-lg-1">' +
                        '<label class="switch float-right" style="margin-top:10px;">' +
                        '<input type="checkbox" checked>' +
                        '<span class="slider round"></span>' +
                        '</label>' +
                        '&nbsp;&nbsp;</div>';
                } else {
                    code += '<div class="col-lg-1">' +
                        '<label class="switch float-right" style="margin-top:10px;">' +
                        '<input type="checkbox">' +
                        '<span class="slider round"></span>' +
                        '</label>' +
                        '&nbsp;&nbsp;</div>';
                }
                code += '<div class="col-lg-2"><i class="fas fa-edit" style="font-size:30px; margin-top:10px;"></i> <i class="fas fa-trash" style="font-size:30px; margin-left:10px; margin-top:10px;"></i></div>'+
                    '</div>';
                var row = $(table).append(code);
                row = $(row).children()[(a + 1)];
                //Habilitar
                $($(row).children()[1]).data('item', data.list[a]);
                $($(row).children()[1]).on('click', function (ev) {
                    ev.preventDefault();
                    var cat = $(this).data('item');
                    var s = $(this);

                    if ($($(this).find('input')[0]).is(':checked')) {
                        cat.Habilitado = 0;
                    } else {
                        cat.Habilitado = 1;
                    }

                    var request = {
                        token: token,
                        item: cat
                    };
                    
                    $.ajax({
                        url: "/api/interfaces/admin/IPostVenta.php?fun=HabilitarPlan",
                        data: JSON.stringify(request),
                        type: "POST",
                        cache: false,
                        dataType: "json",
                        contentType: "application/json; charset=utf-8",
                        success: function (data) {
                            if (cat.Habilitado === 1) {
                                $($(s).find('input')[0]).prop('checked', true);
                            } else {
                                $($(s).find('input')[0]).prop('checked', false);
                            }
                        }
                    });
                });

                $($(row).children()[2]).find('i').each(function (i) {
                    switch (i) {
                        case 0:
                            $(this).data('item', data.list[a]);
                            $(this).on('click', function (ev) {
                                ev.preventDefault();
                                $('#ModalCrearPlan').data('plan', $(this).data('item'));
                                ShowModalCrearPlan(true);
                            });
                            break;
                        case 1:
                            $(this).data('item', data.list[a]);
                            $(this).on('click', function (ev) {
                                ev.preventDefault();
                                var cat = $(this).data('item');
                                
                                var request = {
                                    token: token,
                                    item: cat
                                };

                                $.ajax({
                                    url: "/api/interfaces/admin/IPostVenta.php?fun=DeletePlan",
                                    data: JSON.stringify(request),
                                    type: "POST",
                                    cache: false,
                                    dataType: "json",
                                    contentType: "application/json; charset=utf-8",
                                    success: function (data) {
                                        window.location.reload();
                                    }
                                });
                            });
                            break;
                    }
                });
            }
        }
    });
}