<!DOCTYPE html>
<html>

	<?php include("../sections/head.php"); ?>
	
<body>
	<?php

		include("../sections/header.php");
		include("../../controller/platformControllers/getPlatformController.php");

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
									<h2 class="panel-title">Editar Plataforma</h2>
								</div>
							  	<div class="panel-body">
								    <form id="platform-up">
										<div class="row">
											<div class="col-md-12">
												<div id="general-error"></div>
												<div class="form-group">
													<label for="Nombre">Nombre</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
													<input type="text" class="form-control" name="name" id="name" placeholder="Nombre" value="<?php echo $platform; ?>" required />
													</div>
												</div>
												
												<div class="form-group">
												<button type="button" name="update-platform" id="update-platform" class="btn btn-info pull-left" value="<?php echo $_POST['platform']; ?>">Enviar</button>
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
		<script type="text/javascript" src="../resources/js/platformManage.js"></script>
	</footer>
</body>
</html>