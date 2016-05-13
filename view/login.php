<!--DOCTYPE html -->
<html>
<head>
	<meta charset="utf-8">
	<title>WorldGames - Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="bskit, bootstrap starter kit, bootstrap builder">
	<meta name="description" content="Your Favorite Shop of Games">
	<link rel="shortcut icon" href="ico/favicon.png">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style-library.css" rel="stylesheet">
	<link href="css/gallery.css" rel="stylesheet">
 <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src='js/login.js'></script>
   <script type="text/javascript" src="js/jquery.js"></script>
    <link href="css/header.css" rel="stylesheet">
	<link href="css/blog.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
	<link href="css/footer.css" rel="stylesheet">


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







</head>
<body>

<?php  require_once("lib/recaptchalib.php"); ?>


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
                                <form id="login-form" action="" method="post"  style="display: block;">
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
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
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