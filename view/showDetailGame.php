<?php
$gameid = $_GET['gameid'];
include_once("../controller/controllerCalculateDiscount.php");
include_once("../controller/controllershowgamedetails.php");
function printGame($game) {
    ?>
    <style>
        .offerOldPrice {
            text-decoration:line-through;
        }

        .titulgame{

            font-size: 30px;
    color: red;
        }
    </style>
    <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 ">
        
            <div class="width100" title="<?php echo $game->getTitle() ?>">
                <img src="images/games/<?php echo $game->getTitle() ?>.png"  class="img-responsive imggrandaria" alt="<?php echo $game->getTitle() ?>">
                
                
            </div>

           
              </div>
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 ">
                <div class="caixadetall">
                    <?php
                    $price = $game->getPrice();
                    $offer = $game->getOffer()->getDiscount();
                    $priceWithDiscount = calculateDiscount($price, $offer);?>

                    <span class "titulgame">d<?= $game->getTitle() ?></span>

                    <?php
                    echo '<h6>';
                    if ($priceWithDiscount == $price) {
                        echo '<span class="pull-left">' . $game->getPrice() . ' €</span>';
                    } else {
                        echo '<span id="price">'.$priceWithDiscount.' €</span>';
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
       
   
    <?php
}
printGame($game);
?>