<!DOCTYPE html>
<html>
	<?php

		include("../controller/authController.php");
		if (!checkAuth()) {
			header("Location:adminLoginView.php");
		}
		include("sections/head.php"); 

	?>
<body>
	<header id="adminView">
		<div class="row">
			<div class="col-md-2">
				<div class="logo"><img src="images/logo.png"/></div>
			</div>
			<div class="col-md-offset-2 col-md-4">
				<h1 id="header-name">Panel de Administración</h1>
			</div>
			<div class="col-md-4">
				<form id="logout" action="../controller/adminLogoutController.php" method="POST">
					<div class="row">
						<?php
							if (strlen($_SESSION['user']) > 6) {
								echo "<div class=\"col-md-offset-1 col-md-5 pro-user\">";
							} else {
								echo "<div class=\"col-md-offset-2 col-md-4 admin-user\">";
							}
						?>
				        	<h4>Hola, <?php echo $_SESSION['user']; ?></h4>
				        </div>
				        <div class="col-md-4">
				        	<button class="btn btn-lg btn-primary btn-block btn-signin login" name="logout" type="submit" id="logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
				        </div>
				    </div>
				</form>
		    </div>
	    </div>
	</header>
	<div class="container-fluid">
		<div class="row row-admin">
			<div class="col-md-2 admin-menu">
				<a>Inicio</a>
				<a>Juegos</a>
				<a>Plataformas</a>
				<a>Géneros</a>
				<a id="usuarios-menu">Usuarios</a>
				<div id="usuarios">
					<a>Registrados</a>
						<a>Profesionales</a>
						<a>Administradores</a>
				</div>
				<a>Buzón</a>
				<a>Estadísticas</a>
			</div>
			<div class="col-md-offset-1 col-md-8 admin-content">
				<div class="container container-content">
					<div style="background-color: black;" class="">
						
						<p>Total mujeres</p>
						<p>Total hombre</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>