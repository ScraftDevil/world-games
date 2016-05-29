$(document).ready(function () {
    $("#msg").css("display", "none");
    $('#login-form-link').click(function (e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('.title').html("ENTRAR");
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function (e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('.title').html("REGISTRO");
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $("#login-form").on("submit", function (e) {
        e.preventDefault();
        if ($("#login-form").valid()) {
            var params = {"username": $("#username").val(), "password": $("#password").val(), "recaptcha": $("#g-recaptcha-response").val(), "remember": $("#remember").is(':checked')};
            $.ajax({
                data: params,
                url: '../../controller/frontAuthControllers/loginController.php',
                type: 'POST',
                dataType: 'json',
                success: function (data) {
                    if (data.STATUS == "LOGIN_INVALID_INFO") {
                        $("#msg").attr("class", "alert alert-danger");
                        $("#msg").html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>&nbsp;Usuario y/o contraseña incorrecto. Compruebelo e intente de nuevo.');
                        $("#msg").slideDown();

                    } else if (data.STATUS == "RECATPCHA_ERROR") {
                        $("#msg").attr("class", "alert alert-danger");
                        $("#msg").html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>&nbsp;Recaptcha vacío o incorrecto. Compruebelo e intente de nuevo.');
                        $("#msg").slideDown();

                        } else if (data.STATUS == "LOGIN_OK") {
                            $("#msg").attr("class", "alert alert-success");
                            $("#msg").html('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Login Correcto:</span>&nbsp;Has entrado con exito en la cuenta. Seras redirigido a tu perfil en menos de 1 segundo.');
                            $("#msg").slideDown();
                            var delay = 1000;
                            setTimeout(function () {
                                window.location = "registeredProfileView.php";
                            }, delay);
                        }
                }
            });
            return false;
        }
    });
});

function changeCountry(elem) {
    var value = elem.getAttribute("value");
    document.getElementById("country").value = value;
    $("#country").html(elem.text + " <span class=\"caret\"></span>");
}

// LOGIN AND REGISTER FORM VALIDATIONS

$("#login-form").validate({
    rules: {
        username: {
            required: true,
            minlength: 3,
            maxlength: 20
        },
        password: {
            required: true,
            minlength: 3,
            maxlength: 20
        }
    },
    messages: {
        username: {
            required: "El campo username esta vacio",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        },
        password: {
            required: "El campo password esta vacio",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        }
    }
});

$("#register-form").validate({
    oonkeyup: true,
    rules: {
        username_register: {
            required: true,
            minlength: 3,
            maxlength: 20
        },
        email: {
            required: true,
            email: true,
            maxlength: 45
        },
        passwordregister: {
            required: true,
            minlength: 6,
            maxlength: 20
        },
        confirmpassword: {
            required: true,
            minlength: 6,
            maxlength: 20,
            equalTo: "#passwordregister"
        },
        calendar: {
            required: true,
            date: true
        },
        country: {
            required: true
        }
    },
    messages: {
        username_register: {
            required: "El campo username esta vacio",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres"),
            minlength: jQuery.validator.format("No puedes poner menos de  {0} caracteres")
        },
        email: {
            required: "El campo email esta vacio",
            email: "Formato de email incorrecto",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        },
        passwordregister: {
            required: "El campo password esta vacio",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres"),
            minlength: jQuery.validator.format("No puedes poner menos de  {0} caracteres")
        },
        confirmpassword: {
            required: "El campo confirmpassword esta vacio",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres"),
            minlength: jQuery.validator.format("No puedes poner menos de  {0} caracteres"),
            equalTo: "La contraseña no corresponde con la primera"
        },
        calendar: {
            required: "La fecha de nacimiento esta vacio",
            date: "No tiene un formato adequado"
        },
        country: {
            required: "El campo pais esta vacio"
           

        }
    },
    submitHandler: function() {
        var username = $("#username_register").val();
        var passwordregister = $("#passwordregister").val();
        var email = $("#email").val();
        var birthdate = $("#calendar").val();
        var paypal = $("#paypal").val();
        var country = document.getElementById("country").value;     
       // var image = $("#image").val();
       var registered = {"username":username,"passwordregister":passwordregister,"email":email, "birthdate":birthdate, "paypal":paypal, "country":country};
       registerUser(registered);
    }
});

function registerUser(registered) {
   var registered = JSON.stringify(registered);
   $.ajax({
        data: "registered=" + registered,
        url: '../../controller/frontAuthControllers/insertUserController.php',   
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data.STATUS == "username") {
                $("#msgRegister").attr("class", "alert alert-danger");
                $("#msgRegister").html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>&nbsp;Este nombre de usuario ya existe. Por favor, pruebe con otro.');
                $("#msgRegister").slideDown();
            } else if (data.STATUS == "email") {
                $("#msgRegister").attr("class", "alert alert-danger");
                $("#msgRegister").html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>&nbsp;Este correo ya existe, pruebe con otro.');
                $("#msgRegister").slideDown();
            } else if (data.STATUS == "success") {
                $("#msgRegister").attr("class", "alert alert-success");
                $("#msgRegister").html('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Registro correcto:</span>&nbsp;Te has registrado con exito. Seras redirigido a la pagina de login en menos de 1 segundo.');
                $("#msgRegister").slideDown();
                var delay = 1000;
                setTimeout(function () {
                    window.location = "login.php";
                }, delay);
            }
        }
    });
}