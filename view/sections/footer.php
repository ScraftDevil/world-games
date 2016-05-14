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
   });
</script>