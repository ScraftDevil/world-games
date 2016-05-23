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

		$id = null;

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
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
									<h2 class="panel-title"> Modificar Oferta <span id="user"></span></h2>
								</div>
							  	<div class="panel-body">
								    <form id="registered-user">
										<div class="row">
											<div class="col-md-12">
												<div id="general-error"></div>
												<div class="form-group">
													<label for="discount">Descuento (%)&nbsp;</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
													<input type="text" class="form-control" name="discount" id="discount" placeholder="Descuento" required><span id="user-error" class="server-error"></span>
													</div>
												</div>
												<div class="form-group">
													<button type="button" name="update-offer" id="update-offer" class="btn btn-info pull-left">Editar</button>
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
		<script type="text/javascript" src="../resources/js/offersManage.js"></script>
	</footer>
</body>
</html>