<?php
function showGames($list) {
      for ($i = 0; $i < count($list); $i++) {
      ?>
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
                                    <h5><?php echo $list[$i]->getTitle()?> [<?php echo $list[$i]->getPrice()?>€]</h5>
                              </div>
                        </div>
                  </div>
            </div>
      <?php
      }
}
?>