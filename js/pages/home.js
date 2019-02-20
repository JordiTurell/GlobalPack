function Loadhome() {
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IHome.php?fun=Loadblog",
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            var news = $('.old-blog');
            for (var a = 0; a < data.list.length; a++) {
                var code = '';
                var date = toDate(data.list[a].FechaC);
                code += '<div class="item-blog">' +
                    '<img src="' + data.list[a].imagenes[0] + '" />'+
                    '<div class="title-blog">' + data.list[a].Titulo + '</div>' +
                    '<div class="text-blog">' + data.list[a].Descripcion_corta + '</div>' +
                    '<div class="fecha-blog">' + date +'</div>'+
                    '</div>';

                $(news).append(code);
            }
        }
    });
    $.ajax({
        type: "POST",
        url: "/api/interfaces/web/IHome.php?fun=LoadOcasion",
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            var news = $('.item-ocasion');
            for (var a = 0; a < data.list.length; a++) {
                var code = '';
                var date = toDate(data.list[a].FechaC);
                code += '<div class="items-ocasion">' +
                    '<img src="' + data.list[a].imagen + '" />' +
                    '<div class="title-ocasion">' + data.list[a].Titulo + '</div>' +
                    '<div class="text-ocasion">' + data.list[a].Descripcion_corta + '</div>' +
                    '<div class="pvp-ocasion"><span>' + data.list[a].PVP_Ocasion +' €  </span><span>'+ data.list[a].PVP +' €</span></div>'+
                    '<div class="fecha-ocasion">' + date + '</div>' +
                    '</div>';

                $(news).append(code);
            }
        }
    });
}

function toDate(dateStr) {
    var fecha = dateStr.split(" ");
    var parts = fecha[0].split("-");
    var date = new Date(parts[2], parts[1] - 1, parts[0]);
    switch (date.getMonth()) {
        case 0:
            return date.getDay() + " / " + "Enero / " + date.getFullYear();
        case 1:
            return date.getDay() + " / " + "Febrero / " + date.getFullYear();
        case 2:
            return date.getDay() + " / " + "Marzo / " + date.getFullYear();
        case 3:
            return date.getDay() + " / " + "Abril / " + date.getFullYear();
        case 4:
            return date.getDay() + " / " + "Mayo / " + date.getFullYear();
        case 5:
            return date.getDay() + " / " + "Junio / " + date.getFullYear();
        case 6:
            return date.getDay() + " / " + "Julio / " + date.getFullYear();
        case 7:
            return date.getDay() + " / " + "Agosto / " + date.getFullYear();
        case 8:
            return date.getDay() + " / " + "Septiembre / " + date.getFullYear();
        case 9:
            return date.getDay() + " / " + "Octubre / " + date.getFullYear();
        case 10:
            return date.getDay() + " / " + "Noviembre / " + date.getFullYear();
        case 11:
            return date.getDay() + " / " + "Diciembre / " + date.getFullYear();
    }
}