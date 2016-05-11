<?php
include_once("../controller/controllerCalculateDiscount.php");
function showGames($list) {
      for ($i = 0; $i < count($list); $i++) {
      ?>
            <style>
            .offerOldPrice {
                  text-decoration:line-through;
            }
            </style>
            <div class="col-md-3 col-sm-6 col-xs-12 gallery-item-wrapper">
                  <div class="gallery-item">
                        <div class="gallery-thumb" title="<?php echo $list[$i]->getTitle()?>">
                              <!-- 800x600 -->
                              <img src="images/games/<?php echo $list[$i]->getTitle()?>.png" width="800px" height="600px" class="img-responsive" alt="<?php echo $list[$i]->getTitle()?>">
                              <div class="image-overlay"></div>
                              <a href="detailsProduct.php" class="gallery-zoom"><i class="fa fa-eye"></i></a>
                              <a href="addShopingCart.php" class="gallery-link"><i class="fa fa-shopping-cart"></i></a>
                        </div>
                        <div class="gallery-details">
                              <div class="editContent">
                                    <?php
                                    $price = $list[$i]->getPrice();
                                    $offer = $list[$i]->getOffer()->getDiscount();
                                    $priceWithDiscount = calculateDiscount($price, $offer);
                                    ?>
                                    <h5><?php echo $list[$i]->getTitle()?></h5>
                                    <h6><span class="offerOldPrice"><?php echo $list[$i]->getPrice()?>€</span> <?php echo $priceWithDiscount." €"?>
                                    <h6><?php echo $list[$i]->getOffer()->getDiscount()?>% de descuento</h6>
                                    <h5><?php echo $list[$i]->getGenre()->getName()?></h5>
                                    <h6><?php echo $list[$i]->getPlataform()->getName()?></h6>
                              </div>
                        </div>
                  </div>
            </div>
      <?php
      }
}
?>