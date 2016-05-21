<!DOCTYPE html>
<html>
	<?php

		include("../../controller/adminAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:../mainViews/adminLoginView.php");
		}
		if ($_SESSION['usertype'] == "Professional") {
			header("Location:../index.php");
		}
		include("../sections/head.php"); 

		$group = null;
		$label = null;

		if(isset($_GET['group'])) {
			switch ($_GET['group'])  {
				case "administrator": {
					$label = 'Administradores';
					$group = 'administrator';
					break;
				}
				case "professional": {
					$label ='Profesionales';
					$group = 'professional';
					break;
				}
				case "registered": {
					$label = 'Registrados';
					$group = 'registered';
					break;
				}
			}
		}

		if(isset($_GET['msg']) AND !empty($_GET['msg'])) {
			$msg = $_GET['msg'];
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

				default:
					$message = null;
				break;
			}
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
									<h2 class="panel-title"> Lista de usuarios <?php echo $label; ?></h2>
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
											    <?php echo $label; ?>
												<span class="caret"></span>
											  </button>
											  <ul class="dropdown-menu">
											    <li><a href="userListView.php?group=registered">Registrados</a></li>
											    <li><a href="userListView.php?group=professional">Profesionales</a></li>
											    <li><a href="userListView.php?group=administrator">Administradores</a></li>
											  </ul>
											</div>
											<button type="button" class="btn btn-success"><a href="newUserView.php?group=<?php echo $group; ?>"><i class="fa fa-user" aria-hidden="true"></i> Nuevo Usuario</a></button>
										</div>
										<?php
											include("../../controller/userControllers/showUsersController.php");
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
	</footer>
</body>
</html>