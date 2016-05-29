$(document).ready(load);

function load() {


 
  $("#sumar").click(function() {
    var stock = $("#stock").val();

    stock++;

    $("#stock").val(stock);

  });

  $("#restar").click(function() {
    var stock = $("#stock").val();
    if(stock >= 1){
    stock--;

    $("#stock").val(stock);
  }
  });

  $("#insert-game").click(function() {
      var title = $("#title").val();
      var price = parseFloat($("#price").val());
      var platform = document.getElementById("platform").value;
      var genres = $("#genres").val();
      var game = {"title": title, "price": price, "platform": platform, "genres": genres};
      sendGame(game);
  });

  $("#update-game").click(function() {
      var id = $("#idGame").val();
      var title = $("#title").val();
      var price = parseFloat($("#price").val());
      var stock = parseInt($("#stock").val());
      var platform = parseInt($("#platform").val());
      var genres = $("#genres").val();
      var game = {"id": id, "title": title, "price": price, "stock": stock, "platform": platform, "genres": genres};
      updateGame(game);
  });
}



/// GAME ACTIONS START

//GAME AJAX UPDATE FUNCTION
function updateGame(game) {
    var game = JSON.stringify(game);
    $.ajax({
        data:  "game=" + game,
        url:   '../../controller/gameControllers/updateGameController.php',
        type:  'POST',
        dataType: 'json',
        success: getUpdateGameProcess
    });
}

function getUpdateGameProcess(data) {
    switch(data.status) {
        case "fail":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del juego!</strong></div>");
        break;

        case "successUpdate":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/gameViews/gameListView.php?msg=" + data.status; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
    }
}

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

function getGame(data) {
   var data = JSON.stringify(data);
   $.ajax({
      data:  "data=" + data,
      url:   '../../controller/gameControllers/getGameInfoController.php',
      type:  'POST',
      dataType: 'json',
      success: getGameInfo
  });
}

function getGameInfo(data) {
   if(data != null) {
      $("#title").val(data.Title);
      $("#price").val(data.Price);
      $("#stock").val(data.Stock);
      for(var i = 0; i < data.Genres.length; i++) {
        $("#genres option[value="+data.Genres[i].ID_Genre+"]").attr("selected", "selected");
      }
      document.getElementById("platform").value = data.PlatformID;
      $("#platform").html(data.Platform);
   }
}


 function gameDataEditView(){
      getGame(data);
      $("#game-user").click(function() {
        var title = $("#title").val();
      var price = parseFloat($("#price").val());
      var platform = document.getElementById("platform").value;
        var genres = $("#genres").val();
      var game = {"title": title, "price": price, "platform": platform, "genres": genres};
        updateGame(game);
      })
    }
/// GAME ACTIONS FINISH


/// GAMES FORM VALIDATOR

