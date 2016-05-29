$(document).ready(load);

function load() {
 
   /*var url = "showInboxMessagesView";
   var page = getPageName();*/

$('#sendReportreason').click(function() {
    
    var reportuserName = $("#reportuserName").val();
    var reasonreport = $("#reasonreport").val();
    var contentReport = $("#contentReport").val();
    
    var infoReport = {"reportuserName":reportuserName, "reasonreport":reasonreport,"contentReport":contentReport};
    
    sendReport(infoReport);
});

}

/* Envío de mensaje privado */
function sendReport(infoReport) {
    var infoReport = JSON.stringify(infoReport);

    $.ajax({
        data: "infoReport=" + infoReport,
        url: '../../controller/reportController/sendReportController.php',
        type: 'POST',
        dataType: 'json',
        success: getSendReportResponse
    });
}

/* Mensajes de envío de mensaje privad */
function getSendReportResponse(data) {

    if (data == "success") {
        $("#general-error").html("<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-add\"></span> ¡Tu queja ha sido enviado!</strong></div>");
        $("#reasonreport").val("");
        $("#contentReport").val("");
    } else {
        if (data == "username") {
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en el envío de la queja! El nombre de usuario es incorrecto o no se encuentra en nuestra base de datos</strong></div>");
        }
        else {
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en el envío de la queja! Por favor revisa que los campos no esten vacíos y prueba de nuevo</strong></div>");
        }
    }
}