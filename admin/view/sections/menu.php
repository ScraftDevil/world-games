<div class="col-md-2 admin-menu">
	<a href="../mainViews/adminView.php"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
	<a href="../gameViews/gameListView.php"><i class="fa fa-gamepad" aria-hidden="true"></i> Juegos</a>
	<a><i class="fa fa-mobile" aria-hidden="true"></i> Plataformas</a>
	<a><i class="fa fa-diamond" aria-hidden="true"></i> Géneros</a>
	<a><i class="fa fa-globe" aria-hidden="true"></i> Paises</a>
	<?php
		if ($_SESSION['usertype'] == "Administrator") {
			?>
				<a href="../userViews/userListView.php?group=registered"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a>
			<?php
		}
	?>		
	<a><i class="fa fa-envelope" aria-hidden="true"></i> Buzón</a>
</div>