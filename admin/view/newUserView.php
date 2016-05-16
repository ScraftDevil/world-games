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
					$label = 'Administrador';
					$group = 'administrator';
					break;
				}
				case "professional": {
					$label ='Profesional';
					$group = 'professional';
					break;
				}
				case "registered": {
					$label = 'Registrado';
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
							<h2> Nuevo Usuario <?php echo $label; ?></h2>
							<form action="../controller/newUserController.php?group=<?php echo $group ?>" method="POST">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="Username">Nombre de Usuario</label>
											<div class="input-group">
											<input type="text" class="form-control" name="username" id="Username" placeholder="Username" required>
												<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
											</div>
										</div>
										<div class="form-group">
											<label for="Password">Contraseña</label>
											<div class="input-group">
												<input type="password" class="form-control" id="Password" name="password" placeholder="Password" required>
												<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
											</div>
										</div>
										<div class="form-group">
											<label for="Email">Email</label>
											<div class="input-group">
												<input type="email" class="form-control" id="Email" name="email" placeholder="Email" required>
												<span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
											</div>
										</div>
										<div class="form-group">
											<label for="Brithdate">Fecha de Nacimiento</label>
											<div class="input-group">
												<input type="text" class="form-control" id="Birthdate" name="birthdate" placeholder="Birthdate" required><span class="input-group-addon"><span>&nbsp;&nbsp;&nbsp;</span></span>
											</div>
										</div>
										<div class="form-group">
											<label for="Pais">País</label>
											<?php include("sections/countryList.php"); ?>
										</div>
										<input type="submit" name="submit" id="submit" class="btn btn-info pull-right">
									</div>
								</div>
							</form>
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