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
             <h1 class="title">ENTRAR</h1>
         </p>
     </div>
     <hr>
     <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel ">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Entrar</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">No tienes cuenta?</a>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" style="display: block;">
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
                                    <label for="remember"> Recordarme</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control " value="Entrar">
                                        </div>
                                    </div>
                                </div>
                                <div id="msg" role="alert"></div>
                            </form>
                            <form id="register-form" action="" method="post"  style="display: none;">
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Usuario" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="2" class="form-control" placeholder="Correo electronico" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="3" class="form-control" placeholder="Contraseña">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="4" class="form-control" placeholder="Confirmar Contraseña">
                                </div>
                                <div class="form-group">
                                    <input type="telephone" name="telephone" id="telephone" tabindex="5" class="form-control" placeholder="Telefono">
                                </div>

                                <div class="form-group">
                                    <input type="date" name="birthday" id="birthday" tabindex="5" class="form-control" placeholder="Fecha Nacimiento">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="country" id="country" tabindex="6" class="form-control" placeholder="Pais">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="address" id="address" tabindex="7" class="form-control" placeholder="Direccion">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="paypal" id="paypal" tabindex="8" class="form-control" placeholder="Cuenta PayPal">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="9" class="form-control btn btn-register" value="Registrarse">
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
</body>
</html>