function deleteGenre(value) {
    var id = value;
    var alert = "<img class=\"alert-img\" src=\"../resources/images/alert.png\"/>";
    var deleteButton = "<button name=\"delete\" value=\"" + id + "\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
    var cancel = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
    var form = "<form action=\"../../controller/genreControllers/deleteGenreController.php?id=" + id + "\" method=\"POST\">" + deleteButton + " " + cancel + "</form>";
    var deletegenre = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Seguro que deseas eliminar el Genero con ID " + id + "?</p>" + form + "</div></div>";
    $("body").append("<div class=\"delete\">" + deletegenre + "</div>");
}

$("#insert-genre").click(function() {
      var name = $("#name").val();
     
     
     var genre = {"name": name};
      sendGenre(genre);
  });

function sendGenre(genre) {
    var genre = JSON.stringify(genre);
    $.ajax({
        data:  "genre=" + genre,
        url:   '../../controller/genreControllers/newGenreController.php',
        type:  'POST',
        dataType: 'json',
        success: getInsertGenreProcess
    });
}

function getInsertGenreProcess(data) {
    switch(data.id) {
        case "error":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del Genero!</strong></div>");
        break;

        case "success":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/genreViews/genreListView.php?msg=" + data.id; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
    }
}