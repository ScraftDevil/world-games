<!DOCTYPE html>
<html>
	<?php

		include("../sections/head.php");

		if ($_SESSION['usertype'] == "Professional") {
			header("Location:../index.php");
		}
		
		$_SESSION['userDataGrid'] = "professional";

		$users = null;
		$label = null;

		if(isset($_SESSION['msg']) AND !empty($_SESSION['msg'])) {
			$msg = $_SESSION['msg'];
			switch($msg) {
				case "i-success":
					$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Usuario creado satisfactoriamente!</strong></div>";
				break;

				case "u-success":
					$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Usuario actualizado satisfactoriamente!</strong></div>";
				break;
				
				case "username-error":
					$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Ese nombre de Usuario ya existe!</strong></div>";
				break;

				case "email-error":
					$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Ese email ya esta en uso!</strong></div>";
				break;

				case "deleteFail":
					$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error al borrar el Usuario!</strong></div>";
				break;

				case "deleteSuccess":
					$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Usuario eliminado satisfactoriamente!</strong></div>";
				break;

				case "group-error":
					$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Grupo erroneo!</strong></div>";
				break;

				case "access":
					$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Acceso denegado!</strong></div>";
				break;

				default:
					$message = null;
				break;
			}
			unset($_SESSION['msg']);
		} else {
			$message = null;
		}

	?>
<body>
	<?php

		include("../sections/header.php"); 

	?>
	<div class="container-fluid">
		<div class="row row-admin">
			<?php include ("../sections/menu.php"); ?>
			<div class="col-md-10 admin-content">
				<div class="container container-content">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h2 class="panel-title"> Lista de usuarios Profesionales</h2>
								</div>
							  	<div class="panel-body">
									<div class="grid">
										<?php
											if ($message != null) {
												echo $message;
											}
										?>
										<div class="new-button">
											<div class="btn-group">
											  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											    Profesionales
												<span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu">
											    <li><a href="registeredListView.php">Registrados</a></li>
											    <li><a href="professionalListView.php">Profesionales</a></li>
											    <li><a href="administratorListView.php">Administradores</a></li>
											  </ul>
											</div>
											<button type="button" class="btn btn-success"><a href="newUserView.php"><i class="fa fa-user" aria-hidden="true"></i> Nuevo Usuario</a></button>
										</div>
										<?php
											include("../../controller/userControllers/showProfessionalController.php");
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<?php include("../sections/footer.php"); ?>
		<script type="text/javascript" src="../resources/js/usersManage.js"></script>
	</footer>
</body>
</html>