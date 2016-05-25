//Función jQuery - Ajax para hacer Logout
$("#logout").on("click", function () {
    $.ajax({
        url: '../../controller/frontAuthControllers/logoutController.php',
        type: 'POST',
        success: function (response) {
                //Pendiente: Añadir mensaje cuando haga logout
                window.location = "../index.php";
            }
        });
});