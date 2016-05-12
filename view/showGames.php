<?php
include_once("../controller/controllerCalculateDiscount.php");

function showGames($list, $onlyOffers) {
    for ($i = 0; $i < count($list); $i++) {
        $offer = $list[$i]->getOffer()->getDiscount();
        if ($onlyOffers) {
            if (!empty($offer)) {
                printGame($list[$i]);
            }
        } else {
            printGame($list[$i]);
        }
    }
}

function printGame($game) {
    ?>
    <style>
        .offerOldPrice {
            text-decoration:line-through;
        }
    </style>
    <div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper">
        <div class="gallery-item">
            <div class="gallery-thumb" title="<?php echo $game->getTitle() ?>">
                <img src="images/games/<?php echo $game->getTitle() ?>.png" width="800px" height="600px" class="img-responsive" alt="<?php echo $game->getTitle() ?>">
                <div class="image-overlay"></div>
                <a href="detailsProduct.php" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                <a href="addShopingCart.php" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
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
?>