function deletePlatform(value) {
    var id = value;
    var alert = "<img class=\"alert-img\" src=\"../resources/images/alert.png\"/>";
    var deleteButton = "<button name=\"delete\" value=\"" + id + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
    var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
    var form = "<form action=\"../../controller/platformControllers/deletePlatformController.php?id=" + id + "\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
    var deleteplatform = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Seguro que deseas eliminar la Plataforma con ID " + id + "?</p>" + form + "</div></div>";
    $("body").append("<div class=\"delete\">" + deleteplatform + "</div>");
}