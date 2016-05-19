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

$(document).ready(function() {
  //insert rating
  $("#rateBtn").on("click", function () {
    var rate = $(this).parent().parent().find("#rating").val();
    var params = {
      "rate" : rate,
      "gameid" : getterURL('gameid')
    };
    $.ajax({
      data:  params,
      url:   '../controller/rateGameController.php',
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
            break;
          }
          case "NO_RATE_INPUT":
          {
            $("#msgRate").html('<div class="alert alert-info">No puedes pasarte por el forro el control.</div>');
            break;
          }
        }
      }
    });
  });
  //get rating
  var params = {"gameid" : getterURL('gameid')};
  $.ajax({
    data: params,
    url:   '../controller/getRatingGame.php',
    type:  'POST',
    success:  function (response) {
      if (response == "") {
        $("#totalScore").html("Total Score: 0");
      } else {
        $("#totalScore").html("Total Score: " + response);
      }
    }
  });
});