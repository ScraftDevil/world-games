<header id="header">
    <nav class="main-nav navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="../"><img src="images/logo.png" class="brand-img img-responsive"></a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    $page = str_replace(".php", "", basename($_SERVER['PHP_SELF']));
                    ?>
                    <li class="<?php if ($page=="home") { echo 'active ';}?>nav-item"><a href="home.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Inicio</a></li>
                    <li class="<?php if ($page=="games") { echo 'active ';}?>nav-item"><a href="games.php"><i class="fa fa-gamepad" aria-hidden="true"></i>&nbsp;Juegos</a></li>
                    <!-- SHOPPING CART -->
                    <li class="nav-item dropdown" id="shoppingCartBtn">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" role="button"> <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Carrito&nbsp;<span class="badge" id="countShoppingCart"></span><span class="caret"></span></a>
                      <ul class="dropdown-menu dropdown-cart" role="menu">
                          <li id="basket"></li>
                          <li><a class="text-center" id="shoppingCartTotal">Total: 0 €</a></li>
                          <li class="divider"></li>
                          <li><a class="text-center" href="#" id="clearShop">Vaciar Carrito</a></li>
                          <li><a class="text-center" href="shoppingCart.php">Finalizar Compra</a></li>
                      </ul>
                    </li>
                    <!-- END SHOPPING CART -->
                    <?php

                        if (!isset($_SESSION['frontAuth'])) {
                            ?>
                            <li class="<?php if ($page=="login") { echo 'active ';}?>nav-item"><a href="login.php"><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Entrar</a></li>
                            <?php
                        } else {
                            ?>
                            <li class="nav-item dropdown">
		                        <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false" href="#">Mi Cuenta <i class="fa fa-angle-down"></i></a>
		                        <ul class="dropdown-menu">
		                            <li><a href="registeredProfileView.php">Mi Perfil</a></li>
		                            <li><a id="logout" href="#">Salir</a></li>
		                        </ul>
		                    </li>
                            <?php
                        }
                    ?>
                </ul>
                <div class="col-md-4">
                    <form class="navbar-form" role="search" style="padding-top: 13px">
                        <div class="input-group">
                            <input id="search" type="text" class="form-control" placeholder="Buscar tu juego" name="q">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                        <div id="result" class="col-md-12" style="color: white; background: #193441; display: none; margin-top: 22px; border: 2px solid black"></div>
                    </form>
                </div>     
            </div>
        </div>
    </nav>
</header>