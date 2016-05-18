$(document).ready(function() {
    $(".form-signin").on("submit", function(e) {
        e.preventDefault();
        var params = {"username" : $("#username").val(), "password" : $("#password").val()};
            $.ajax({
                data:  params,
                url:   '../../controller/adminAuthControllers/adminLoginController.php',
                type:  'POST',
                dataType: 'json',
                success:  function (data) {
                    if (data.STATUS=="LOGIN_INVALID_INFO") {
                        $("#msg").attr("class", "alert alert-danger");
                        $("#msg").html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>&nbsp;Usuario y/o contraseña incorrecto. Compruebelo e intente de nuevo.');
                        $("#msg").slideDown();
                    } else if(data.STATUS=="LOGIN_OK") {
                        $("#msg").attr("class", "alert alert-success");
                        $("#msg").html('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Login Correcto:</span>&nbsp;Has entrado con exito en la cuenta. Seras redirigido a tu perfil en menos de 1 segundo.');
                        $("#msg").slideDown();
                        var delay = 1000;
                        setTimeout(function(){ window.location = "../../index.php"; }, delay);
                    }
                }
            });
    });
});