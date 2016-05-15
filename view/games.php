<!DOCTYPE html>
<html>
    <?php
    include("sections/head.php");
    ?>
    <body>
        <div id="page" class="page">
            <?php
            include("sections/nav.php");
            ?>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 underlined-title">
                            <div>
                                <p>
                                <h1>Lista de juegos en la tienda</h1>
                                </p>
                            </div>
                            <hr>
                            <div>
                                <h2>Filtra por Genero y/o Plataforma si lo deseas</h2>
                                <?php include("sections/filter.php"); ?>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div id="isotope-gallery-container">
                                <?php
                                $onlyOffers = false;
                                include("../view/ShowGames.php");
                                ?>
                            </div>
                    </div>
                    </div>
                </div>
            </section>
            <?php
            include("sections/footer.php");
            ?>
        </div>
    </body>
</html>