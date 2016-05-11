<!DOCTYPE html>
<html>
	<?php include("sections/head.php"); ?>
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
					<?php if () { ?>
						<a>Profesionales</a>
						<a>Administradores</a>
					<?php } ?>
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