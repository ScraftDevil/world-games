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
                                <h1>Detalle Producto</h1>
                                </p>
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <div id="isotope-gallery-container">
                                <?php
                                include("../view/showDetailGame.php");
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