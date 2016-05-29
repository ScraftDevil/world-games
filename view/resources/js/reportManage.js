$(document).ready(load);

function load() {
 
   /*var url = "showInboxMessagesView";
   var page = getPageName();*/

$('#sendReportreason').click(function() {
    var reportuserName = $("#reportuserName").val();
    var reason = $(".reasonreport").val();
    var contentreport = $(".contentReport").val();
    
    var infoReport = {"reportuserName":reportuserName, "reasonreport":reason,"contentReport":contentreport};
    sendReport(infoReport);
});

}

/* Envío de mensaje privado */
function sendReport(infoReport) {
    var infoReport = JSON.stringify(infoReport);

    $.ajax({
        data: "infoReport=" + infoReport,
        url: '../../controller/reportController/sendPrivateMessageController.php',
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