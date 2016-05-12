<!DOCTYPE html>
<html>
<?php
    include("sections/header.php");
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
                    <!--<div class="editContent">
                        <ul class="filter">
                            <li class="active">All</li>
                            <li>Origin</li>
                            <li>Steam</li>
                            <li>Xbox</li>
                            <li>Playstation Network</li>
                            <li>Apple</li>
                        </ul>
                    </div>
                    <div class="editContent">
                        <ul class="filter">
                            <li class="active">RPG</li>
                            <li>Adventure</li>
                            <li>Action</li>
                            <li>Shooter</li>
                            <li>Racing</li>
                            <li>Graphic Adventure</li>
                        </ul>
                    </div>-->
                    <div class="row">
                        <div id="isotope-gallery-container">
                            <?php
                                $onlyOffers = false;
                                include("../controller/controllerShowGames.php");
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
                include("sections/footer.php");
            ?>
    </body>
    </html>