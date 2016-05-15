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
							<div class="grid">
								<div class="new-button">
									<div class="btn-group">
									  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    Registrados <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu">
									    <li><a href="userListView.php?group=registered">Registrados</a></li>
									    <li><a href="userListView.php?group=professional">Profesionales</a></li>
									    <li><a href="userListView.php?group=administrator">Administradores</a></li>
									  </ul>
									</div>
									<button type="button" class="btn btn-success"><i class="fa fa-user" aria-hidden="true"></i> Nuevo Usuario</button>
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