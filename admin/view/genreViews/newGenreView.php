<!DOCTYPE html>
<html>
	<?php

		include("../../controller/adminAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:../mainViews/adminLoginView.php");
		}

		include("../sections/head.php"); 

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
									<h2 class="panel-title">Nuevo Genero</h2>
								</div>
							  	<div class="panel-body">
								    <form id="gameinsert">
										<div class="row">
											<div class="col-md-12">
												<div id="general-error"></div>
												<div class="form-group">
													<label for="Nombre">Nombre</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
													<input type="text" class="form-control" name="name" id="name" placeholder="Nombre" required />
													</div>
												</div>
												
												<div class="form-group">
												<button type="button" name="insert-genre" id="insert-genre" class="btn btn-info pull-left">Enviar</button>
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
		<script type="text/javascript" src="../resources/js/gamesManage.js"></script>
	</footer>
</body>
</html>