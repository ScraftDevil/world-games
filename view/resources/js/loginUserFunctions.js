$(window).load(function () {
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
        var params = {"username": $("#username").val(), "password": $("#password").val()};
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
                } else if (data.STATUS == "LOGIN_OK") {
                    $("#msg").attr("class", "alert alert-success");
                    $("#msg").html('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Login Correcto:</span>&nbsp;Has entrado con exito en la cuenta. Seras redirigido a tu perfil en menos de 1 segundo.');
                    $("#msg").slideDown();
                    var delay = 1000;
                    setTimeout(function () {
                        window.location = "../index.php";
                    }, delay);
                }
            }
        });
        return false;
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
            maxlength: 20
        },
        password: {
            required: true,
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

$( "#register-form .form-control").keyup(function() {

$("#register-form").validate({
    rules: {
        username: {
            required: true,
            maxlength: 20
        },
        email: {
            required: true,
            email: true,
            maxlength: 45
        },
        passwordregister: {
            required: true,
            maxlength: 20
        },
        confirmpassword: {
            required: true,
            maxlength: 20
        },
        calendar: {
            required: true,
            date:true
        },
        country: {
            required: true
           
        }
    },
    messages: {
        username: {
            required: "El campo username esta vacio",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        },
        email: {
            required: "El campo email esta vacio",
            email: "Formato de email incorrecto",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        },
        passwordregister: {
            required: "El campo password esta vacio",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        },
        confirmpassword: {
            required: "El campo confirmpassword esta vacio",
            maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        },
        calendar: {
            required: "La fecha de nacimiento esta vacio",
            date:"La fecha es invalida"
        },
        country: {
            required: "El campo pais esta vacio"
           

        }
    }
});

});