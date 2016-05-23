/// USER ACTIONS START

$(document).ready(load);

group = null;

function load() {
  var page = getPageName();
  var id = getterURL("id");
  switch (page) {
    case "reportView":
    alert(id);
      getReport(id);
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
function getReport(id) {
   var user = JSON.stringify(user);
   $.ajax({
      data:  "id=" + id,
      url:   '../../controller/mailboxControllers/getReportController.php',
      type:  'POST',
      dataType: 'json',
      success: getReportProcess
  });
}

// INSERT USER AJAX RESPONSE
function getReportProcess(data) {
  switch(data.id) {
    case "success":
            $("#report-text").html(data.text);
        break;

        case "error":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + data.group + "&msg=i-" + data.id; }, delay);
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


/// USER ACTIONS FINISH