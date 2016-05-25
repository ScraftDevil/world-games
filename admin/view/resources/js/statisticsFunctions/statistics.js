// ESTADÍSTICAS

    /* Obtener estadísticas */
    $(document).ready(function() {

        //Juegos por plataforma
        $.ajax({
            method: "GET",
            url: "../../controller/statisticsControllers/countGameForPlatform.php",
            dataType: "json",
            success: function (array_json) {
                var Origin = array_json[0].quantity;
                var Steam = array_json[1].quantity;
                var Xbox = array_json[2].quantity;
                var PSN = array_json[3].quantity;
                printGameStatistics(Origin, Steam, Xbox, PSN);
            }
        });

        //Cantidad de usuarios según el tipo
        $.ajax({
            method: "GET",
            url: "../../controller/statisticsControllers/countUserForType.php",
            dataType: "json",
            success: function (array_json) {
                var Administrator = array_json.Administrator[0];
                var Professional = array_json.Professional[0];
                var Registered = array_json.Registered[0];
                printUserStatistics(Administrator, Professional, Registered);
            }
        });
    });

    /* Funcion de respuesta de obtener estadísticas de cantidad de juegos por plataforma */
    function printGameStatistics(Origin, Steam, Xbox, PSN) {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2", //theme1
            title: {
                text: "Número y tipo de usuarios"},
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

    /* Funcion de respuesta de obtener estadísticas de cantidad de usuarios por tipo */
    function printUserStatistics(Administrator, Professional, Registered) {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "theme2", //theme1
            title: {
                text: "Número y tipo de usuarios"},
            animationEnabled: true, // change to true
            data: [{
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "pie",
            dataPoints: [
            {label: "Administrator", y: parseInt(Administrator)},
            {label: "Professional", y: parseInt(Professional)},
            {label: "Registered", y: parseInt(Registered)}
            ]
        }]
    });
        chart.render();
    }