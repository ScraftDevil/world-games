$(document).ready(load);

function load() {

    $('#datosPersonales').click(function () {
        $('#profileForm').toggle(500);
    });

    $('#compras').click(function () {
        $('#comprasUsuario').toggle(500);
    });

    $('#mensajes').click(function () {
        $('#mensajesUsuario').toggle(500);
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

    $('#sendPrivateMessage').click(function() {
        var emailReceiver = $("#emailReceiver").val();
        var message = $("#contentMessage").val();

        var infoMessage = {"emailReceiver":emailReceiver, "message":message};
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

function getUpdateResponseMessage(data) {

    if (data == 0) {
        $("#general-error").html("<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-add\"></span> ¡Tus datos se han actualizado satisfactoriamente!</strong></div>");
    } else {
        $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del usuario!</strong></div>");
    }
}

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

function getSendMessageResponse(data) {
    alert(data);

    if (data != null) {
        $("#general-error").html("<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-add\"></span> ¡Tu mensaje ha sido enviado!</strong></div>");
    } else {
        $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en el envío del mensaje!</strong></div>");
    }
}

