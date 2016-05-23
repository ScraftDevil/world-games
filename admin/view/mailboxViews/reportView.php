<!DOCTYPE html>
<html>
	<?php

		include("../../controller/adminAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:../mainViews/adminLoginView.php");
		}
		if (isset($_GET['id'])) {
			$id = $_GET['id'];

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
									<h2 class="panel-title"> </h2>
								</div>
							  	<div class="panel-body">
								    <form id="report">
										<div class="row">
											<div class="col-md-12">
												<div id="general-error"></div>
												<div class="form-group">
													<label for="country">Estado</label><label for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="dropdown">
  														<button class="btn btn-default dropdown-toggle" type="button" name="status" id="status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="">
    														<span id="status-name"></span>
    														<span class="caret"></span>
  														</button>
														<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
															<li class="dropdown-header"><a value="No Leído" href="#" class="country" onclick="changeCountry(this)">No leído</a></li>
															<li class="dropdown-header"><a value="Leído" href="#" class="country" onclick="changeCountry(this)">Leído</a></li>
															<li class="dropdown-header"><a value="Denegado" href="#" class="country" onclick="changeCountry(this)">Denegado</a></li>
															<li class="dropdown-header"><a value="Aceptado" href="#" class="country" onclick="changeCountry(this)">Aceptado</a></li>
														</ul>
														<button type="button" name="insert-user" id="change-status" class="btn btn-info pull-left">Cambiar Estado</button>
													</div>
												</div>
											</div>
										</div>
									</form>
									<div id="report-text">
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
		<script type="text/javascript" src="../resources/js/reportsManage.js"></script>
	</footer>
</body>
</html>