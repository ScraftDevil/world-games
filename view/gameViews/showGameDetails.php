<?php
$gameid = $_GET['gameid'];
if (isset($_SESSION['user_id'])) {
  $userid = $_SESSION['user_id'];
}
include_once("../../controller/gameControllers/calculateDiscountController.php");
include_once("../../controller/gameControllers/showGameDetailsController.php");
function printGame($game) {
    //Validate if image exist
  $imgURL = "../resources/images/games/".$game->getId().".png";
  if (!file_exists($imgURL)) {
    $imgURL = "../resources/images/games/noimage.png";
  }
  ?>
  <div class="col-lg-8 col-md-offset-2 col-md-offset-2 col-md-8 col-sm-12 col-xs-12 " >
    <div class="divspan" id="Product_<?php echo $game->getId();?>">
      <?php
      $price = $game->getPrice();
      $offer = $game->getOffer()->getDiscount();
      ?>
      <div class="imgDetail col-lg-5 col-md-5 col-sm-5 col-xs-12">
      <img class="img-responsive imageDetail" src="<?php echo $imgURL;?>">
       <span id="rating" ></span><p id="msgRate"></p>
        
     </div>
     <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 " >
       <div class="col-md-12 pull-right nopadding">
        <span class="span1 spanTitle"><?php echo $game->getTitle();?></span>
        <div class="divcontenidor">
          <span class="span3 spanprecio2">Genero:</span>
          <span class="span3 spangenero">
            <?php
            if (!empty($game->getGenres())) {
              $genres = $game->getGenres();
              $n = 0;
              foreach ($genres as $genre) {
                echo $genre->getName();
                if ($n<count($genres)-1) {
                  echo ", ";
                }
                $n++;
              }
            }
            ?>
          </span>
        </div>
        <div class="divcontenidor">
          <span class="span3 spanprecio2">Plataforma:</span>
          <span class="span3 spanplataforma">
            <?php
            if (!empty($game->getPlatform())) {
              echo $game->getPlatform()->getName();
            }
            ?>
          </span>
        </div>
        <?php
        $priceWithDiscount = calculateDiscount($price, $offer);
        if (!empty($game->getOffer()->getDiscount())) {
            echo '   <div class="divcontenidor">';
            echo '  <span class="span3   spandescuento ">Descuento:</span>';

            echo '  <span class="span3  margenes spandescuento ">'.$game->getOffer()->getDiscount().'% </span>';
            echo '</div>';
            echo '<div class="divcontenidor"><span class="span3 spanprecio2">Stock:'.$game->getStock().'</span></div>';
            echo '<div class="sendToCart buyGame">';
            if ($game->getStock()<=0) {
              echo '<span class="glyphicon glyphicon-shopping-cart"></span>No Disponible';
            } else {
              echo '<span class="glyphicon glyphicon-shopping-cart spanenviar"></span>Enviar al carrito';
            }
            echo '</div><span class="span1 spanprecio">'.$priceWithDiscount.' €</span>';
        } else {
           echo '<div class="divcontenidor"><span class="span3 spanprecio2">Stock:'.$game->getStock().'</span></div>';
          echo '<div class="sendToCart buyGame">';
          if ($game->getStock()<=0) {
            echo '<span class="glyphicon glyphicon-shopping-cart"></span>No Disponible';
          } else {
            echo '<span class="glyphicon glyphicon-shopping-cart spanenviar"></span>Enviar al carrito';
          }
          echo '</div><span class="span1 spanprecio">'.$price.' €</span>';
        }
        ?>
       <div class="width100">
        <form action="" method="post" class="login">
          <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 " >
           <div id="message" class="ocultar"></div>
           <textarea id="comment" class="form-control" type="text" rows="2" name="comment" value="" placeholder="Escriu al teu comentari aqui:"></textarea>
         </div>
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 " >
          <div class="boto" id="sendOpinion">
           <span class="glyphicon glyphicon-send spanenviar2"></span>ENVIAR
         </div>
       </div>
     </form>
 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
 </div>


   </div>

 </div>
</div>
<div class="clear"></div>
</div>
</div>
<div class="col-lg-8 col-md-offset-2 col-md-offset-2 col-md-8 col-sm-12 col-xs-12  " >
  <div id="commentsList">
  </div>
</div>
<?php
}
printGame($game);
?>