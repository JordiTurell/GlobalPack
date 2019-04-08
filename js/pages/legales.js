function LoadLegales(tipo) {
    direccion = '';
    switch (tipo) {
        case 1:
            direccion = "/api/interfaces/web/ILegales.php?fun=LoadTerminosCondiciones";
            break;
        case 2:
            direccion = "/api/interfaces/web/ILegales.php?fun=LoadPoliticadeprivacidad";
            break;
        case 3:
            direccion = "/api/interfaces/web/ILegales.php?fun=LoadPoliticadeCoockies";
            break;
        case 4:
            direccion = "/api/interfaces/web/ILegales.php?fun=LoadInfomracionlegal";
            break;
    }
    $.ajax({
        type: "POST",
        url: direccion,
        cache: false,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        beforeSend: function () {

        },
        success: function (data) {
            $('#textolegales').append(data.item);
        }
    });
}