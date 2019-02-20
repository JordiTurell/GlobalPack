var token = '';

$.getScript("/cms/js/pages/models/requestitem.js", function (ev) {
    const requestitem = ev.requestitem;
});

$.getScript("/cms/js/pages/models/requestlist.js", function (ev) {
    const requestlist = ev.requestlist;
});

function ListAdmin(token) {
    this.token = token;
    $.getScript("/cms/js/pages/models/requestlist.js", function (ev) {
       var r = requestlist;
        r.token = token;
        r.items = 10;
        r.pagina = 0;
        $.ajax({
            url: '/api/interfaces/admin/IAdmin.php?fun=ListAdmin',
            type: "POST",
            data: JSON.stringify(r),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {
                
            },
            success: function (data) {
                CreateList(data);
                if (data.items < data.total) {
                    CreatePaginacion(data);
                }
            }
        });
    });
}

function CreateList(data) {
    var tabla = $('#tabla');

    if ($(tabla).children().length > 0) {
        $(tabla).children().remove();
    }
    var code = "<div class= \"row\">" +
                    "<div class=\"header-table col-lg-3\">"+
                        "<span class=\"title-table\">Nombre</span>"+
                    "</div>"+
                    "<div class=\"header-table col-lg-3\">"+
                        "<span class=\"title-table\">Apellidos</span>"+
                    "</div>"+
                    "<div class=\"header-table col-lg-3\">"+
                        "<span class=\"title-table\">Teléfono</span>"+
                    "</div>"+
                    "<div class=\"header-table col-lg-3\">"+
                        "<span class=\"title-table\">Activación</span>"+
                    "</div>"+
               "<div>";
        $(tabla).append(code);
    for (var a = 0; a < data.list.length; a++) {
        code = "<div class= \"row\">";
        code += "<div class=\"row-table " + row_table_border(data.list.length, a) +" col-lg-3\">" +
            data.list[a].Info.nombre +
            "</div>" +
            "<div class=\"row-table " + row_table_border(data.list.length, a) +" col-lg-3\">" +
            data.list[a].Info.apellidos +
            "</div>" +
            "<div class=\"row-table "+ row_table_border(data.list.length, a) +" col-lg-3\">" +
            data.list[a].Info.telefono +
            "</div>" +
            "<div class=\"row-table "+ row_table_border(data.list.length, a) +" col-lg-3\">";

        if (data.list[a].status) {
            code += "<span><i class=\"fas fa-check-circle\" style=\"color:#27843e; cursor:pointer;\"></i></span>";
        } else {
            code += "<span><i class=\"fas fa-times-circle\" style=\"color:red; cursor:pointer;\"></i></span>";
        }

            code += "</div>" +
            "</div>";
        var item = $(tabla).append(code);
        var activeadmin = $(item).find('i')[$(item).find('i').length-1];
        $(activeadmin).data('admin', data.list[a]);
        $(activeadmin).on('click', function (event) {
            event.preventDefault();
            var admin = $(this).data('admin');
            requestitem.token = token;
            requestitem.item = admin;
            $.ajax({
                url: '/api/interfaces/admin/IAdmin.php?fun=ActiveAdmin',
                type: "POST",
                data: JSON.stringify(requestitem),
                cache: false,
                contentType: "application/json",
                success: function (response) {
                    var r = JSON.parse(response);
                    if (r.success) {
                        ListAdmin(token);
                    } else {
                        //Error
                        Console.log("WARNING");
                    }
                }
            });
        });
    }
}

function row_table_border(count, item) {
    if (count == item+  1) {
        return '';
    } else {
        return 'row-table-border';
    }
}

function CreatePaginacion(data) {
    var box_footer = $('.box-footer');
    if ($(box_footer).children().length > 0) {
        $(box_footer).children().remove();
    }
    var code = "<nav aria-label=\"Page navigation example\">" +
        "<ul class=\"pagination pagination-sm\">";
    var paginas = data.total / data.items;
    for (var a = 1; a < paginas; a++) {
        if (a == 1) {
            code += "<li class=\"page-item\" data-page=\"" + data.pagina + "\"><span class=\"page-link\">" + a + "</span></li>";
        }
        code += "<li class=\"page-item\" data-page=\""+ (a + 1) +"\"><span class=\"page-link\">" + (a+1) + "</span></li>";
    }
            
  "</ul >"+
        "</nav >";

    var box_footer = $(box_footer).append(code);
    $(box_footer).find('li').each(function () {
        $($(this).children()[0]).on('click', function (ev) {
            var pagina = $($(this).parent()[0]).data('page');
        
            requestlist.token = token;
            requestlist.items = 10;
            requestlist.pagina = pagina-1;
        $.ajax({
            url: '/api/interfaces/admin/IAdmin.php?fun=ListAdmin',
            type: "POST",
            data: JSON.stringify(requestlist),
            cache: false,
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            beforeSend: function () {

            },
            success: function (data) {
                CreateList(data);
                if (data.items < data.total) {
                    CreatePaginacion(data);
                }
            }
        });
        });
    });
    
    $('#ModalLoading').modal('hide');
}