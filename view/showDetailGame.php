<?php
$gameid = $_GET['gameid'];
if (isset($_SESSION['user_id'])) {
  $userid = $_SESSION['user_id'];
}
include_once("../controller/controllerCalculateDiscount.php");
include_once("../controller/controllerShowGameDetails.php");
function printGame($game) {
    ?>
    <?php
    //echo $_GET['gameid'];
    ?>

    <div class="col-lg-8 col-md-offset-2 col-md-offset-2 col-md-8 col-sm-12 col-xs-12 " >
        <div class="  divspan">
        <?php
        $price = $game->getPrice();
        $offer = $game->getOffer()->getDiscount();
        ?>
         <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 " >
        <div class="pull-left">
               <img class ="img-responsive imggrandaria" src="images/games/<?php echo $game->getTitle();?>.png">
           </div>
</div>
<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 " >
           <div class="pull-right widthparragraf">
            <span class="span1 spantitul"><?php echo $game->getTitle();?></span>

         

           <span class="span1 spanprecio2">Genero producto:</span>
        <span class="span1 spangenero">
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
        <span class="span1 spanprecio2">Plataforma producto:</span>
        <span class="span1 spanplataforma">
            <?php
            if (!empty($game->getPlatform())) {
                echo $game->getPlatform()->getName();
            }
            ?>
        </span>


            <?php
        $priceWithDiscount = calculateDiscount($price, $offer);
        if (!empty($game->getOffer()->getDiscount())) {
            echo '  <span class="span1 spandescuento">'.$game->getOffer()->getDiscount().'% de descuento</span>';
            echo '<span class="span1 spanprecio">'.$priceWithDiscount.' €</span>';
        } else {
            echo '<span class="span1 spanprecio">'.$price.' €</span>';
        }
        ?>


        <div class="enviarcarrito"><span class="spanenviar">Añadir al carrito</span></div>
        <div class="espai"></div>

        </div>

    </div>

    <div class="divform">
<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
  <p id="totalScore">Score: 0</p>
  <center class="bottom">
  <select id="rating">
    <option value="5">Excelent</option>
    <option value="4">Very Good</option>
    <option value="3">Good</option>
    <option value="2">Bad</option>
    <option value="1">Very Bad</option>
</select>
<center>
<button type="button" class="boto" id="rateBtn">Rate</button>
</div>


<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 " >
<div class="width100">
    <form action="" method="post" class="login">
            <textarea id="comentari" class="form-control" type="text" rows="6" name="comentari" value="" placeholder="Escriu al teu comentari aqui:"></textarea>
       
       <div class="alert alert-success ocultar">
  <div id="message"></div>
</div>
           
       
        <input id="enviar" class="boto" type="button" name="enviar" value="ENVIAR"/>
    </form>
</div>
</div>


<div class="clear"></div>
</div>


     </div>
      </div>

<div class="col-lg-8 col-md-offset-2 col-md-offset-2 col-md-8 col-sm-12 col-xs-12 " >
    <div id="comentariosusers">
    
</div>
</div>
<?php
}
printGame($game);
?>