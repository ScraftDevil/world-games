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
				<h1>Panel de Administración</h1>
			</div>
			<div class="col-md-offset-1 col-md-3">
				<form id="logout" action="../controller/adminLogoutController.php" method="POST">
		            <h4>Welcome, <?php echo $_SESSION['user']; ?></h4>
		            <input type="submit" name="logout" id="submit" value="Logout"/>
		        </form>
		    </div>
	    </div>
	</header>
	<div class="container-fluid">
		<div class="row">
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
			</div>
		</div>
	</div>
</body>
</html>