$(document).ready(load);

function load() {
 
   
$('#sendComplainreason').click(function() {
    
    var reasoncomplain = $("#reasoncomplain").val();
    var contentcomplain = $("#contentcomplain").val();
    
    var infoComplain = { "reasoncomplain":reasoncomplain,"contentcomplain":contentcomplain};
    
    sendComplain(infoComplain);
});

}

/* Envío de mensaje privado */
function sendComplain(infoComplain) {
    var infoComplain = JSON.stringify(infoComplain);

    $.ajax({
        data: "infoComplain=" + infoComplain,
        url: '../../controller/complainController/sendComplainController.php',
        type: 'POST',
        dataType: 'json',
        success: getSendComplainResponse
    });
}

/* Mensajes de envío de mensaje privad */
function getSendComplainResponse(data) {

    if (data == "success") {
        $("#general-error").html("<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-add\"></span> ¡Tu denuncia ha sido enviado!</strong></div>");
        $("#reasonreport").val("");
        $("#contentReport").val("");
    } else {
        if (data == "username") {
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en el envío de la denuncia! El nombre de usuario es incorrecto o no se encuentra en nuestra base de datos</strong></div>");
        }
        else {
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en el envío de la denuncia! Por favor revisa que los campos no esten vacíos y prueba de nuevo</strong></div>");
        }
    }
}