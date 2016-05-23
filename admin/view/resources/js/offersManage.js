$(document).ready(load);

function load() {

  $("#insert-offer").click(function() {
    var discount = $("#discount").val();
    var game = $("#game").val();
    var offer = {"discount": discount, "game": game};
    sendOffer(offer);
  });

  var offerid = getterURL("id");
  var data = {"id": offerid};
  getOffer(data);
  $("#update-offer").click(function() {
    var id = offerid;
    var discount = $("#discount").val();
    var offer = {"id": id, "discount": discount};
    updateOffer(offer);
  });

}

/// OFFERS ACTIONS START

function getOffer(data) {
   var data = JSON.stringify(data);
   $.ajax({
      data:  "data=" + data,
      url:   '../../controller/offerControllers/getOfferInfoController.php',
      type:  'POST',
      dataType: 'json',
      success: getOfferInfo
  });
}

function getOfferInfo(data) {
   if(data != null) {
      $("#discount").val(data[0].Discount);
   }
}

function sendOffer(offer) {
    var offer = JSON.stringify(offer);
    $.ajax({
        data:  "offer=" + offer,
        url:   '../../controller/offerControllers/newOfferController.php',
        type:  'POST',
        dataType: 'json',
        success: getInsertOfferProcess
    });
}

function getInsertOfferProcess(data) {
    switch(data.id) {
        case "errorOffer":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos de la oferta!</strong></div>");
        break;

        case "successOffer":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/gameViews/gameListView.php?msg=" + data.id; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
    }
}

function updateOffer(offer) {
   var offer = JSON.stringify(offer);
   $.ajax({
      data:  "offer=" + offer,
      url:   '../../controller/offerControllers/updateOfferController.php',
      type:  'POST',
      dataType: 'json',
      success: getUpdateOfferProcess
  });
}

function getUpdateOfferProcess(data) {
  switch(data.id) {
    case "null-error":
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error en la validación de datos del usuario!</strong></div>");
        break;

        case "success":
            var delay = 0;
            setTimeout(function(){ window.location = "../../view/gameViews/gameListView.php?msg=successEditOffer"; }, delay);
        break;

        default:
            $("#general-error").html("<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error inesperado!</strong></div>");
        break;
  }
}

/// OFFERS ACTIONS FINISH