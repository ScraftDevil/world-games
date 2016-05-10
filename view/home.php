<!DOCTYPE html>
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
                            <!--<li class="nav-item dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Pages <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dropdown 1</a></li>
                                    <li><a href="#">Dropdown 2</a></li>
                                    <li><a href="#">Dropdown 3</a></li>
                                    <li><a href="#">Dropdown 4</a></li>
                                </ul>
                            </li>-->
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
        					<h1>Monthy Offers</h1>
        				</p>
        			</div>
        			<hr>
        			<div class="editContent">
        				<h2>Choose your offer</h2></div>
        			</div>
        			<!--<div class="editContent">
        				<ul class="filter">
        					<li class="active">All</li>
        					<li>Origin</li>
        					<li>Steam</li>
        					<li>Xbox</li>
        					<li>Playstation Network</li>
        					<li>Apple</li>
        				</ul>
        			</div>
        			<div class="editContent">
        				<ul class="filter">
        					<li class="active">RPG</li>
        					<li>Adventure</li>
        					<li>Action</li>
        					<li>Shooter</li>
        					<li>Racing</li>
        					<li>Graphic Adventure</li>
        				</ul>
        			</div>-->
        			<?php include("../controller/controllerShowGames.php"); ?>
        			<div class="row">
        				<div id="isotope-gallery-container">
        					<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper artwork creative">
        						<div class="gallery-item">
        							<div class="gallery-thumb">
        								<img src="http://placehold.it/800x600" class="img-responsive" alt="1st gallery Thumb">
        								<div class="image-overlay"></div>
        								<a href="http://placehold.it/800x600" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        								<a href="#" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
        							</div>
        							<div class="gallery-details">
        								<div class="editContent">
        									<h5>1st Gallery Item</h5>
        								</div>
        							</div>
        						</div>
        					</div>
        					<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper nature outside">
        						<div class="gallery-item">
        							<div class="gallery-thumb">
        								<img src="http://placehold.it/800x600" class="img-responsive" alt="2nd gallery Thumb">
        								<div class="image-overlay"></div>
        								<a href="http://placehold.it/800x600" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        								<a href="#" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
        							</div>
        							<div class="gallery-details">
        								<div class="editContent">
        									<h5>2nd Gallery Item</h5>
        								</div>
        							</div>
        						</div>
        					</div>
        					<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper photography artwork">
        						<div class="gallery-item">
        							<div class="gallery-thumb">
        								<img src="http://placehold.it/800x600" class="img-responsive" alt="3rd gallery Thumb">
        								<div class="image-overlay"></div>
        								<a href="http://placehold.it/800x600" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        								<a href="#" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
        							</div>
        							<div class="gallery-details">
        								<div class="editContent">
        									<h5>3rd Gallery Item</h5>
        								</div>
        							</div>
        						</div>
        					</div>
        					<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper creative nature">
        						<div class="gallery-item">
        							<div class="gallery-thumb">
        								<img src="http://placehold.it/800x600" class="img-responsive" alt="4th gallery Thumb">
        								<div class="image-overlay"></div>
        								<a href="http://placehold.it/800x600" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        								<a href="#" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
        							</div>
        							<div class="gallery-details">
        								<div class="editContent">
        									<h5>4th Gallery Item</h5>
        								</div>
        							</div>
        						</div>
        					</div>
        					<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper nature">
        						<div class="gallery-item">
        							<div class="gallery-thumb">
        								<img src="http://placehold.it/800x600" class="img-responsive" alt="5th gallery Thumb">
        								<div class="image-overlay"></div>
        								<a href="http://placehold.it/800x600" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        								<a href="#" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
        							</div>
        							<div class="gallery-details">
        								<div class="editContent">
        									<h5>5th Gallery Item</h5>
        								</div>
        							</div>
        						</div>
        					</div>
        					<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper artwork creative">
        						<div class="gallery-item">
        							<div class="gallery-thumb">
        								<img src="http://placehold.it/800x600" class="img-responsive" alt="6th gallery Thumb">
        								<div class="image-overlay"></div>
        								<a href="http://placehold.it/800x600" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        								<a href="#" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
        							</div>
        							<div class="gallery-details">
        								<div class="editContent">
        									<h5>6th Gallery Item</h5>
        								</div>
        							</div>
        						</div>
        					</div>
        					<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper nature outside">
        						<div class="gallery-item">
        							<div class="gallery-thumb">
        								<img src="http://placehold.it/800x600" class="img-responsive" alt="7th gallery Thumb">
        								<div class="image-overlay"></div>
        								<a href="http://placehold.it/800x600" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        								<a href="#" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
        							</div>
        							<div class="gallery-details">
        								<div class="editContent">
        									<h5>7th Gallery Item</h5>
        								</div>
        							</div>
        						</div>
        					</div>
        					<div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper photography artwork">
        						<div class="gallery-item">
        							<div class="gallery-thumb">
        								<img src="http://placehold.it/800x600" class="img-responsive" alt="8th gallery Thumb">
        								<div class="image-overlay"></div>
        								<a href="http://placehold.it/800x600" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        								<a href="#" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
        							</div>
        							<div class="gallery-details">
        								<div class="editContent">
        									<h5>8th Gallery Item</h5>
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