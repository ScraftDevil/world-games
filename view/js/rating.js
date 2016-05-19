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
        beforeSend: function () {
                $(this).parent().html("Porfavor espere...");
        },
        success:  function (response) {
                $(this).parent().html("OK!");
        }
    });
});

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