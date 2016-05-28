// ESTADÍSTICAS

    /* Obtener estadísticas */
    $(document).ready(function() {

        //Juegos por plataforma
        $.ajax({
            method: "GET",
            url: "../../controller/statisticsControllers/countGameForPlatform.php",
            dataType: "json",
            success: function (array_json) {
                var arrayPlataform = Array();
                for (var i = 0; i < array_json.length; i++) {
                    arrayPlataform.push(array_json[i]);
                }
                printGamePlatformStatistics(arrayPlataform);
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
                var arrayGenre = Array();
                for (var i = 0; i < array_json.length; i++) {
                    arrayGenre.push(array_json[i]);
                }
                printGameGenreStatistics(arrayGenre);
            }
        });
    });

    /* Funcion de respuesta de obtener estadísticas de cantidad de juegos por plataforma */
    function printGamePlatformStatistics(arrayPlataform) {//Origin, Steam, Xbox, PSN
        var dataPoints = [];
        for(var i = 0; i < arrayPlataform.length; i++) {
            dataPoints.push({ label: arrayPlataform[i].platform, y: arrayPlataform[i].quantity });
        }
        var chart = new CanvasJS.Chart("chartContainerGamesPlatforms", {
            theme: "theme2", //theme1
            title: {
                text: "Número de juegos por plataforma"},
            animationEnabled: true, // change to true
            data: [{
                // Change type to "bar", "area", "spline", "pie",etc.
                type: "pie",
                dataPoints: dataPoints
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
    function printGameGenreStatistics(arrayGenre) {
        var dataPoints = [];
        for(var i = 0; i < arrayGenre.length; i++) {
            dataPoints.push({ label: arrayGenre[i].genre, y: arrayGenre[i].quantity });
        }
        var chart = new CanvasJS.Chart("chartContainerGamesgenres", {
            theme: "theme2", //theme1
            title: {
                text: "Número de juegos por género"},
            animationEnabled: true, // change to true
            data: [{
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "pie",
            dataPoints: dataPoints
        }]
    });
        chart.render();
    }