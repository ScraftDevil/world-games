<!DOCTYPE html>
<html>
<?php
include("sections/head.php");
?>
<body>
<?php //require_once("lib/recaptchalib.php"); ?>
    <div id="page" class="page">
        <?php
        include("sections/nav.php");
        ?>
        <section class="content-block gallery-1">
         <div class="container">
          <div class="underlined-title">
           <div class="editContent">
            <p>
             <h1 class="titul">LOGIN</h1>
         </p>
     </div>
     <hr>
     <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel ">

                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="../controller/authUserController.php" method="post" style="display: block;">
                                    <div class="form-group">
                                        <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group text-center ">
                                        <div class="row">
                                            <div class="col-sm-10 col-sm-offset-1">
                                             <div class="g-recaptcha" data-sitekey="6LeR-BsTAAAAABNiRObixyxGvKeTOiNFZZo7CIjF"></div>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember"> Remember Me</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control " value="Log In">
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <form id="register-form" action="" method="post"  style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <input type="telefon" name="telefon" id="telefon" tabindex="2" class="form-control" placeholder="Telefon">
                                </div>

                                <div class="form-group">
                                    <input type="birthday" name="birthday" id="birthday" tabindex="2" class="form-control" placeholder="Birthday">
                                </div>

                                <div class="form-group">
                                    <input type="pais" name="pais" id="pais" tabindex="2" class="form-control" placeholder="Pais">
                                </div>

                                <div class="form-group">
                                    <input type="direccio" name="direccio" id="direccio" tabindex="2" class="form-control" placeholder="Direccio">
                                </div>

                                <div class="form-group">
                                    <input type="PayPal" name="PayPal" id="PayPal" tabindex="2" class="form-control" placeholder="Compte PayPal">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<?php
include("sections/footer.php");
?>
</div>
<script type="text/javascript">
    $(window).load(function() {
       $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
        $("#register-form").fadeOut(100);
        $('.titul').html("LOGIN");
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
       $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
        $("#login-form").fadeOut(100);
        $('.titul').html("REGISTER");
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
   });

</script>
</body>
</html>