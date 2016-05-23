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
									<h2 class="panel-title"> Nuevo Usuario <?php echo $label; ?></h2>
								</div>
							  	<div class="panel-body">
								    <form id="registered-user">
										<div class="row">
											<div class="col-md-12">
												<div id="general-error"></div>
												<div class="form-group">
													<label for="username">Nombre de Usuario</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
													<input type="text" class="form-control" name="username" id="username" placeholder="Username" required><span id="user-error" class="server-error"></span>
													</div>
												</div>
												<div class="form-group">
													<label for="password">Contraseña</label><label for="password-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
														<input type="password" class="form-control" id="password" name="password" placeholder="Password" required><span class="server-error"></span>
													</div>
												</div>
												<div class="form-group">
													<label for="email">Email</label><label for="email-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
														<input type="email" class="form-control" id="email" name="email" placeholder="Email" required><span class="server-error"></span>
													</div>
												</div>
												<div class="form-group">
													<label for="birthdate">Fecha de Nacimiento</label><label for="birthdate-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
														<input type="text" class="form-control" id="calendar" name="birthdate" placeholder="Birthdate" required><span class="server-error"></span>
													</div>
												</div>
												<div class="form-group">
													<label for="country">País</label><label for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<?php include("../sections/countryList.php"); ?><span class="server-error"></span>
												</div>
												<div class="form-group">
												<button type="button" name="insert-user" id="insert-user" class="btn btn-info pull-left">Enviar</button>
												</div>
											</div>
										</div>
									</form>
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