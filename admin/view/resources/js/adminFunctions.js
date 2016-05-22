// START SCRIPT

$(document).ready(load);

group = null;

/// DOCUMENT LOAD START


function load() {
  var page = getPageName();
  switch(page) {

    // USER OPTIONS SWITCH START

    case "newUserView":
      var group = getterURL("group");
      $("#insert-user").click(function() {
          var username = $("#username").val();
          var password = $("#password").val();
          var email = $("#email").val();
          var birthdate = $("#calendar").val();
          var country = document.getElementById("country").value; 
          var user = {"username": username, "password": password, "email": email, "birthdate": birthdate, "country": country, "group": group};
          sendUser(user);
      });
    break;

    case "userDataEditView":
      var group = getterURL("group");
      var group = deleteGetTrash(group);
      var data = {"group": group, "id": id};
      getUser(data);
      $("#update-user").click(function() {
          var username = $("#username").val();
          var password = $("#password").val();
          var email = $("#email").val();
          var bannedtime = $("#bannedtime").val();
          var birthdate = $("#calendar").val();
          var paypal = $("#paypal").val();
          var avatar = null;
          var country = document.getElementById("country").value;
          var user = {"id": id, "username": username, "password": password, "email": email, "bannedtime": bannedtime, "birthdate": birthdate, "paypal":paypal, "avatar": avatar, "country": country, "group": group};
          updateUser(user);
      });
    break;

    // USER OPTIONS SWITCH FINISH


    // GAME OPTIONS SWITCH START

    case "newGameView":
      $("#insert-game").click(function() {
          var title = $("#title").val();
          var price = parseFloat($("#price").val());
          var platform = document.getElementById("platform").value;
          var game = {"title": title, "price": price, "platform": platform};
          sendGame(game);
      });
    break;

    //INSERT OFFER
    case "newOfferView":
      $("#insert-offer").click(function() {
          var discount = $("#discount").val();
          var game = $("#game").val();
          var offer = {"discount": discount, "game": game};
          sendOffer(offer);
      });
    break;
  }
}


/// DOCUMENT LOAD FINISH


/// USER ACTIONS START


// USER INSERT AJAX FUNCTION
function sendUser(user) {
   var user = JSON.stringify(user);
   $.ajax({
      data:  "user=" + user,
      url:   '../../controller/userControllers/newUserController.php',
      type:  'POST',
      dataType: 'json',
      success: getInsertUserProcess
  });
}

// INSERT USER AJAX RESPONSE
function getInsertUserProcess(data) {
  switch(data.id) {
    case "null-error":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del usuario!</strong></div>");
        break;

        case "success":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + data.group + "&msg=i-" + data.id; }, delay);
        break;

        case "email-error":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + data.group + "&msg=" + data.id; }, delay);
        break;

        case "username-error":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + data.group + "&msg=" + data.id; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
  }
}

// DELETE USER FUNCTION
function deleteUser(value) {
  var group = getterURL("group");
  var id = value;
  var info = "<img class=\"alert-img\" src=\"../resources/images/alert.png\"/>";
  var deleteButton = "<button name=\"delete\" value=\"" + id + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
  var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
  var form = "<form action=\"../../controller/userControllers/deleteUserController.php?group=" + group + "\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
  var deleteUsr = "<div class=\"confirm\"><div class=\"confirm-msg\">" + info + "<p>¿Seguro que deseas eliminar el Usuario con ID " + id + "?</p>" + form + "</div></div>";
  $("body").append("<div class=\"delete\">" + deleteUsr + "</div>");
}

// GET USER DATA FROM ID
function getUser(data) {
   var data = JSON.stringify(data);
   $.ajax({
      data:  "data=" + data,
      url:   '../../controller/userControllers/getUserInfoController.php',
      type:  'POST',
      dataType: 'json',
      success: getUserInfo
  });
}

function getUserInfo(data) {
   if(data != null) {
      $("#user").html(data.username);
      $("#username").val(data.username);
      $("#password").val(data.password);
      $("#email").val(data.email);
      $("#bannedtime").val(data.bannedtime);
      $("#calendar").val(data.birthdate);
      $("#paypal").val(data.paypal);
      $("avatar").val(data.avatar);
      document.getElementById("country").value = data.countryID;
      $("#country").html(data.country + " <span class=\"caret\"></span>");
   }
}

// USER UPDATE AJAX FUNCTION
function updateUser(user) {
   var user = JSON.stringify(user);
   $.ajax({
      data:  "user=" + user,
      url:   '../../controller/userControllers/updateUserController.php',
      type:  'POST',
      dataType: 'json',
      success: getUpdateUserProcess
  });
}

//
function getUpdateUserProcess(data) {
  switch(data.id) {
    case "null-error":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del usuario!</strong></div>");
        break;

        case "success":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + group + "&msg=u-" + data.id; }, delay);
        break;

        case "email-error":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + group + "&msg=" + data.id; }, delay);
        break;

        case "username-error":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + group + "&msg=" + data.id; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
  }
}


/// USER ACTIONS FINISH

/// OFFERS ACTIONS START
function sendOffer(offer) {
    var offer = JSON.stringify(offer);
    $.ajax({
        data:  "offer=" + offer,
        url:   '../../controller/offerControllers/newOfferController.php',
        type:  'POST',
        dataType: 'json',
        success: getInsertOfferProcess
    });
}
function getInsertOfferProcess(data) {
    switch(data.id) {
        case "errorOffer":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos de la oferta!</strong></div>");
        break;

        case "successOffer":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/gameViews/gameListView.php?msg=" + data.id; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
    }
}
/// OFFERS ACTIONS FINISH


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


/// GAME ACTIONS FINISH


/// BOOTSTRAP DROPDOWN CONTENTS START


// GAME's PLATFORMS DROP DOWN
function changePlatform(elem) {
    var value = elem.getAttribute("value");
    document.getElementById("platform").value = value;
    $("#platform").html(elem.text + " <span class=\"caret\"></span>");
}

// USER's COUNTRIES DROP DOWN
function changeCountry(elem) {
   var value = elem.getAttribute("value");
   document.getElementById("country").value = value;
   $("#country").html(elem.text + " <span class=\"caret\"></span>");
}

/// BOOTSTRAP DROPDOWN CONTENTS FINISH


/// OTHER FUNCTIONS START


// GET URL PARAM
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


// DELETE FUNCTION CANCEL
function cancelDelete() {
   $(".delete").remove();
}


// DELETE EXTRA INFO TO GET URL
function deleteGetTrash(data) {
  var pos = 0;
  for (var i = 0; i < data.length; i++) {
    if (data[i] == "&") {
      pos = i;
      i = data.length;
    }
  }
  return data.substring(0, pos);
}

// GET PAGE FILE NAME WITHOUT EXTENSION
function getPageName() {
  var result = "";
  var pageName = (function () {
    var a = window.location.href,
    b = a.lastIndexOf("/");
    return a.substr(b + 1);
  }());
  for (var i = 0; i < pageName.length; i++) {
      if(pageName[i] == ".") {
        i = pageName.length;
      } else {
        result = result + pageName[i];
      }
  }
  return result;
}


/// OTHER FUNCTIONS FINISH
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