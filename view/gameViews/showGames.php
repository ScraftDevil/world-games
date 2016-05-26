<?php
include_once("../../controller/gameControllers/calculateDiscountController.php");
include_once("../../controller/gameControllers/showGamesController.php");
function showGames($list, $onlyOffers) {
    $n = 0;
    for ($i = 0; $i < count($list); $i++) {
        $offer = $list[$i]->getOffer()->getDiscount();
        if ($onlyOffers) {
            if (!empty($offer)) {
                printGame($list[$i]);
                $n++;
            }
        } else {
            printGame($list[$i]);
        }
    }
    if($onlyOffers && $n==0) {
        echo '<div class="col-md-12"><div class="alert alert-info">
  <strong>No hay ofertas disponibles.<strong>
</div></div>';
    }
}

function printGame($game) {
    ?>
    <style>
        .offerOldPrice {
            text-decoration:line-through;
        }
    </style>
    <?php
    //Validate if image exist
    $imgURL = "../resources/images/games/".$game->getId().".png";
    if (!file_exists($imgURL)) {
        $imgURL = "../resources/images/games/noimage.png";
    }
    ?>
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="gallery-item" id="Game_<?php echo $game->getID() ?>">
            <div class="gallery-thumb" title="<?php echo $game->getTitle() ?>">
                <img src="<?php echo $imgURL; ?>" width="800px" height="600px" class="img-responsive" alt="<?php echo $game->getTitle() ?>">
                <div class="image-overlay"></div>
                <a href="../gameViews/gameDetailsView.php?gameid=<?php echo $game->getID();?>" class="gallery-zoom"><i class="fa fa-eye"></i></a>
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
                        echo '<span class="price"><font color=\'red\'><strong>' . $game->getPrice() . ' €</strong></font>';
                    } else {
                        echo '<span class="price"><font color=\'red\'><strong>'.$priceWithDiscount.' €</strong></font>
                        ';
                         if (!empty($game->getOffer()->getDiscount())) {
                        echo "(<span class='discount'><font color='green'><strong>".$game->getOffer()->getDiscount() . " % dto.</strong></font></span>)";
                    }
                        echo '</span>';
                    }
                    echo '<h6>';
                    /*echo '</h6>';
                    echo '<h5>';
                    if (!empty($game->getGenres())) {
                        $genres = $game->getGenres();
                        foreach ($genres as $genre) {
                            echo $genre->getName() . "<br>";
                        }
                    }
                    echo '</h5>';
                    echo '<h6>';
                    if (!empty($game->getPlatform())) {
                        echo $game->getPlatform()->getName();
                    }
                    echo '</h6>';*/
                    ?>

                </div>
            </div>
        </div>
    </div>
    <?php
}
showGames($games, $onlyOffers);
?>