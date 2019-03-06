function LoadBlog(t) {
    var request = { uuid: t };
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IBlog.php?fun=ListBlog",
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
    var content = $('#list-blog');
    $(content).children().remove();
    var a = 0;
    var code = '';
    var item = null;

    for (a = 0; a < list.length; a++) {
        code = '<div class="text-left items-blog">' +
            '<img src="' + list[a].imagenes[0] + '" style="width:100%"; />' +
            '<h3>' + list[a].Titulo + '</h3>' +
            '<p>' + list[a].Descripcion_corta + '</p>' +
            '<div class="fecha">' + toDate(list[a].FechaC) + '</div>' +
            '</div>' +
            '</div>' +
            '</div>';

        item = $(content).append(code);
        $($(item).children()[a]).data('item', list[a]);
        $($(item).children()[a]).on('click', function (ev) {
            ev.preventDefault();
            var producto = $(this).data('item');
            $.redirect('/Post.php', producto);
        });
    }
}

function toDate(dateStr) {
    var fecha = dateStr.split(" ");
    var parts = fecha[0].split("-");
    var date = new Date(parts[0], parts[1] - 1, parts[2]);
    switch (date.getMonth()) {
        case 0:
            return date.getDay() + " / " + "Enero / " + date.getUTCFullYear();
        case 1:
            return date.getDay() + " / " + "Febrero / " + date.getUTCFullYear();
        case 2:
            return date.getDay() + " / " + "Marzo / " + date.getUTCFullYear();
        case 3:
            return date.getDay() + " / " + "Abril / " + date.getUTCFullYear();
        case 4:
            return date.getDay() + " / " + "Mayo / " + date.getUTCFullYear();
        case 5:
            return date.getDay() + " / " + "Junio / " + date.getUTCFullYear();
        case 6:
            return date.getDay() + " / " + "Julio / " + date.getUTCFullYear();
        case 7:
            return date.getDay() + " / " + "Agosto / " + date.getUTCFullYear();
        case 8:
            return date.getDay() + " / " + "Septiembre / " + date.getUTCFullYear();
        case 9:
            return date.getDay() + " / " + "Octubre / " + date.getUTCFullYear();
        case 10:
            return date.getDay() + " / " + "Noviembre / " + date.getUTCFullYear();
        case 11:
            return date.getDay() + " / " + "Diciembre / " + date.getUTCFullYear();
    }
}

function LoadPost() {

}

function Imprimir() {
    window.print();
}

function Compartir() {
    $('#ModalCompartir').modal('show');
}