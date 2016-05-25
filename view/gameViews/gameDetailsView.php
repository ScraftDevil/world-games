<!DOCTYPE html>
<html>
    <?php
    include("../sections/head.php");
    ?>
    <body>
        <div id="page" class="page">
            <?php
            include("../sections/nav.php");
            ?>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 underlined-title">
                            <div>
                                <p>
                                <h1>Detalle Producto</h1>
                                </p>
                            </div>
                            <hr>
                        </div>
                        <?php
                        include("showGameDetails.php");
                        ?>

                    </div>
                </div>
            </section>
        </div>
        <footer>
            <?php
            include("../sections/footer.php");
            ?>
            <script src="../resources/js/opinions.js" type="text/javascript"></script>
            <script src="../resources/js/rating.js" type="text/javascript"></script>
        </footer>
    </body>
</html>