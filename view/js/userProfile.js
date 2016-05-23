$(document).ready(load);

function load() {

    $('#datosPersonales').click(function () {
        $('#profileForm').toggle(500);
    });

    $('#shoppings').click(function () {
        $('#userShoppings').toggle(500);
    });

    $('#messages').click(function () {
        $('#messagesList').toggle(500);
    });
    
    $('#configuracion').click(function () {
        $('#configuracionUsuario').toggle(500);
    });

    $('#update-registered').click(function() {
        var email = $("#email").val();
        var birthdate = $("#calendar").val();
        var paypal = $("#paypal").val();
        var country = $("#country").val();        
        var image = $("#image").val();

        var registered = {"email":email, "birthdate":birthdate, "paypal":paypal, "country":country, "image":image};
        updateUser(registered);
    });

    $('#delete-registered').click(function() {
        var checkbox = $('input:checkbox[name=deleteCheckBox]:checked').val();

        if (checkbox == 'on') {

            var alert ="<img class=\"alert-img\" src=\"images/alert.png\"/>";
            var deleteButton = "<button id=\"delete\" name=\"delete\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
            var cancelButton = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
            var form = "<form action=\"../controller/deleteRegisteredController.php\">" + deleteButton + " " + cancelButton + "</form>";
            var deleteAccount = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Realmente deseas eliminar definitivamente tu cuenta?</p>" + form + "</div></div>";

            $("body").append("<div class=\"delete\">" + deleteAccount + "</div>");
        }
    });   

    /* Obtener mensajes privados */
    var url = "showInboxMessagesView";
    var page = getPageName();

    if (url == page) {
        setInterval(getPrivateMessages(), 2000);
    }

    /* Evento del botón de envío de mensaje privado */
    $('#sendPrivateMessage').click(function() {
        var receiverName = $("#receiverName").val();
        var message = $(".contentMessage").val();
        var infoMessage = {"receiverName":receiverName, "message":message};
        sendMessage(infoMessage);
    });
        
}

function cancelDelete() {
   $(".delete").remove();
}

function updateUser(registered) { 
    var registered = JSON.stringify(registered);
    $.ajax({
        data: "registered=" + registered,
        url: '../controller/updateRegisteredController.php',   
        type: 'POST',
        dataType: 'json',
        success: getUpdateResponseMessage
    });
}

/* Mensajes de actualización del perfil de usuario */
function getUpdateResponseMessage(data) {

    if (data == 0) {
        $("#general-error").html("<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-add\"></span> ¡Tus datos se han actualizado satisfactoriamente!</strong></div>");
    } else {
        $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del usuario!</strong></div>");
    }
}

/* Envío de mensaje privado */
function sendMessage(infoMessage) {
    var infoMessage = JSON.stringify(infoMessage);

    $.ajax({
        data: "infoMessage=" + infoMessage,
        url: '../controller/sendPrivateMessageController.php',
        type: 'POST',
        dataType: 'json',
        success: getSendMessageResponse
    });
}

/* Mensajes de envío de mensaje privad */
function getSendMessageResponse(data) {

    if (data == "success") {
        $("#general-error").html("<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-add\"></span> ¡Tu mensaje ha sido enviado!</strong></div>");
        $("#receiverName").val("");
        $(".contentMessage").val("");
    } else {
        if (data == "username") {
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en el envío del mensaje! El nombre de usuario es incorrecto o no se encuentra en nuestra base de datos</strong></div>");
        }
        else {
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en el envío del mensaje! Por favor revisa los campos y prueba de nuevo</strong></div>");
        }
    }
}

/* Get private messages jquery / ajax function */
function getPrivateMessages() {
    $.ajax ({
        url: "../controller/getPrivateMessagesController.php",
        type: "POST",
        success: function(messages) {
            $("#privateMessages").html(messages);
        }
    });
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

