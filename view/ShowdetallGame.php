<?php
//include_once("../controller/controllerCalculateDiscount.php");
$gameid = $_GET['gameid'];
include_once("../controller/controllershowgamedetails.php");

var_dump($game);

function printGame1() {
  
  ?>

  <style>
    .offerOldPrice {
      text-decoration:line-through;
    }
  </style>



  <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
    <div class="divimg">
      <img src="images/games/<?php echo $game->getTitle() ?>.png"  class="img-responsive" alt="<?php echo $game->getTitle() ?>">
    </div>



  </div>


  <div class="col-md-6 col-sm-6 col-xs-12 gallery-item-wrapper">
    <div class="gallery-item">
      <div class="gallery-thumb" title="<?php echo $game->getTitle() ?>">
        <img src="images/games/<?php echo $game->getTitle() ?>.png" width="800px" height="600px" class="img-responsive" alt="<?php echo $game->getTitle() ?>">
        <div class="image-overlay"></div>
        <a href="detailsProduct.php?gameid=<?php echo $game->getID();?>" class="gallery-zoom"><i class="fa fa-eye"></i></a>
        <a href="#" class="gallery-link buyItem"><i class="fa fa-shopping-cart"></i></a>
      </div>
      <div class="gallery-details">
        <div class="editContent">
          <?php
          $price = $game->getPrice();
          $offer = $game->getOffer()->getDiscount();
          $priceWithDiscount = calculateDiscount($price, $offer);
          echo '<h5>' . $game->getTitle() . '</h5>';
          echo '<h6>';
          if ($priceWithDiscount == $price) {
            echo '<span>' . $game->getPrice() . ' €</span>';
          } else {
            echo '<span class="offerOldPrice">' . $game->getPrice() . ' €</span> Ahora: ' . $priceWithDiscount . ' €';
          }
          echo '<h6>';
          if (!empty($game->getOffer()->getDiscount())) {
            echo $game->getOffer()->getDiscount() . " % de descuento";
          }
          echo '</h6>';
          echo '<h5>';
          if (!empty($game->getGenres())) {
            $genres = $game->getGenres();
            foreach ($genres as $genre) {
              echo $genre->getName() . "<br>";
            }
          }
          echo '</h5>';
          echo '<h6>';
          if (!empty($game->getPlataform())) {
            echo $game->getPlataform()->getName();
          }
          echo '</h6>';
          ?>

        </div>
      </div>
    </div>
  </div>
  <?php
}
printGame1();
?>