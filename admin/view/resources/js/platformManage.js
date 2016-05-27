function deletePlatform(value) {
    var id = value;
    var alert = "<img class=\"alert-img\" src=\"../resources/images/alert.png\"/>";
    var deleteButton = "<button name=\"delete\" value=\"" + id + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
    var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
    var form = "<form action=\"../../controller/platformControllers/deletePlatformController.php?id=" + id + "\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
    var deleteplatform = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Seguro que deseas eliminar la Plataforma con ID " + id + "?</p>" + form + "</div></div>";
    $("body").append("<div class=\"delete\">" + deleteplatform + "</div>");
}

$("#insert-platform").click(function() {
      var name = $("#name").val();
     
     
     var platform = {"name": name};
      sendPlatform(platform);
  });

function sendPlatform(platform) {
    var platform = JSON.stringify(platform);
    $.ajax({
        data:  "platform=" + platform,
        url:   '../../controller/platformControllers/newPlatformController.php',
        type:  'POST',
        dataType: 'json',
        success: getInsertPlatformProcess
    });
}

function getInsertPlatformProcess(data) {
    switch(data.id) {
        case "error":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos de la plataforma!</strong></div>");
        break;

        case "success":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/platformViews/platformListView.php?msg=" + data.id; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
    }
}