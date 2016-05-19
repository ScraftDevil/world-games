$(document).ready(function() {

setInterval(ajaxCall, 2000);

function ajaxCall() {
    $.ajax({
      type: "POST",
      url: "../controller/messages/getMessageController.php",
      data:         
      {
      "gameid":getterURL('gameid')
      },
      success: function(data) {
        $("#comentariosusers").html(data);
    }
  });
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

$("#enviar").click(function (){
    var comentari = $("#comentari ").val();
      $.ajax({
        type: "POST",

        url: "../controller/messages/insertMessageController.php",
        data:         
        {
          "comentari":comentari,
          "gameid":getterURL('gameid')
        },
        success: function(data) {
          $(".ocultar").show();
          $("#message").html("Se ha enviado el mensaje con exito.");
          $(".ocultar").delay(4000).hide(100);
        }
      });
    });
});
