<section class="content-block-nopad bg-deepocean">
    <div class="container footer">
        <div class="col-md-4 pull-left">
            <img src="images/logoFooter.png" class="brand-img img-responsive">
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
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/headroom.js"></script>
<script type="text/javascript" src="js/jquery.headroom.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/jquery.counterup.min.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/bskit-scripts.js"></script>
<script type="text/javascript" src="js/userProfile.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/js.cookie.js"></script>
<script type="text/javascript" src='js/message.js'></script>
<script src='js/jquery.rating.js' type="text/javascript" language="javascript"></script>
<!--[if lt IE 9]><script src="js/html5shiv.js"></script><script src="js/respond.min.js"></script><![endif]-->
<script type="text/javascript">
$(document).ready(function() {
    $('#star').rating('../controller/advote.php', {maxvalue: 5});
});
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
        url:   '../controller/controllerSearch.php',
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
<!--    LOGIN  -->
<script type="text/javascript">
    $(window).load(function() {
        $("#msg").css("display", "none");
        $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('.title').html("ENTRAR");
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
       $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('.title').html("REGISTRO");
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $("#login-form").on("submit", function (e) {
        e.preventDefault();
        var params = {"username" : $("#username").val(), "password" : $("#password").val()};
            $.ajax({
                data:  params,
                url:   '../controller/controllerLogin.php',
                type:  'POST',
                dataType: 'json',
                success:  function (data) {
                    if (data.STATUS=="LOGIN_INVALID_INFO") {
                        $("#msg").attr("class", "alert alert-danger");
                        $("#msg").html('<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>&nbsp;Usuario y/o contraseña incorrecto. Compruebelo e intente de nuevo.');
                        $("#msg").slideDown();
                    } else if(data.STATUS=="LOGIN_OK") {
                        $("#msg").attr("class", "alert alert-success");
                        $("#msg").html('<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span><span class="sr-only">Login Correcto:</span>&nbsp;Has entrado con exito en la cuenta. Seras redirigido a tu perfil en menos de 1 segundo.');
                        $("#msg").slideDown();
                        var delay = 1000;
                        setTimeout(function(){ window.location = "../index.php"; }, delay);
                    }
                }
            });
            return false;
    });

    //Función jQuery - Ajax para hacer Logout
    $("#logout").on("click", function () {
            $.ajax({
                url:   '../controller/controllerLogout.php',
                type:  'POST',
                success:  function (response) {
                    //Pendiente: Añadir mensaje cuando haga logout
                    window.location = "../index.php";
                }
            });
    });
   });
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
            url:   '../controller/controllerFilterGames.php',
            type:  'POST',
            typeData: 'json',
            success:  function (json) {
                //
                if (isEmptyJSON(json)) {
                    $("#isotope-gallery-container").html("No games to show!");
                } else {
                    $.each($.parseJSON(json), function() {
                         var linesHTML = "";
                        linesHTML += '';
                        linesHTML += '<style>.offerOldPrice {text-decoration:line-through;}</style>';
                        linesHTML += '<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper isotope-item" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);">';
                        linesHTML += '<div class="gallery-item">';
                        linesHTML += '<div class="gallery-thumb" title="'+this.title+'"><img src="images/games/'+this.title+'.png" width="800px" height="600px" class="img-responsive" alt="'+this.title+'">';
                        linesHTML += '<div class="image-overlay"></div>';
                        linesHTML += '<a href="detailsProduct.php?gameid='+this.id+'" class="gallery-zoom"><i class="fa fa-eye"></i></a>';
                        linesHTML += '<a href="#" class="gallery-link buyItem"><i class="fa fa-shopping-cart"></i></a>';
                        linesHTML += '</div>';
                        linesHTML += '<div class="gallery-details">';
                        linesHTML += '<div class="editContent">';
                        if (this.discount==null) {
                           linesHTML += '<h5>'+this.title+'</h5><h6>'+this.price+' €</h6>';
                        } else {
                            linesHTML += '<h5>'+this.title+'</h5><h6><span class="offerOldPrice">60 €</span> Ahora: 24.00 €</h6><h6>60 % de descuento</h6>';
                        }
                        linesHTML += '</div>';
                        linesHTML += '</div>';
                        linesHTML += '</div>'; 
                        linesHTML += '</div>';
                        linesHTML += '';
                        $("#isotope-gallery-container").html(linesHTML);
                    });
                    //
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
            url:   '../controller/controllerFilterGames.php',
            type:  'POST',
            typeData: 'json',
            success:  function (json) {
                //
                if (isEmptyJSON(json)) {
                    $("#isotope-gallery-container").html("No games to show!");
                } else {
                    var linesHTML = '';
                    linesHTML += '<style>.offerOldPrice {text-decoration:line-through;}</style>';
                    $.each($.parseJSON(json), function() {
                        linesHTML += '<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper isotope-item">';
                        linesHTML += '<div class="gallery-item" id="Game_'+this.id+'">';
                        linesHTML += '<div class="gallery-thumb" title="'+this.title+'"><img src="images/games/'+this.title+'.png" width="800px" height="600px" class="img-responsive" alt="'+this.title+'">';
                        linesHTML += '<div class="image-overlay"></div>';
                        linesHTML += '<a href="detailsProduct.php?gameid='+this.id+'" class="gallery-zoom"><i class="fa fa-eye"></i></a>';
                        linesHTML += '<a href="#" class="gallery-link buyItem"><i class="fa fa-shopping-cart"></i></a>';
                        linesHTML += '</div>';
                        linesHTML += '<div class="gallery-details">';
                        linesHTML += '<div class="editContent">';
                        if (this.discount==null) {
                           linesHTML += '<h5>'+this.title+'</h5><h6>'+this.price+' €</h6>';
                        } else {
                            linesHTML += '<h5>'+this.title+'</h5><h6><span class="offerOldPrice">60 €</span> Ahora: 24.00 €</h6><h6>60 % de descuento</h6>';
                        }
                        linesHTML += '</div>';
                        linesHTML += '</div>';
                        linesHTML += '</div>';
                        linesHTML += '</div>'; 
                    });
                        linesHTML += '';
                        $("#isotope-gallery-container").html(linesHTML);
                    //
                }
            }
        });

        $(this).append('&nbsp;<i id="selected" class="fa fa-check" aria-hidden="true"></i>');
    });
});
</script>
<!-- SHOPPING CART -->
<script>
var shoppingCart = typeof Cookies.get('shoppingCart');
if (shoppingCart == "undefined") {
    $("#basket").html("No hay productos añadidos al carrito");
} else {
    var json = Cookies.getJSON('shoppingCart');
    var nitems = 0;
    $.each(json, function(i, item) {
        $product = $("#Product"+item.id);
        if($product.length > 0) {
            $("#Product"+item.id).find("#quantity").text("x"+item.quantity);
        } else {
            var buttonRemoveHTML = '<button type="button" class="removeItem btn btn-danger" style="position: absolute;padding: 0px;margin: 0px;margin-left: 145px;width: 19px;">X</button>';
            $("#basket").append('<span class="item" id="Product'+item.id+'">'+buttonRemoveHTML+'<span onclick="loadDetailGame('+item.id+')" class="item-left"><img src="'+item.image+'" alt="'+item.name+'" width="85px" height="105px"/><span class="item-info"><span>'+item.name+'</span><span id="quantity">x'+item.quantity+'</span><span>'+item.price+'</span></span></span></span>');
            nitems++;
        }
    });
    $("#countShoppingCart").text(nitems);
}
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
    function Game(id, name, price, image, quantity) {
        this.id = id;
        this.name = name;
        this.price = price;
        this.image = image;
        this.quantity = quantity;
    }
    var title = $item.find("h5:eq(0)").text();
    var price = $item.find("h6:eq(0)").text();
    var newGame = true;
    if (typeof Cookies.getJSON('shoppingCart') == "undefined") {
        var items = Array();
        var game = new Game(id, title, price, itemImageURL, 1);
        items.push(game);
        var shoppingCart = JSON.stringify(items);
        Cookies.set('shoppingCart', shoppingCart, { expires: 1 });
        $("#countShoppingCart").text(nitems);
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
            $("#Product"+id).find("#quantity").text("x"+game.quantity);
        }
        Cookies.set('shoppingCart', items, { expires: 1 });
    }
    if (newGame) {
        var buttonRemoveHTML = '<button type="button" class="removeItem btn btn-danger" style="position: absolute;padding: 0px;margin: 0px;margin-left: 145px;width: 19px;">X</button>';
        var linesHTML = '<span class="item" id="Product'+id+'">'+buttonRemoveHTML+'<span onclick="loadDetailGame('+id+')" class="item-left">';
        linesHTML += '<img src="'+itemImageURL+'" alt="'+title+'" width="85px" height="105px"/><span class="item-info">';
        linesHTML += '<span>'+title+'</span>';
        linesHTML += '<span id="quantity">x'+game.quantity+'</span>';
        linesHTML += '<span>'+price+'</span>';
        linesHTML += '</span></span></span>';
        $("#basket").append(linesHTML);
    }
});
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
    window.location.href="detailsProduct.php?gameid="+idgame;
    return false;
}
$(document).ready(function() {
    $(document).on("click", ".removeItem", function (e) {
        e.preventDefault();
        $obj = $(this).parent();
        var quantitygame = parseInt($obj.find(".item-info #quantity").text().replace("x", ""));
        var idgame = $obj.attr("id").replace("Product", "");
        var games = Cookies.getJSON('shoppingCart');
        if (quantitygame<=1) {
            $obj.remove();
            games.splice(getPositionGame(games, idgame), 1);
            var shoppingCart = JSON.stringify(games);
            Cookies.set('shoppingCart', shoppingCart, { expires: 1 });
        } else {
            var game = getGameDecr(games, idgame);
            var shoppingCart = JSON.stringify(games);
            Cookies.set('shoppingCart', shoppingCart, { expires: 1 });
            $obj.find(".item-info #quantity").text("x"+(quantitygame-1));
        }
        $("#countShoppingCart").text(getNumItems(games));
    });

});
</script>