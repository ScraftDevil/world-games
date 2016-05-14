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
	<?php

		include("sections/header.php"); 

	?>
	<div class="container-fluid">
		<div class="row row-admin">
			<div class="col-md-2 admin-menu">
				<a>Inicio</a>
				<a>Juegos</a>
				<a>Plataformas</a>
				<a>Géneros</a>
				<a href="userListView.php">Usuarios</a>
				<a>Buzón</a>
				<a>Estadísticas</a>
			</div>
			<div class="col-md-offset-1 col-md-8 admin-content">
				<div class="container container-content">
					<div class="">
						<?php
							include("../controller/showUsersController.php");
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>