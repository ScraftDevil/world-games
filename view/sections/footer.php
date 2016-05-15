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
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/headroom.js"></script>
<script type="text/javascript" src="js/jquery.headroom.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/jquery.counterup.min.js"></script>
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/bskit-scripts.js"></script>
<script type="text/javascript" src="js/userProfile.js"></script>
<!--[if lt IE 9]><script src="js/html5shiv.js"></script><script src="js/respond.min.js"></script><![endif]-->

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
        $(".plataformFilter").each(function() {
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
                        linesHTML += '<div id="isotope-gallery-container" style="position: relative; overflow: hidden; height: 570px;" class="isotope">';
                        linesHTML += '<style>.offerOldPrice {text-decoration:line-through;}</style>';
                        linesHTML += '<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper isotope-item" style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px);">';
                        linesHTML += '<div class="gallery-item">';
                        linesHTML += '<div class="gallery-thumb" title="'+this.title+'"><img src="images/games/'+this.title+'.png" width="800px" height="600px" class="img-responsive" alt="'+this.title+'">';
                        linesHTML += '<div class="image-overlay"></div>';
                        linesHTML += '<a href="detailsProduct.php" class="gallery-zoom"><i class="fa fa-eye"></i></a>';
                        linesHTML += '<a href="addShopingCart.php" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>';
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
                        linesHTML += '</div>';
                        $("#isotope-gallery-container").html(linesHTML);
                    });
                    //
                }
            }
        });

        $(this).append('&nbsp;<i id="selected" class="fa fa-check" aria-hidden="true"></i>');
    });
     $(".plataformFilter").on("click", function(e){
        e.preventDefault();
        $(".genreFilter").each(function() {
            $(this).find("#selected").remove();
        });
        $(".plataformFilter").each(function() {
            $(this).find("#selected").remove();
        });
        var params = {"plataform" : $(this).attr("id")};
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
                    var linesHTML = '<div id="isotope-gallery-container" style="position: relative; overflow: hidden; height: 570px;" class="isotope">';
                    linesHTML += '<style>.offerOldPrice {text-decoration:line-through;}</style>';
                    $.each($.parseJSON(json), function() {
                        linesHTML += '<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper isotope-item">';
                        linesHTML += '<div class="gallery-item">';
                        linesHTML += '<div class="gallery-thumb" title="'+this.title+'"><img src="images/games/'+this.title+'.png" width="800px" height="600px" class="img-responsive" alt="'+this.title+'">';
                        linesHTML += '<div class="image-overlay"></div>';
                        linesHTML += '<a href="detailsProduct.php" class="gallery-zoom"><i class="fa fa-eye"></i></a>';
                        linesHTML += '<a href="addShopingCart.php" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>';
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
                        linesHTML += '</div>';
                        $("#isotope-gallery-container").html(linesHTML);
                    //
                }
            }
        });

        $(this).append('&nbsp;<i id="selected" class="fa fa-check" aria-hidden="true"></i>');
    });
});
</script>