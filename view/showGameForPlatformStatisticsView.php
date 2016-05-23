<!DOCTYPE html>
<html>

<?php

/* codigo php */
require_once("../model/autoload.php");
include("sections/head.php");

// controlador que obtiene el número de juegos según la plataforma
include("../controller/countGameForPlatform.php");

?>

    <body>
        <div id="page" class="page">
            <?php include("sections/nav.php"); ?>
            <section class="content-block gallery-1">
                <div class="container">
                    <div class="underlined-title">
                        <div class="editContent">
                            <p>
                            <h1>Estadísticas de la web</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Número de juegos según la plataforma</h2>
                        </div>
                    </div>

                    <!-- Lista de opciones del perfil del usuario -->
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-sm-offset-2 col-md-offset-2 col-lg-offset-2">

                        	

                    </div>
                </div>
            </section>
            <?php include("sections/footer.php"); 
        ?>
    </body>
</html>