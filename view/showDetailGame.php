<?php
$gameid = $_GET['gameid'];
if (isset($_SESSION['user_id'])) {
  $userid = $_SESSION['user_id'];
}
include_once("../controller/controllerCalculateDiscount.php");
include_once("../controller/controllerShowGameDetails.php");
function printGame($game) {
  ?>
  <div class="col-lg-8 col-md-offset-2 col-md-offset-2 col-md-8 col-sm-12 col-xs-12 " >
    <div class="divspan" id="Product_<?php echo $game->getId();?>">
      <?php
      $price = $game->getPrice();
      $offer = $game->getOffer()->getDiscount();
      ?>
      <div class="imgDetail col-md-5">
       <img class="img-responsive imageGame" src="images/games/<?php echo $game->getTitle();?>.png">
       <div class="col-md-8" style="padding-left:0px">
       <span id="rating" class="pull-left"></span>
       </div>
       <!--<div class="col-md-4">
         <span><button type="button" class="buttonCustom" id="rateBtn" data-toggle="tooltip" title="Puntuar el juego!">Rate</button></span>
       </div>-->
     </div>
     <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 " >
       <div class="pull-right">
        <span class="bigSpan spantitul"><?php echo $game->getTitle();?></span>
        <span class="bigSpan spanprecio2">Genero producto:</span>
        <span class="bigSpan spangenero">
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
        <span class="bigSpan spanprecio2">Plataforma producto:</span>
        <span class="bigSpan spanplataforma">
          <?php
          if (!empty($game->getPlatform())) {
            echo $game->getPlatform()->getName();
          }
          ?>
        </span>
        <?php
        $priceWithDiscount = calculateDiscount($price, $offer);
        if (!empty($game->getOffer()->getDiscount())) {
          echo '  <span class="bigSpan spandescuento">'.$game->getOffer()->getDiscount().'% de descuento</span>';
          echo '<span class="bigSpan spanprecio">'.$priceWithDiscount.' €</span>';
        } else {
          echo '<span class="bigSpan spanprecio">'.$price.' €</span>';
        }
        ?>
        <div class="enviarcarrito buyGame"><span class="spanenviar">Añadir al carrito</span></div>
        <div class="espai"></div>
      </div>
    </div>
    <div class="gameForm">
      <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
        <center class="bottom">
          <div id="msgRate"></div>
        </center>
      </div>
      <div class="col-md-7" >
        <div class="width100">
          <form action="" method="post" class="login">
            <textarea id="comentari" class="form-control" type="text" rows="6" name="comentari" value="" placeholder="Escribe tu comentario aquí:"></textarea>
              <div id="message" class="alert alert-success ocultar"></div>
            <input id="enviar" class="buttonCustom" type="button" name="enviar" value="ENVIAR"/>
          </form>
        </div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
</div>

<div class="col-lg-8 col-md-offset-2 col-md-offset-2 col-md-8 col-sm-12 col-xs-12  " >
  <div id="comentariosusers">
  </div>
</div>
<?php
}
printGame($game);
?>