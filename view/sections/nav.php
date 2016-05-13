<header id="header">
    <nav class="main-nav navbar-fixed-top headroom headroom--pinned">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="images/logo.png" class="brand-img img-responsive">
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active nav-item"><a href="home.php">Inicio</a></li>
                    <li class="nav-item"><a href="games.php">Juegos</a></li>
                    <li class="nav-item"><a href="login.php">Entrar</a></li>
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