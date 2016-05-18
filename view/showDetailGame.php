<?php
$gameid = $_GET['gameid'];
include_once("../controller/controllerCalculateDiscount.php");
include_once("../controller/controllershowgamedetails.php");
function printGame($game) {
    ?>
    <?php
    //echo $_GET['gameid'];
    ?>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >
        <div class="imgcaixa">

         <img class ="img-responsive imggrandaria" src="images/games/<?php echo $game->getTitle();?>.png">

     </div>
 </div>
 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >
    <div class="divspan">
        <?php
        $price = $game->getPrice();
        $offer = $game->getOffer()->getDiscount();
        ?>
        <span class="span1 spantitul"><?php echo $game->getTitle();?></span>
        <?php
        $priceWithDiscount = calculateDiscount($price, $offer);
        if (!empty($game->getOffer()->getDiscount())) {
            echo '<span class="spanprecio2">Descuento producto:</span>
            <span class="span1 spandescuento">'.$game->getOffer()->getDiscount().'% de descuento</span>';
            echo '<span class="span1 spanprecio">'.$priceWithDiscount.' €</span>';
        } else {
            echo '<span class="span1 spanprecio">'.$price.' €</span>';
        }
        ?>
        <span class="spanprecio2">Genero producto:</span>
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
        <span class="spanprecio2">Plataforma producto:</span>
        <span class="span1 spanplataforma">
            <?php
            if (!empty($game->getPlatform())) {
                echo $game->getPlatform()->getName();
            }
            ?>
        </span>
        <div class="enviarcarrito"><span class="spanenviar">Añadir al carrito</span></div>
        <div class="espai"></div>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
<div id="star" class="rating">&nbsp;</div>
<input name="star1" type="radio" id="star" class="star"/>
<input name="star1" type="radio" id="star" class="star"/>
<input name="star1" type="radio" id="star" class="star"/>
<input name="star1" type="radio" id="star" class="star"/>
<input name="star1" type="radio" id="star" class="star"/>

</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >

    <div class="divform">
       <form action="" method="post" class="login">

        <p>Escriu al teu comentari aqui: </p>

        <textarea id="comentari" class="form-control" type="text" rows="6" name="comentari" value="" ></textarea>


        <div id="message"></div>

        <input id="enviar" class="boto" type="button" name="enviar" value="ENVIAR">
    </form>
</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " >
    <div id="comentariosusers">
    <!--<div class="divcomentari">
       <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
          <img class ="img-responsive " src="imagenes/user.jpg">
      </div>

      <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 " >
       <span class="span2 span2grandaria">Escrito por Carles</span>
       <p>
           <span class=" glyphicon glyphicon-calendar ">17/05/2016</span>
           
       </p>
       <span id="mensajejuego"></span>
   </div>
</div>-->
</div>


<!--<div class="divcomentari">
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
      <img class ="img-responsive " src="imagenes/user.jpg">
  </div>

  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 " >
   <span class="span2 span2grandaria">Escrito por David</span>
   <p>
       <span class=" glyphicon glyphicon-calendar ">17/05/2016</span>
       
   </p>
   <span>Nunca habia jugado i segun e visto me a molado bastante lo mas seguro es que me lo pille gracias</span>
</div>
</div>

<div class="divcomentari">
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
      <img class ="img-responsive " src="imagenes/user.jpg">
  </div>

  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 " >
   <span class="span2 span2grandaria">Escrito por Olga</span>
   <p>
       <span class=" glyphicon glyphicon-calendar ">17/05/2016</span>
       
   </p>
   <span>No me lo compro porque no es legible</span>
</div>
</div>


<div class="divcomentari">
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
      <img class ="img-responsive " src="imagenes/user.jpg">
  </div>

  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 " >
   <span class="span2 span2grandaria">Escrito por Ignacio</span>
   <p>
       <span class=" glyphicon glyphicon-calendar ">17/05/2016</span>
       
   </p>
   <span>Muy caro nose si eso en un futuro me lo compro</span>
</div>
</div>

<div class="divcomentari">
   <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 " >
      <img class ="img-responsive " src="imagenes/user.jpg">
  </div>

  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 " >
   <span class="span2 span2grandaria spancolor">Escrito por Crisitan</span>
   <p>
       <span class=" glyphicon glyphicon-calendar spancolor ">17/05/2016</span>
       
   </p>
   <span class="spancolor">Me lo compro porque milloneti</span>
</div>
</div>-->

</div>
<?php
}
printGame($game);
?>