$(document).ready(load);

function load() {

  $("#insert-game").click(function() {
      var title = $("#title").val();
      var price = parseFloat($("#price").val());
      var platform = document.getElementById("platform").value;
      var game = {"title": title, "price": price, "platform": platform};
      sendGame(game);
  });

}


/// GAME ACTIONS START


// GAME AJAX INSERT FUNCTION
function sendGame(game) {
    var game = JSON.stringify(game);
    $.ajax({
        data:  "game=" + game,
        url:   '../../controller/gameControllers/newGameController.php',
        type:  'POST',
        dataType: 'json',
        success: getInsertGameProcess
    });
}

// GAME AJAX INSERT RESPONSE
function getInsertGameProcess(data) {
    switch(data.id) {
        case "error":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del juego!</strong></div>");
        break;

        case "success":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/gameViews/gameListView.php?msg=" + data.id; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
    }
}

// GAME DELETE FUNCTION
function deleteGame(value) {
    var id = value;
    var alert = "<img class=\"alert-img\" src=\"../resources/images/alert.png\"/>";
    var deleteButton = "<button name=\"delete\" value=\"" + id + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
    var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
    var form = "<form action=\"../../controller/gameControllers/deleteGameController.php?id=" + id + "\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
    var deletegame = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Seguro que deseas eliminar el Juego con ID " + id + "?</p>" + form + "</div></div>";
    $("body").append("<div class=\"delete\">" + deletegame + "</div>");
}

// GAME's PLATFORMS DROP DOWN
function changePlatform(elem) {
    var value = elem.getAttribute("value");
    document.getElementById("platform").value = value;
    $("#platform").html(elem.text + " <span class=\"caret\"></span>");
}


/// GAME ACTIONS FINISH


/// GAMES FORM VALIDATOR


function gameFiledsValidator() {
  $("#gameinsert").validate({
    rules: {
      title: {
        required: true,
        maxlength: 25

      },
      precio: {
        required: true,
        digit: true
      }
    },
    messages: {
      title: {
        required: "Pon un titulo porfiii",
        maxlength: jQuery.validator.format("Tienes que poner menos {0} que noooo")

      },
      precio: {
        required: "Los juegos no son gratis ;)",
        digit: "El precio no son letras -_- "
      }
    }
  });
}