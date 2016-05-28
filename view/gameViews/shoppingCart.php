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
            
            if (isset($_SESSION['shop'])) {
            ?>
            <section class="content-block gallery-1">
                <div class="container">
                    <div class="underlined-title">
                        <div class="editContent">
                            <p>
                            <h1>Shopping Cart</h1>
                            </p>
                        </div>
                        <hr>
                        <div class="editContent">
                            <h2>Aqui tienes los producos añadidos al carrito de la compra</h2></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="msgShoppingCartDetails" class="alert alert-info">
                                <strong>Información:</strong> Ningun juego añadido a la cesta de la compra.
                            </div>
                            <table id="shoppingCartDetails" class="table table-hover"></table>
                            <button type="button" id="shoppingBuy" class="btn btn-default pull-right" disabled>
                              <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Realizar Compra
                            </button>
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