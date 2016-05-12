<!DOCTYPE html>
<html>
    <?php
    include("sections/head.php");
    ?>
    <body>
        <div id="page" class="page">
            <?php
            include("sections/nav.php");
            include("sections/search.php");
            ?>
            <section class="content-block gallery-1">
                <div class="container">
                    <div class="underlined-title">
                        <div class="editContent">
                            <p>
                            <h1>Monthy Offers</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Choose your offer</h2></div>
                    </div>
                    <div class="row">
                        <div id="isotope-gallery-container">
                            <?php
                            $onlyOffers = true;
                            include("../controller/controllerShowGames.php");
                            ?>
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