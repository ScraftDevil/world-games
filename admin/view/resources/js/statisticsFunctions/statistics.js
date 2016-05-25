// ESTADÍSTICAS

/* Obtener estadísticas de cantidad de juegos por plataforma */
$(document).ready(function() {
    $.ajax({
        method: "GET",
        url: "../../controller/statisticsControllers/countGameForPlatform.php",
        dataType: "json",
        success: function (array_json) {
            var Origin = array_json[0].quantity;
            var Steam = array_json[1].quantity;
            var Xbox = array_json[2].quantity;
            var PSN = array_json[3].quantity;
            printDades(Origin, Steam, Xbox, PSN);
        }
    });
});

/* Funcion de respuesta de obtener estadísticas de cantidad de juegos por plataforma */
function printDades(Origin, Steam, Xbox, PSN) {

    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "theme2", //theme1
        title: {
            text: "Número de juegos por plataforma"},
        animationEnabled: true, // change to true
        data: [{
        // Change type to "bar", "area", "spline", "pie",etc.
        type: "pie",
        dataPoints: [
        {label: "Origin", y: parseInt(Origin)},
        {label: "Steam", y: parseInt(Steam)},
        {label: "Xbox", y: parseInt(Xbox)},
        {label: "PSN", y: parseInt(PSN)}
        ]
    }]
});
    chart.render();
}
