/* GLOBAL */
String.prototype.fileExists = function() {
	filename = this.trim();
	var response = jQuery.ajax({
		url: filename,
		type: 'HEAD',
		async: false
	}).status;
	return (response != "200") ? false : true;
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
/*	FUNCTIONS AND CONSTRUCTOR FOR SHOPPING CART	*/
function Game(id, name, price, image, quantity, discount) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.image = image;
        this.quantity = quantity;
        this.discount = discount;
}
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
/*	SEARCH	*/
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
/*	SHOPPING CART	*/
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
                var buttonRemoveHTML = '<button type="button" class="removeItem btn btn-danger" style="position: relative;padding: 0px;margin: 0px;margin-left: 90%;width: 19px;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
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
            var buttonRemoveHTML = '<button type="button" class="removeItem btn btn-danger" style="position: relative;padding: 0px;margin: 0px;margin-left: 90%;width: 19px;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
            var linesHTML = '<span class="item" id="Product'+id+'">'+buttonRemoveHTML+'<span onclick="loadDetailGame('+id+')" class="item-left">';
            linesHTML += '<img src="'+itemImageURL+'" alt="'+title+'" width="85px" height="105px"/><span class="item-info">';
            linesHTML += '<span>'+title+'</span>';
            linesHTML += '<span class="quantity">x'+game.quantity+'</span>';
            linesHTML += '<span class="price">'+(parseFloat(price)*parseFloat(game.quantity))+' €</span>';
            linesHTML += '</span></span></span>';
            $("#basket").append(linesHTML);
            updateTotalShopping(Cookies.getJSON('shoppingCart'));
        }
    alertify.success("Producto añadido al carrito!"); 
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
            $("#Product"+id).find(".item-info span:eq(1)").text("x"+(game.quantity));
            $("#Product"+id).find(".item-info span:eq(2)").text((parseFloat(price)*parseFloat(game.quantity))+" €");
        }
        Cookies.set('shoppingCart', items, { expires: 1 });
        updateTotalShopping(Cookies.getJSON('shoppingCart'));
    }
    if (newGame) {
        var buttonRemoveHTML = '<button type="button" class="removeItem btn btn-danger" style="position: relative;padding: 0px;margin: 0px;margin-left: 90%;width: 19px;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
        var linesHTML = '<span class="item" id="Product'+id+'">'+buttonRemoveHTML+'<span onclick="loadDetailGame('+id+')" class="item-left">';
        linesHTML += '<img src="'+itemImageURL+'" alt="'+title+'" width="85px" height="105px"/><span class="item-info">';
        linesHTML += '<span>'+title+'</span>';
        linesHTML += '<span class="quantity">x'+game.quantity+'</span>';
        linesHTML += '<span class="price">'+(parseFloat(price)*parseFloat(game.quantity))+' €</span>';
        linesHTML += '</span></span></span>';
        $("#basket").append(linesHTML);
    }
    alertify.success("Producto añadido al carrito!"); 
});


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
    $("#shoppingBuy").on("click", function() {
        alertify.set({ labels: {
            ok     : "SI",
            cancel : "NO"
        } });
        alertify.confirm("Estas seguro que deseas realizar la compra?", function (e) {
            if (e) {
                buyItems();
            } else {
                alertify.error("Compra cancelada.");
            }
        });
    });
});

function loadShoppingCartDetails() {
    var json = Cookies.getJSON('shoppingCart');
    if (typeof json.length != "undefined" && json.length>=1) {
        $("#msgShoppingCartDetails").html("<strong>Información:</strong> Si quieres realizar la compra, dale clic en el boton 'Realizar Compra'");
        $("#shoppingBuy").prop('disabled', false);
    }
    var headHTML = '<thead><tr><th>Titulo</th><th>Cantidad</th><th>Precio</th></tr></thead>';
    var bodyHTML = ' <tbody>';
    var bodyDynamicContentHTML = '';
    var bodyEndHTML = ' </tbody>';
    $.each(json, function(i, item) {
        bodyDynamicContentHTML += '<tr><td>'+item.name+'</td><td>'+item.quantity+'</td><td>'+item.price+' €</td></tr>';
    });
    $("#shoppingCartDetails").html(headHTML+bodyHTML+bodyDynamicContentHTML+bodyEndHTML);
}

function buyItems() {
    var params = {
        "shoppingCart" : Cookies.getJSON('shoppingCart')
    };
    $.ajax({
        data:  params,
        url:   '../../controller/gameControllers/insertShoppingController.php',
        type:  'POST',
        dataType: 'json',
        success:  function (response) {
            if(response.status=="SHOPPING_OK") {
                $("#msgShoppingCartDetails").remove();
                $("#shoppingCartDetails").html('<div id="msgShoppingCartDetails" class="alert alert-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Se ha realizado la compra con exito.</div>');
                Cookies.set('shoppingCart', Array(), { expires: 1 });
                $("#basket").html("<p style='margin-left: 8px'><font color='white'>Carrito de la compra vacio.</font></p>");
                updateTotalShopping(0);
                $("#countShoppingCart").text(0);
            } else if(response.status=="ERROR") {
                $("#msgShoppingCartDetails").html("Ha habido un problema al comprar. Contacta con nuestros miembros del Staff para mas información.");
            } else if(response.status=="ERROR_STOCK") {
                $("#msgShoppingCartDetails").html("Ha habido un problema con la compra debido a que algun producto de los seleccionados ya no se encuentra disponible. Contacta con nuestros miembros del Staff para mas información.");
            } else if(response.status=="LOGIN_ERROR") {
                $("#msgShoppingCartDetails").html("No has entrado en tu cuenta. Por lo tanto, no puedes comprar.");
            }
        },
        error: function () {
            $("#msgShoppingCartDetails").remove();
                $("#shoppingCartDetails").html('<div id="msgShoppingCartDetails" class="alert alert-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> No se ha podido realizar la compra. Por favor, Intente mas tarde.</div>');
        }
    });
}