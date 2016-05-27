<!DOCTYPE html>
<html>
    <?php
    include("../sections/head.php");
    ?>
    <body>
        <?php require_once("../../lib/recaptchalib.php"); ?>
        <div id="page" class="page">
            <?php
            include("../sections/nav.php");
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
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                    <form id="login-form" style="display: block;">
                                                        <div class="form-group">
                                                            <input type="username" name="username" id="username" tabindex="1" class="form-control" placeholder="Usuario" value="">

                                                        </div>

                                                        <div class="form-group">
                                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña">
                                                        </div>

                                                        <div class="form-group text-center">
                                                            <div class="row">
                                                                <div class="col-sm-10 col-sm-offset-2">
                                                                    <div class="g-recaptcha" data-sitekey="6Lf_HSETAAAAALCXn_X1ByQi0LtKcNfkdajsasSp"></div>
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
                                                            <input type="text" name="username_register" id="username_register" tabindex="1" class="form-control" placeholder="Usuario" value="">

                                                        </div>
                                                        <div class="form-group">

                                                            <input type="text" name="email" id="email" tabindex="2" class="form-control" placeholder="Correo electronico" value="">

                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="passwordregister" id="passwordregister" tabindex="3" class="form-control" placeholder="Contraseña">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" name="confirmpassword" id="confirmpassword" tabindex="4" class="form-control" placeholder="Confirmar Contraseña">
                                                        </div>
                                                        <div class="form-group">

                                                            <div class="">
                                                                <input type="text" class="form-control" id="calendar" name="birthdate" placeholder="Birthdate"/>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">

                                                            <?php include("../userViews/countryList.php"); ?>
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
                    </div>
                </div>
            </section>
        </div>
        <footer>
            <?php
            include("../sections/footer.php");
            ?>
            <script type="text/javascript" src="../resources/js/api.js"></script>
            <script type="text/javascript" src="../resources/js/loginUserFunctions.js"></script>
        </footer>
    </body>
</html>