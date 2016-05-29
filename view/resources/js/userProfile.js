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
        var country = document.getElementById("country").value;
        var image = "avatar";
        var registered = {"email":email, "birthdate":birthdate, "paypal":paypal, "country":country, "image":image};
        updateUser(registered);
    });


   $('#delete-registered').click(function() {
    var checkbox = $('input:checkbox[name=deleteCheckBox]:checked').val();

    if (checkbox == 'on') {
        $("#delete-confirm").css({'color':'black', 'font-weight':'normal'});
        var alert ="<img class=\"alert-img\" src=\"../resources/images/alert.png\"/>";
        var deleteButton = "<button id=\"delete\" name=\"delete\" type=\"submit\" class=\"btn btn-success btn-delete\">Borrar</button>";
        var cancelButton = "<button onclick=\"cancelDelete()\" type=\"button\" class=\"btn btn-danger btn-cancel\">Cancelar</button>";
        var form = "<form action=\"../../controller/profileControllers/deleteRegisteredController.php\">" + deleteButton + " " + cancelButton + "</form>";
        var deleteAccount = "<div class=\"confirm\"><div class=\"confirm-msg\">" + alert + "<p>¿Realmente deseas eliminar definitivamente tu cuenta?</p>" + form + "</div></div>";

        $("body").append("<div class=\"delete\">" + deleteAccount + "</div>");
    }
    else {
        $("#delete-confirm").css({'color':'red', 'font-weight':'bold'});
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
        url: '../../controller/profileControllers/updateRegisteredController.php',   
        type: 'POST',
        dataType: 'json',
        success: getUpdateResponseMessage
    });
}

/* Mensajes de actualización del perfil de usuario */
function getUpdateResponseMessage(data) {

    switch (data.id) {
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
        case "success":
            $("#general-error").html("<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-add\"></span> ¡Tus datos se han actualizado satisfactoriamente!</strong></div>");
            break;
        case "email-error":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-add\"></span> ¡La fecha no es válida!</strong></div>");
            break;
        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
            break;
    }
}

/* Envío de mensaje privado */
function sendMessage(infoMessage) {
    var infoMessage = JSON.stringify(infoMessage);

    $.ajax({
        data: "infoMessage=" + infoMessage,
        url: '../../controller/privateMessageControllers/sendPrivateMessageController.php',
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
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en el envío del mensaje! Por favor revisa que los campos no esten vacíos y prueba de nuevo</strong></div>");
        }
    }
}

/* Get private messages jquery / ajax function */
function getPrivateMessages() {
    $.ajax ({
        url: "../../controller/privateMessageControllers/getPrivateMessagesController.php",
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

$.validator.addMethod(
    "spainDate",
    function(value, element) {
        return value.match(/^\d\d\-\d\d\-\d\d\d\d$/);
    },
    "Fecha con formato incorrecto"
);

$("#profileForm").validate({ 
oonkeyup: true, 
    rules: {
        email: {
            required: true,
            email: true           
        },
        birthdate: {
            required: true,
            spainDate:true
        },
        paypal: {
            required: false,
            email: true,
            maxlength: 45
        },
        country: {
            required: true
        }
        
    },
    messages: {
        email: {
            required: "El campo email esta vacio",
            email: "Formato de email incorrecto",
          //  maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        },
        birthdate: {
            required: "La fecha de nacimiento esta vacio",
            date:"La fecha es invalida"
        },
        paypal: {
            email: "Formato de email incorrecto",
            //maxlength: jQuery.validator.format("No puedes poner mas de  {0} caracteres")
        },        
        country: {
            required: "El campo pais esta vacio"
        }        
    },
    submitHandler: function() {
        $('#update-registered').click(function() {
            var email = $("#email").val();
            var birthdate = $("#calendar").val();
            var paypal = $("#paypal").val();
            var country = $("#country").val();        
            var image = "avatar.png";
            var registered = {"email":email, "birthdate":birthdate, "paypal":paypal, "country":country, "image":image};
            updateUser(registered);
        });
    }
});