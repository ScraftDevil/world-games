<!--DOCTYPE html -->
<html>
    <head>
        <meta charset="utf-8">
        <title>WorldGames - Your Shop Online</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="bskit, bootstrap starter kit, bootstrap builder">
        <meta name="description" content="Your Favorite Shop of Games">
        <link rel="shortcut icon" href="ico/favicon.png">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/style-library.css" rel="stylesheet">
        <link href="css/gallery.css" rel="stylesheet">
        <link href="css/blog.css" rel="stylesheet">
        <link href="css/header.css" rel="stylesheet">
        <link href="css/search.css" rel="stylesheet">
        <link href="css/footer.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="page" class="page">
            <header id="header">
                <nav class="main-nav navbar-fixed-top headroom headroom--pinned">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <img src="images/logo.png" class="brand-img img-responsive">
                        </div>
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="active nav-item"><a href="#">Home</a></li>
                                <li class="nav-item"><a href="#">Games</a></li>
                                <li class="nav-item"><a href="#">Login</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <section class="content-block-nopad bg-deepocean">
                <div class="container search">
                    <div class="editContent" style="">
                        <h2>Search Your Game</h2>
                    </div>
                    <form class="footer-form" action="#">
                        <input type="text" name="" value="" placeholder="" required="">
                        <input type="submit" name="" value="Search">
                    </form>
                </div>
            </section>
            <section class="content-block gallery-1">
                <div class="container">
                    <div class="underlined-title">
                        <div class="editContent">
                            <p>
                            <h1>Perfil de Usuario</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Aqui encontraras todo lo relativo a tu cuenta</h2></div>
                    </div>

                    <!-- Lista de opciones del perfil del usuario -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">
                            <div class="profile">
                                <!-- Datos del usuario -->
                                <div class="desplegableProfile" id="datosPersonales">
                                    <span class="glyphicon glyphicon-edit"></span>
                                    Datos Personales
                                </div>

                                <!-- Formulario para poder editar los datos del usuario (obtiene los datos de la BBDD) -->
                                <form id="profileForm">
                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Nombre:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="text" name="name" placeholder="Name">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Contrasena</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="password" name="password" placeholder="Password">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">E-mail</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="text" name="email" placeholder="E-mail">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Fecha de Nacimiento:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="text" name="birthdate" placeholder="DD-MM-YYYY">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Cuenta PayPal:</label>
                                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 inputAttribute">
                                            <input class="form-control" type="text" name="paypal" placeholder="PayPal Account">
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-12">
                                        <label class="col-xs-12 col-sm-4 col-md-4 col-lg-4 control-label attributeText">Imagen de Perfil:</label>
                                        <div class="col-lg-8 inputAttribute">
                                            <input class="form-control" type="file" name="profileImage">
                                        </div>
                                    </div>

                                    <button type="primary" class="button-profile pull-right btn form-button" action="#" method="POST">
                                        <span class="glyphicon glyphicon-floppy-open"></span>
                                        Guardar Cambios
                                    </button>

                                </form>

                                <!-- Compras del usuario -->
                                <div id="compras">
                                    <div class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <span class="glyphicon glyphicon-shopping-cart"></span>
                                        Mis Compras
                                    </div>
                                    <div class="col-lg-12" id="comprasUsuario">
                                        Array de compras
                                    </div>
                                </div>

                                <!-- Mis Mensajes -->
                                <div id="mensajes">
                                    <div class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <span class="glyphicon glyphicon-envelope"></span>
                                        Mis Mensajes
                                    </div>
                                    <div class="col-lg-12" id="mensajesUsuario">
                                        Mensaje 1<br>
                                        Mensaje 2
                                    </div>
                                </div>

                                <!-- Configuración de la Cuenta del usuario -->
                                <div id="configuracion">
                                    <div class="desplegableProfile col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <span class="glyphicon glyphicon-cog"></span>
                                        Configuracion de la Cuenta
                                    </div>
                                    <div class="col-lg-12" id="configuracionUsuario">
                                        Desactivar/Eliminar cuenta
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content-block-nopad bg-deepocean">
                <div class="container footer">
                    <div class="col-md-4 pull-left">
                        <img src="images/logo.png" class="brand-img img-responsive">
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
                            <p class="address-bold-line">We <span class="fa fa-heart pomegranate"></span> our amazing customers</p>
                        </div>
                        <div class="editContent">
                            <p class="address small">
                                123 Anywhere Street,
                                <br> London,
                                <br> LO4 6ON
                            </p>
                        </div>
                    </div>
                    <div class="col-xs-12 footer-text">
                        <div class="editContent">
                            <p>Please take a few minutes to read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Privacy Policy</a></p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/userProfile.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/headroom.js"></script>
        <script type="text/javascript" src="js/jquery.headroom.js"></script>
        <script type="text/javascript" src="js/owl.carousel.min.js"></script>
        <script type="text/javascript" src="js/jquery.counterup.min.js"></script>
        <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
        <script type="text/javascript" src="js/bskit-scripts.js"></script>

<!--[if lt IE 9]><script src="js/html5shiv.js"></script><script src="js/respond.min.js"></script><![endif]-->
    </body>
</html>