/// USER ACTIONS START

$(document).ready(load);

group = null;

function load() {
  var page = getPageName();
  var id = getterURL("id");
  switch (page) {
    case "reportView":
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
            $(".panel-title").html("Razón: " + data.reason);
            $("#username").val(data.user);
            $("#date").val(data.date);
            $("#hour").val(data.hour);
            $("#text").val(data.text);
            document.getElementById("status").value = data.status;
            $("#status-name").html(data.status);
        break;

        case "error":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/userViews/userListView.php?group=" + data.group + "&msg=i-" + data.id; }, delay);
        break;
  }
}

// USER's COUNTRIES DROP DOWN
function changeStatus(elem) {
   var value = elem.getAttribute("value");
   document.getElementById("status").value = value;
   $("#status-name").html(elem.text + " <span class=\"caret\"></span>");
}


/// USER ACTIONS FINISH