<section class="content-block-nopad bg-deepocean">
    <div class="container footer">
        <div class="col-md-4 pull-left">
            <img src="../resources/images/logoFooter.png" class="brand-img img-responsive">
            <ul class="social social-light">
                <li><a href="#"><i class="fa fa-2x fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-2x fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-2x fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-2x fa-pinterest"></i></a></li>
                <li><a href="#"><i class="fa fa-2x fa-behance"></i></a></li>
                <li><a href="#"><i class="fa fa-2x fa-dribbble"></i></a></li>
            </ul>
        </div>
        <div class="col-md-3 pull-right">
            <div class="editContent">
                <p class="address-bold-line">Regalate lo mejor <span class="fa fa-gift"></span></p>
            </div>
            <div class="editContent">
                <p class="address small">
                    Calle Falsa 123,
                    <br> Vicialand,
                    <br> Piso X
                </p>
            </div>
        </div>
        <div class="col-xs-12 footer-text">
            <div class="editContent">
                <p>Puedes leer los <a href="#">Terminos &amp; Condiciones</a> y <a href="#">Politica de Privacidad</a></p>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="../resources/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../resources/js/jquery-ui.js"></script>
<script type="text/javascript" src="../resources/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../resources/js/calendar.js"></script>
<script type="text/javascript" src="../resources/js/js.cookie.js"></script>
<script type="text/javascript" src="../resources/js/jqueryscrollTo.js"></script>
<script type="text/javascript" src="../resources/js/scrollTogeneric.js"></script>
<script type="text/javascript" src="../resources/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="../resources/js/logoutFunction.js"></script>

<!--[if lt IE 9]><script src="js/html5shiv.js"></script><script src="js/respond.min.js"></script><![endif]-->
<script>
    String.prototype.fileExists = function() {
        filename = this.trim();
        var response = jQuery.ajax({
            url: filename,
            type: 'HEAD',
            async: false
        }).status;
        return (response != "200") ? false : true;
    }
</script>
<!--    SEARCH  -->
<script type="text/javascript">
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();
$("#search").on("keyup", function(e) {
    e.preventDefault();
    delay(function() {
        search();
    }, 400);
});
function search() {
    $("#result").slideUp();
    var params = {
        "search" : $("#search").val()
    };
    $.ajax({
        data:  params,
        url:   '../../controller/gameControllers/searchGameController.php',
        type:  'POST',
        beforeSend: function () {
            $("#result").html("Procesando, espere por favor...");
        },
        success:  function (response) {
            if(response=="") {
                $("#result").slideUp();
            } else {
                $("#result").slideDown();
                $("#result").html(response);

            }
        }
    });
}
</script>
<!--    FILTER  -->
<script type="text/javascript">
    function isEmptyJSON(obj) {
        for(var i in obj) { return false; }
            return true;
    }
    $(document).ready(function() {
        $(".genreFilter").on("click", function(e){
            e.preventDefault();
            $(".genreFilter").each(function() {
                $(this).find("#selected").remove();
            });
            $(".platformFilter").each(function() {
                $(this).find("#selected").remove();
            });
            var params = {"genre" : $(this).attr("id")};
            $.ajax({
                data: params,
                url:   '../../controller/gameControllers/filterGamesController.php',
                type:  'POST',
                typeData: 'json',
                success:  function (json) {
                    if (json.length>=3) {
                        $.each($.parseJSON(json), function() {
                            var existFilePath = "../resources/images/games/"+this.id+".png";
                            if (!existFilePath.fileExists()) {
                                existFilePath = "../resources/images/games/noimage.png";
                            }
                            var linesHTML = '<style>.offerOldPrice {text-decoration:line-through;}</style>';
                            linesHTML += '<div class="col-md-3 col-sm-6 col-xs-12">';
                            linesHTML += '<div class="gallery-item" id="Game_'+this.id+'">';
                            linesHTML += '<div class="gallery-thumb" title="'+this.title+'"><img src="'+existFilePath+'" width="800px" height="600px" class="img-responsive" alt="'+this.title+'">';
                            linesHTML += '<div class="image-overlay"></div>';
                            linesHTML += '<a href="gameDetailsView.php?gameid='+this.id+'" class="gallery-zoom"><i class="fa fa-eye"></i></a>';
                            linesHTML += '<a href="#" class="gallery-link buyItem"><i class="fa fa-shopping-cart"></i></a>';
                            linesHTML += '</div>';
                            linesHTML += '<div class="gallery-details">';
                            if (this.discount!=null) {
	                        	var priceDiscount = parseFloat(this.price)-(parseFloat(this.price)*parseFloat(this.discount)/parseFloat(100));
	                        	linesHTML += '<h5>'+this.title+'</h5><h6><span class="price"><font color="red"><strong>'+priceDiscount+' €</strong></font></span> (<span class="discount"><font color="green"><strong>'+this.discount+' % dto.</strong></font></span>)</h6>';
	                     	} else {
	                     		linesHTML += '<h5>'+this.title+'</h5><h6><span class="price"><font color="red"><strong>'+this.price+' €</strong></font></span></h6>';
	                     	}
                         linesHTML += '</div>';
                         linesHTML += '</div>';
                         linesHTML += '</div>'; 
                         linesHTML += '</div>';
                         $("#contentGames").html(linesHTML);
                     });
                    } else {
                        $("#contentGames").html("<div class='col-md-3 col-sm-6 col-xs-12'>No games for show");
                    }
                }
            });
            $(this).append('&nbsp;<i id="selected" class="fa fa-check" aria-hidden="true"></i>');
        });
        $(".platformFilter").on("click", function(e){
            e.preventDefault();
            $(".genreFilter").each(function() {
                $(this).find("#selected").remove();
            });
            $(".platformFilter").each(function() {
                $(this).find("#selected").remove();
            });
            var params = {"platform" : $(this).attr("id")};
            $.ajax({
                data: params,
                url:   '../../controller/gameControllers/filterGamesController.php',
                type:  'POST',
                typeData: 'json',
                success:  function (json) {
	               if (json.length>=3) {
		                    var linesHTML = '<style>.offerOldPrice {text-decoration:line-through;}</style>';
		                    $.each($.parseJSON(json), function() {
		                        var existFilePath = "../resources/images/games/"+this.id+".png";
		                        if (!existFilePath.fileExists()) {
		                            existFilePath = "../resources/images/games/noimage.png";
		                        }
		                        linesHTML += '<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper isotope-item">';
		                        linesHTML += '<div class="gallery-item" id="Game_'+this.id+'">';
		                        linesHTML += '<div class="gallery-thumb" title="'+this.title+'"><img src="'+existFilePath+'" class="img-responsive" alt="'+this.title+'">';
		                        linesHTML += '<div class="image-overlay"></div>';
		                        linesHTML += '<a href="detailsProduct.php?gameid='+this.id+'" class="gallery-zoom"><i class="fa fa-eye"></i></a>';
		                        linesHTML += '<a href="#" class="gallery-link buyItem"><i class="fa fa-shopping-cart"></i></a>';
		                        linesHTML += '</div>';
		                        linesHTML += '<div class="gallery-details">';
		                        linesHTML += '<div class="editContent">';
		                        if (this.discount!=null) {
		                        	var priceDiscount = parseFloat(this.price)-(parseFloat(this.price)*parseFloat(this.discount)/parseFloat(100));
		                        	linesHTML += '<h5>'+this.title+'</h5><h6><span class="price"><font color="red"><strong>'+priceDiscount+' €</strong></font></span> (<span class="discount"><font color="green"><strong>'+this.discount+' % dto.</strong></font></span>)</h6>';
		                     	} else {
		                     		linesHTML += '<h5>'+this.title+'</h5><h6><span class="price"><font color="red"><strong>'+this.price+' €</strong></font></span></h6>';
		                     	}
		                     linesHTML += '</div>';
		                     linesHTML += '</div>';
		                     linesHTML += '</div>';
		                     linesHTML += '</div>'; 
		                 });
		                    linesHTML += '';
		                    $("#contentGames").html(linesHTML);
		            } else {
		                	$("#contentGames").html("<div class='col-md-3 col-sm-6 col-xs-12'>No games for show");
		            	}
           			}
        		});
            $(this).append('&nbsp;<i id="selected" class="fa fa-check" aria-hidden="true"></i>');
        });
    });
</script>
<!-- SHOPPING CART -->
<script>
	function Game(id, name, price, image, quantity, discount) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.image = image;
        this.quantity = quantity;
        this.discount = discount;
    }
    var shoppingCart = typeof Cookies.get('shoppingCart');
    if (shoppingCart == "undefined") {
        $("#basket").html("<p style='margin-left: 8px'><font color='white'>Carrito de la compra vacio.</font></p>");
    } else {
        var json = Cookies.getJSON('shoppingCart');
        updateTotalShopping(json);
        var nitems = 0;
        $.each(json, function(i, item) {
            $product = $("#Product"+item.id);
            if($product.length > 0) {
                $("#Product"+item.id).find("#quantity").text("x"+item.quantity);
            } else {
                var buttonRemoveHTML = '<button type="button" class="removeItem btn btn-danger" style="position: absolute;padding: 0px;margin: 0px;margin-left: 145px;width: 19px;">X</button>';
                $("#basket").append('<span class="item" id="Product'+item.id+'">'+buttonRemoveHTML+'<span onclick="loadDetailGame('+item.id+')" class="item-left"><img src="'+item.image+'" alt="'+item.name+'" width="85px" height="105px"/><span class="item-info"><span>'+item.name+'</span><span id="quantity">x'+item.quantity+'</span><span>'+(parseFloat(item.price)*parseFloat(item.quantity))+' €</span></span></span></span><li class="divider"></li>');
                nitems++;
            }
        });
        $("#countShoppingCart").text(nitems);
    }
    //buy from index and games.php
    $(document).on("click", ".buyItem", function (e) {
        e.preventDefault();
        var nitemsOld = 0;
        if ($("#countShoppingCart").text()!="") {
            nitemsOld = $("#countShoppingCart").text();
        } else {
            $("#basket").html("");
        }
        var nitems = parseInt(nitemsOld)+parseInt(1);
        $item = $(this).parent().parent().find(".gallery-details");
        var itemImageURL = $(this).parent().find("img:eq(0)").attr("src");
        var id = $(this).parent().parent().attr("id");
        id = id.split("_")[1];
        var title = $item.find("h5:eq(0)").text();
        var price = $item.find(".price strong:eq(0)").text().replace("€", "");
        var discount = $item.find(".discount").text().replace(" % dto.", "");
        var newGame = true;
        if (typeof Cookies.getJSON('shoppingCart') == "undefined") {
            var items = Array();
            var game = new Game(id, title, price, itemImageURL, 1, discount);
            items.push(game);
            var shoppingCart = JSON.stringify(items);
            Cookies.set('shoppingCart', shoppingCart, { expires: 1 });
            $("#countShoppingCart").text(nitems);
            updateTotalShopping(Cookies.getJSON('shoppingCart'));
        } else {
            var items = Cookies.getJSON('shoppingCart');
            var game = getGame(items, id);
            if(game==null) {
                newGame = true;
                game = new Game(id, title, price, itemImageURL, 1, discount);
                items.push(game);
                $("#countShoppingCart").text(nitems);
            } else {
                newGame = false;
                quantitygame = parseInt(game.quantity);
                $("#Product"+id).find(".item-info span:eq(1)").text("x"+(quantitygame));
                $("#Product"+id).find(".item-info span:eq(2)").text((parseFloat(price)*parseFloat(game.quantity))+" €");
            }
            Cookies.set('shoppingCart', items, { expires: 1 });
            updateTotalShopping(Cookies.getJSON('shoppingCart'));
        }
        if (newGame) {
            var buttonRemoveHTML = '<button type="button" class="removeItem btn btn-danger" style="position: absolute;padding: 0px;margin: 0px;margin-left: 145px;width: 19px;">X</button>';
            var linesHTML = '<span class="item" id="Product'+id+'">'+buttonRemoveHTML+'<span onclick="loadDetailGame('+id+')" class="item-left">';
            linesHTML += '<img src="'+itemImageURL+'" alt="'+title+'" width="85px" height="105px"/><span class="item-info">';
            linesHTML += '<span>'+title+'</span>';
            linesHTML += '<span class="quantity">x'+game.quantity+'</span>';
            linesHTML += '<span class="price">'+(parseFloat(price)*parseFloat(game.quantity))+' €</span>';
            linesHTML += '</span></span></span>';
            $("#basket").append(linesHTML);
            updateTotalShopping(Cookies.getJSON('shoppingCart'));
        }
    });
//buy from detailProduct
$(document).on("click", ".buyGame", function (e) {
    e.preventDefault();
    var nitemsOld = 0;
    if ($("#countShoppingCart").text()!="") {
        nitemsOld = $("#countShoppingCart").text();
    } else {
        $("#basket").html("");
    }
    var nitems = parseInt(nitemsOld)+parseInt(1);
    $item = $(".divspan");
    var itemImageURL = $item.find(".imgDetail > img").attr("src");
    var id = $item.attr("id");
    id = id.split("_")[1];
    var title = $item.find(".spantitul").text();
    var price = $item.find(".spanprecio").text().replace("€", "");;
    var newGame = true;
    if (typeof Cookies.getJSON('shoppingCart') == "undefined") {
        var items = Array();
        var game = new Game(id, title, price, itemImageURL, 1);
        items.push(game);
        var shoppingCart = JSON.stringify(items);
        Cookies.set('shoppingCart', shoppingCart, { expires: 1 });
        $("#countShoppingCart").text(nitems);
        updateTotalShopping(Cookies.getJSON('shoppingCart'));
    } else {
        var items = Cookies.getJSON('shoppingCart');
        var game = getGame(items, id);
        if(game==null) {
            newGame = true;
            game = new Game(id, title, price, itemImageURL, 1);
            items.push(game);
            $("#countShoppingCart").text(nitems);
        } else {
            newGame = false;
            $("#Product"+id).find(".quantity").text("x"+game.quantity);
            $("#Product"+id).find(".price").text((parseFloat(price)*parseFloat(game.quantity))+" €");
        }
        Cookies.set('shoppingCart', items, { expires: 1 });
        updateTotalShopping(Cookies.getJSON('shoppingCart'));
    }
    if (newGame) {
        var buttonRemoveHTML = '<button type="button" class="removeItem btn btn-danger" style="position: absolute;padding: 0px;margin: 0px;margin-left: 145px;width: 19px;">X</button>';
        var linesHTML = '<span class="item" id="Product'+id+'">'+buttonRemoveHTML+'<span onclick="loadDetailGame('+id+')" class="item-left">';
        linesHTML += '<img src="'+itemImageURL+'" alt="'+title+'" width="85px" height="105px"/><span class="item-info">';
        linesHTML += '<span>'+title+'</span>';
        linesHTML += '<span class="quantity">x'+game.quantity+'</span>';
        linesHTML += '<span class="price">'+(parseFloat(price)*parseFloat(game.quantity))+' €</span>';
        linesHTML += '</span></span></span>';
        $("#basket").append(linesHTML);
    }
});
//functions game
function getGame(json, idgame) {
    var game = null;
    $.each(json, function(i, item) {
        if (item.id==idgame) {
            item.quantity++;
            game = item;
        }
    });
    return game;
}
function getGameObj(json, idgame) {
    var game = null;
    $.each(json, function(i, item) {
        if (item.id==idgame) {
            game = item;
        }
    });
    return game;
}
function getGameDecr(json, idgame) {
    var game = null;
    $.each(json, function(i, item) {
        if (item.id==idgame) {
            item.quantity--;
            game = item;
        }
    });
    return game;
}
function getPositionGame(json, idgame) {
    var gamePos = -1;
    $.each(json, function(i, item) {
        if (item.id==idgame) {
            gamePos = i;
        }
    });
    return gamePos;
}

function getNumItems(json) {
    var nItems = 0;
    $.each(json, function() {
        nItems++;
    });
    return nItems;
}

function loadDetailGame(idgame) {
    window.location.href="../gameViews/gameDetailsView.php?gameid="+idgame;
    return false;
}

function updateTotalShopping(json) {
    var price = parseFloat(0);
    $.each(json, function(i, item) {
        price = parseFloat(price) + (parseFloat(item.price)*parseFloat(item.quantity));
    });
    $("#shoppingCartTotal").html("Total: " + price + " €");
}


$(document).ready(function() {
    $(document).on("click", "#clearShop", function() {
        $("#basket").html("");
        $("#countShoppingCart").html("");
        Cookies.remove('shoppingCart');
        $("#shoppingCartTotal").text("Total: 0 €");
    });
    $(document).on("click", ".removeItem", function (e) {
        e.preventDefault();
        $obj = $(this).parent();
        var idgame = $obj.attr("id").replace("Product", "");
        var games = Cookies.getJSON('shoppingCart');
        var quantitygame = getGameObj(games, idgame).quantity;
        if (quantitygame<=1) {
            $obj.remove();
            games.splice(getPositionGame(games, idgame), 1);
            var shoppingCart = JSON.stringify(games);
            Cookies.set('shoppingCart', shoppingCart, { expires: 1 });
        } else {
            var game = getGameDecr(games, idgame);
            var shoppingCart = JSON.stringify(games);
            Cookies.set('shoppingCart', shoppingCart, { expires: 1 });
            quantitygame = parseInt(game.quantity);
            $obj.find(".item-info span:eq(1)").text("x"+(quantitygame));
            $obj.find(".item-info span:eq(2)").text((parseFloat(game.price)*parseFloat(game.quantity))+" €");
        }
        $("#countShoppingCart").text(getNumItems(games));
        updateTotalShopping(games);
    });

});

</script>
<!--  GET FROM URL -->
<script>
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
</script>