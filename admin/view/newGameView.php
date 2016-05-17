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
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h2 class="panel-title"> Nuevo Juego <?php echo $label; ?></h2>
								</div>
							  	<div class="panel-body">
								    <form id="registered-user">
										<div class="row">
											<div class="col-md-12">
												<div id="general-error"></div>
												<div class="form-group">
													<label for="Title">Titulo juego</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
													<input type="text" class="form-control" name="title" id="Title" placeholder="Title" required><span id="user-error" class="server-error"></span>
													</div>
												</div>
												<div class="form-group">
													<label for="Precio">Precio juego</label><label for="password-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
														<input type="text" class="form-control" id="Password" name="price" placeholder="Precio" required><span class="server-error"></span>
													</div>
												</div>
												<div class="form-group">
													<label for="Email">Stock juego</label><label for="email-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
														<input type="email" class="form-control" id="Email" name="stock" placeholder="Stock" required><span class="server-error"></span>
													</div>
												</div>
												
												<div class="form-group">
													<label for="plataform">Plataforma juego</label><label for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<?php include("sections/plataformList.php"); ?><span class="server-error"></span>
												</div>
												<div class="form-group caixasubmit">
												<button type="button" name="submit" id="submit" class="btn btn-info pull-left">Enviar</button>
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
		<?php include("sections/footer.php"); ?>
	</footer>
</body>
</html>