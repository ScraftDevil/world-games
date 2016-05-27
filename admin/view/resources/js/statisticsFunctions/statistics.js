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
                printGamePlatformStatistics(Origin, Steam, Xbox, PSN);
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

        //Juegos por género
        $.ajax({
            method: "GET",
            url: "../../controller/statisticsControllers/countGameForGenre.php",
            dataType: "json",
            success: function (array_json) {
                var Aventura = array_json[0].quantity;
                var Accion = array_json[1].quantity;
                var Arcade = array_json[2].quantity;
                var RPG = array_json[3].quantity;
                printGameGenreStatistics(Aventura, Accion, Arcade, RPG);
            }
        });
    });

    /* Funcion de respuesta de obtener estadísticas de cantidad de juegos por plataforma */
    function printGamePlatformStatistics(Origin, Steam, Xbox, PSN) {

        var chart = new CanvasJS.Chart("chartContainerGamesPlatforms", {
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

    /* Funcion de respuesta de obtener estadísticas de cantidad de usuarios por tipo */
    function printUserStatistics(Administrator, Professional, Registered) {

        var chart = new CanvasJS.Chart("chartContainerUsers", {
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

    /* Funcion de respuesta de obtener estadísticas de cantidad de juegos por género */
    function printGameGenreStatistics(Aventura, Accion, Arcade, RPG) {

        var chart = new CanvasJS.Chart("chartContainerGamesgenres", {
            theme: "theme2", //theme1
            title: {
                text: "Número de juegos por género"},
            animationEnabled: true, // change to true
            data: [{
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "pie",
            dataPoints: [
            {label: "Aventura", y: parseInt(Aventura)},
            {label: "Accion", y: parseInt(Accion)},
            {label: "Arcade", y: parseInt(Arcade)},
            {label: "RPG", y: parseInt(RPG  )}
            ]
        }]
    });
        chart.render();
    }