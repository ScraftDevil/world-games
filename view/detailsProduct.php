<!--DOCTYPE html -->
<html>
<?php
include("sections/head.php");
?>
<body>

   <div id="page" class="page">
        <?php
        include("sections/nav.php");
        ?>
     
    <section class="content-block gallery-1">
       <div class="container">
          <div class="underlined-title">
             <div class="editContent">
                <p>
                   <h1 class="titul">DETALL PRODUCTE</h1>
               </p>
           </div>
           <hr>

           <div class="container">
               <div class="row">
                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">


                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="divimg">
                        <img class="img-responsive imgportada" src="images/portada.jpg">
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <div class="divdades">
                    <?php
                      include("../view/ShowdetallGame.php");

                      ?>
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