<!DOCTYPE html>
<html>
	<?php

		include("../controller/authController.php");
		if (!checkAuth()) {
			header("Location:adminLoginView.php");
		}
		include("sections/head.php"); 
		echo $_SESSION['user'];
	?>
<body>
	<header>
		<h1>Panel de Administración</h1>
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