<!DOCTYPE html>
<html>
	<?php

		include("../../controller/adminAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:../mainViews/adminLoginView.php");
		}
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
		} else {
			header("Location:../index.php");
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
													<label for="user">Usuario Reportado</label>
													<div class="input-group input-radius">
														<input type="text" class="form-control" name="username" id="username" placeholder="Username" readonly>
													</div>
												</div>
												<div class="form-group">
													<label for="date">Fecha</label>
													<div class="input-group input-radius">
														<input type="text" class="form-control" name="date" id="date" placeholder="Date" readonly>
													</div>
												</div>
												<div class="form-group">
													<label for="hour">Hora</label>
													<div class="input-group input-radius">
														<input type="text" class="form-control" name="hour" id="hour" placeholder="Hour" readonly>
													</div>
												</div>
												<div class="form-group">
													<label for="user">Mensaje</label>
													<div class="input-group input-radius">
														<textarea type="text" class="form-control" name="text" id="text" placeholder="text" readonly></textarea>
													</div>
												</div>
												<div class="form-group">
													<label for="status">Estado</label>
													<div class="dropdown">
  														<button class="btn btn-default dropdown-toggle" type="button" name="status" id="status" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="">
    														<span id="status-name"></span>
    														<span class="caret"></span>
  														</button>
														<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
															<li class="dropdown-header"><a value="No leído" href="#" class="country" onclick="changeStatus(this)">No leído</a></li>
															<li class="dropdown-header"><a value="Leído" href="#" class="country" onclick="changeStatus(this)">Leído</a></li>
															<li class="dropdown-header"><a value="Denegado" href="#" class="country" onclick="changeStatus(this)">Denegado</a></li>
															<li class="dropdown-header"><a value="Aceptado" href="#" class="country" onclick="changeStatus(this)">Aceptado</a></li>
														</ul>
													</div>
													<button type="button" name="change-status" id="change-status" class="btn btn-info pull-left">Cambiar Estado</button>
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