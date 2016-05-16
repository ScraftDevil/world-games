function deleteUser(value) {
	var id = value;
	var get = getterURL("group"); 
	var alert = "<img class=\"alert-img\" src=\"images/alert.png\"/>";
	var deleteButton = "<button name=\"delete\" value=\"" + id + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
	var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
	var form = "<form action=\"../controller/deleteUserController.php?group=" + get + "\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
	var deleteUsr = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Seguro que deseas eliminar el Usuario con ID " + id + "?</p>" + form + "</div></div>";
	$("body").append("<div class=\"delete\">" + deleteUsr + "</div>");
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