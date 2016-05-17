group = getterURL("group");

$("#submit").click(function() {
	var username = $("#Username").val();
	var password = $("#Password").val();
	var email = $("#Email").val();
	var birthdate = $("#calendar").val();
	var country = document.getElementById("country").value; 
	var user = {"username": username, "password": password, "email": email, "birthdate": birthdate, "country": country, "group": group};
	// JQUERY VALIDATIONS

(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#registered-user").validate({
                rules: {
                    Username: "required",
                    Password: "required",
                    Email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    Username: "Introduce el nombre de usuario",
                    Password: "Introduce la contraseña",
                    //password: {
                        //required: "Please provide a password",
                        //minlength: "Your password must be at least 5 characters long"
                    //},
                    Email: "Please enter a valid email address"
                    //agree: "Please accept our policy"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

	sendUser(user);
});

function deleteUser(value) {
	var id = value;
	var alert = "<img class=\"alert-img\" src=\"images/alert.png\"/>";
	var deleteButton = "<button name=\"delete\" value=\"" + id + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
	var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
	var form = "<form action=\"../controller/deleteUserController.php?group=" + group + "\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
	var deleteUsr = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Seguro que deseas eliminar el Usuario con ID " + id + "?</p>" + form + "</div></div>";
	$("body").append("<div class=\"delete\">" + deleteUsr + "</div>");
}

function deleteGame(value) {
    var id = value;
    var alert = "<img class=\"alert-img\" src=\"images/alert.png\"/>";
    var deleteButton = "<button name=\"delete\" value=\"" + id + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
    var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
    var form = "<form action=\"../controller/deleteUserController.php?group=" + group + "\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
    var deletegame = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Seguro que deseas eliminar el Juego con ID " + id + "?</p>" + form + "</div></div>";
    $("body").append("<div class=\"delete\">" + deletegame + "</div>");
}
function cancelDelete() {
	$(".delete").remove();
}

function getterURL(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("?");
  for (var i=0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    if (pair[0] == variable) {
      return pair[1];
    }
  } 
  return variable;
}

function changeCountry(elem) {
	var value = elem.getAttribute("value");
	document.getElementById("country").value = value;
	$("#country").html(elem.text + " <span class=\"caret\"></span>");
}

function changePlataform(elem) {
    var value = elem.getAttribute("value");
    document.getElementById("plataform").value = value;
    $("#plataform").html(elem.text + " <span class=\"caret\"></span>");
}

function sendUser(user) {
	var user = JSON.stringify(user);
	$.ajax({
		data:  "user=" + user,
		url:   '../controller/newUserController.php',
		type:  'POST',
		dataType: 'json',
		success: getProcess
	});
}

function sendGame(game) {
    var game = JSON.stringify(game);
    $.ajax({
        data:  "game=" + game,
        url:   '../controller/newGameController.php',
        type:  'POST',
        dataType: 'json',
        success: getProcess2
    });
}

function getProcess(data) {
	switch(data.id) {
		case "error":
			$("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del usuario!</strong></div>");
		break;

		case "success":
			var delay = 0;
        	setTimeout(function(){ window.location = "userListView.php?group=" + group + "&msg=" + data.id; }, delay);
		break;

		default:
			$("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
		break;
	}
}

function getProcess2(data) {
    switch(data.id) {
        case "error":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del juego!</strong></div>");
        break;

        case "success":
            var delay = 0;
            setTimeout(function(){ window.location = "gameListView.php" + group + "&msg=" + data.id; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
    }
}