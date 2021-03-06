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

function showStars(nStars) {
  var rate = parseInt(nStars);
  var txt = "";
  var rateLast = 0;
  for(var i = 0; i < rate; i++) {
    txt += '<i id="star'+(i+1)+'" data-toggle="tooltip" title="Votar ' + (i+1) + ' estrellas" class="fa fa-star fa-2x" style="cursor: pointer; padding-top: 6px; color: #FFD700; font-weight: bold;" aria-hidden="true"></i>';
    rateLast++;
  }
  var needStars = 5-rate;
  for(var i = 0; i < needStars; i++) {
    txt += '<i id="star'+(rateLast+i+1)+'" data-toggle="tooltip" title="Votar ' + (rateLast+i+1) + ' estrellas" class="fa fa-star-o fa-2x" style="cursor: pointer; padding-top: 6px; color: #FFD700; font-weight: bold;" aria-hidden="true"></i>';
  }
  $("#rating").html(txt);
  $('[data-toggle="tooltip"]').tooltip();
}

$(document).ready(function() {
  //rating stars
  $('[data-toggle="tooltip"]').tooltip();
  $(document).on("mouseleave", ".imgDetail", function() {
    getRating();
  });
  $(document).on("click", "#rating i", function() {
    var scoreRate = $(this).attr("id").replace("star", "");
    var params = {
      "rate" : scoreRate,
      "gameid" : getterURL('gameid')
    };
    $.ajax({
      data:  params,
      url:   '../../controller/gameControllers/rateGameController.php',
      type:  'POST',
      dataType: 'json',
      beforeSend: function () {
        $(this).parent().parent().html("Porfavor espere...");
      },
      success:  function (json) {

        switch(json.msg) {
          case "LOGIN_ERROR":
          {
            $("#msgRate").html('<div class="alert alert-info">No has hecho login, no puedes puntuar.</div>');
            $("#msgRate").show(0).delay(5000).hide(0);
            break;
          }
          case "NO_RATE_INPUT":
          {
            $("#msgRate").html('<div class="alert alert-info">No se ha escogido un valor valido.</div>');
            $("#msgRate").show(0).delay(5000).hide(0);
            break;
          }
          case "ALREADY_RATED_GAME":
          {
            $("#msgRate").html('<div class="alert alert-warning">Ya has votado este juego.</div>');
            $("#msgRate").show(0).delay(5000).hide(0);
            break;
          }
          case "RATED_FAIL":
          {
            $("#msgRate").html('<div class="alert alert-danger">Error al votar. Intenta mas tarde.</div>');
            $("#msgRate").show(0).delay(5000).hide(0);
            break;
          }
          case "RATED_OK":
          {
            $("#msgRate").html('<div class="alert alert-success">Has votado el juego con exito.</div>');
            $("#msgRate").show(0).delay(5000).hide(0);
            getRating();
            break;
          }
        }
      }
    });
    showStars(scoreRate);
  });
  //get rating
  function getRating() {
    var params = {"gameid" : getterURL('gameid')};
    $.ajax({
      data: params,
      url:   '../../controller/gameControllers/getRatingGameController.php',
      type:  'POST',
      success:  function (response) {
        if (response == "") {
          showStars(0);
        } else {
          showStars(response);
        }
      }
    });
  }
  getRating();
});