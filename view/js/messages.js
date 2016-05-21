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

/*$('#enviar').click(function(){
var i = 0;

  var n = $( ".divcomentari" ).size();*/
  //  alert("total divs creats: "+n);
//$('.divcomentari').each(function () { 
   
  //$('body').scrollTo(".divcomentari",{duration:2000, offsetTop : '50'});
//});

     
  //  });

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
          $("#comentari").val("");
          $(".ocultar").show();
          if (data=="LOGIN_ERROR") {
            $("#message").removeClass("alert-success");
            $("#message").addClass("alert-info");
            $("#message").html("Entra a tu cuenta para poder comentar.");
          }
          else {
            if (data=="EMPTY_INPUT") {
              $("#message").removeClass("alert-success");
              $("#message").addClass("alert-info");
              $("#message").html("No has introducido mensaje.");
              $("#comentari").each(function () {
                this.style.setProperty( 'border', '3px solid red', 'important' );
              });
            } else {
              $("#message").removeClass("alert-info");
              $("#message").addClass("alert-success");
              $("#message").html("Se ha enviado el mensaje con exito.");
              $(".ocultar").delay(2000).hide(100);
              $("#comentari").each(function () {
                this.style.setProperty( 'border', '3px solid green', 'important' );
              });
            }
          }
        }
      });
    });
});
