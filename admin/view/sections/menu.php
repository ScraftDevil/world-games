<div class="col-md-2 admin-menu">
	<a href="../mainViews/mainView.php"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
	<a href="../gameViews/gameListView.php"><i class="fa fa-gamepad" aria-hidden="true"></i> Juegos</a>
	<a href="../platformViews/platformListView.php"><i class="fa fa-mobile" aria-hidden="true"></i> Plataformas</a>
	<a href="../genreViews/genreListView.php"><i class="fa fa-diamond" aria-hidden="true"></i> Géneros</a>
	<a href="../commentViews/commentListView.php"><i class="fa fa-commenting-o" aria-hidden="true"></i> Comentarios Juegos</a>
	<a href="../messageViews/messageListView.php"><i class="fa fa-envelope" aria-hidden="true"></i> Mensajes usuarios</a>
	<?php
		if ($_SESSION['usertype'] == "Administrator") {
			?>
				<a href="../userViews/registeredListView.php"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a>
			<?php
		}
	?>		
	<a href="../mailboxViews/mailboxMainView.php"><i class="fa fa-envelope" aria-hidden="true"></i> Buzón</a>
</div>