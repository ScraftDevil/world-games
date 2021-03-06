<!DOCTYPE html>
<html>
    <?php
    include("../sections/head.php");
    ?>
    <body>
        <div id="page" class="page">
            <?php
            include("../sections/nav.php");

            if (isset($_GET['message']) && isset($_SESSION[$_GET['message']])) {
                echo $_SESSION[$_GET['message']];
                unset($_SESSION[$_GET['message']]);
            }
            
            if (isset($_GET['msg']) && $_GET['msg']=="ACCOUNT_DELETED") {
                ?>
                <script type="text/javascript" src="../resources/js/redirection.js"></script>
                <div class="delete-success">¡Tu usuario ha sido eliminado correctamente!<br>
                    Serás redirigido a la página principal en <span id="contenedor"><?php "<script>tiempo()</script>" ?></span> segundos.</div> <?php
            }

            if (isset($_SESSION['shop'])) {
            ?>
            <section class="content-block gallery-1">
                <div class="container">
                    <div class="underlined-title">
                        <div class="editContent">
                            <p>
                            <h1>Ofertas Mensuales</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Escoge tu Oferta</h2></div>
                    </div>
                    <div class="row">
                        <div id="isotope-gallery-container">
                            <?php
                            $onlyOffers = true;
                            include("../gameViews/showGames.php");
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            include("../sections/footer.php");
        } else {
            if (!isset($_GET['msg'])) {
                 echo'
                     <section class="content-block gallery-1">
                        <div class="container">
                            <div class="underlined-title">
                                <div class="editContent">
                                    <p>
                                    <script type="text/javascript" src="../resources/js/redirection.js"></script>
                                    <div class="message-redirect">¡No puedes acceder directamente a esta pagina!<br>
                                    Serás redirigido a la página principal en <span id="contenedor"><script>tiempo()</script></span> segundos.</div>
                                    </p>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </section>
                ';
            }
        }
        ?>
        </div>
    </body>
</html>