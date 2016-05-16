<!DOCTYPE html>
<html>
	<?php

		include("../controller/authController.php");
		if (!checkAuth()) {
			header("Location:adminLoginView.php");
		}
		if ($_SESSION['usertype'] == "Professional") {
			header("Location:../index.php");
		}
		include("sections/head.php"); 

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

	?>
<body>
	<?php

		include("sections/header.php"); 

	?>
	<div class="container-fluid">
		<div class="row row-admin">
			<?php include ("sections/menu.php"); ?>
			<div class="col-md-10 admin-content">
				<div class="container container-content">
					<div class="row">
						<div class="col-md-12">
							<h2> Lista de usuarios <?php echo $label; ?></h2>
							<div class="grid">
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
									include("../controller/showUsersController.php");
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<?php include("sections/footer.php"); ?>
	</footer>
</body>
</html>