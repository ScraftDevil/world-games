/// USER ACTIONS START

$(document).ready(load);

group = null;

function load() {
  var page = getPageName();
  var group = getterURL("group");
  switch (page) {
    case "newUserView":
      newUserView();
    break;

    case "userDataEditView":
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

  }

}

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

        case "invalid-fields":
          var max = 0;
          for(error in data.errors) {
            max++;
          }
          var errors = "<div class=\"alert error\">";
          for (var i = 0; i < max; i++) {
            errors = errors + "<strong><span class=\"glyphicon glyphicon-remove\"></span> " + data.errors[i] + "</strong><br>";
          }
          errors = errors + "</div>";
          $("#general-error").html(errors);
        break;

        case "success": case "email-error": case "username-error":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/" + data.group + "ListView.php"; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
  }
}

// DELETE USER FUNCTION
function deleteUser(value, group) {
  var id = value;
  var info = "<img class=\"alert-img\" src=\"../resources/images/alert.png\"/>";
  var deleteButton = "<button name=\"delete\" value=\"" + id + "-" + group + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
  var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
  var form = "<form action=\"../../controller/userControllers/deleteUserController.php\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
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
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + data.group + "&msg=u-" + data.id; }, delay);
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

// USER's COUNTRIES DROP DOWN
function changeCountry(elem) {
   var value = elem.getAttribute("value");
   document.getElementById("country").value = value;
   $("#country").html(elem.text + " <span class=\"caret\"></span>");
}

function newUserView() {
  $("#insert-user").click(function() {
    if ($("#insert-registered").valid() == true) {
      var username = $("#username").val();
      var password = $("#password").val();
      var email = $("#email").val();
      var birthdate = $("#calendar").val();
      var country = document.getElementById("country").value; 
      var user = {"username": username, "password": password, "email": email, "birthdate": birthdate, "country": country, "group": group};
      sendUser(user);
    }
  });

  $("#insert-pro").click(function() {
    //if ($("#new-user-pro").valid() == true) {
      var username = $("#username").val();
      var password = $("#password").val();
      var email = $("#email").val();
      var birthdate = $("#calendar").val();
      var user = {"username": username, "password": password, "email": email, "birthdate": birthdate, "group": group};
      sendUser(user);
    //}
  });
}


$("#new-user-pro").validate({ 
  oonkeyup: true,
  rules: {
    username: {
      required: true,
      alphanumeric: true,
      minlength: 3,
      maxlength: 20         
    },
    password: {
      required: true,
      minlength: 6,
      maxlength: 20          
    },
    email: {
      required: true,
      email: true           
    },
    birthdate: {
      required: true,
      spainDate:true,
      futureDate:true
    },
    country: {
      required: true
    }
  }, messages: {
      username: {
        required: "¡El nombre de usuario no puede estar vacío!",
        alphanumeric: "¡El nombre de usuario no puede contener carácteres especiales!",
        minlength: "¡El nombre de usuario tiene que tener más de 2 carácteres!",
        maxlength: "¡El nombre de usuario no puede tener más de 20 carácteres!"
      },
      password: {
        required: "¡La contraseña no puede estar vacío!",
        minlength: "¡La contraseña tiene que tener más de 5 carácteres!",
        maxlength: "¡La contraseña no puede tener más de 20 carácteres!"
      },
      email: {
        required: "¡El email no puede estar vacío!",
        email: "¡Formato de email no válido!"
      },
      birthdate: {
        required: "¡La fecha de cumpleaños no puede estar vacía!",
        spainDate: "¡Formato de fecha no válido!",
        futureDate: "¡La fecha de cumpleaños es futura!"
      },
      country: {
        required: "¡Debes seleccionar un país!"
      }
  }
});

$("#new-user-pro").validate({ 
  oonkeyup: true,
  rules: {
    username: {
      required: true,
      alphanumeric: true,
      minlength: 3,
      maxlength: 20         
    },
    password: {
      required: true,
      minlength: 6,
      maxlength: 20          
    },
    email: {
      required: true,
      email: true           
    },
    birthdate: {
      required: true,
      spainDate:true,
      futureDate:true
    }
  }, messages: {
      username: {
        required: "¡El nombre de usuario no puede estar vacío!",
        alphanumeric: "¡El nombre de usuario no puede contener carácteres especiales!",
        minlength: "¡El nombre de usuario tiene que tener más de 2 carácteres!",
        maxlength: "¡El nombre de usuario no puede tener más de 20 carácteres!"
      },
      password: {
        required: "¡La contraseña no puede estar vacío!",
        minlength: "¡La contraseña tiene que tener más de 5 carácteres!",
        maxlength: "¡La contraseña no puede tener más de 20 carácteres!"
      },
      email: {
        required: "¡El email no puede estar vacío!",
        email: "¡Formato de email no válido!"
      },
      birthdate: {
        required: "¡La fecha de cumpleaños no puede estar vacía!",
        spainDate: "¡Formato de fecha no válido!",
        futureDate: "¡La fecha de cumpleaños es futura!"
      }
  }
});