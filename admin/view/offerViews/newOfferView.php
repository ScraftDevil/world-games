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
									<h2 class="panel-title">Nueva Oferta</h2>
								</div>
							  	<div class="panel-body">
								    <form id="offerinsert">
										<div class="row">
											<div class="col-md-12">
												<div id="general-error"></div>
												<div class="form-group">
													<input type="hidden" name="game" id="game" value="<?php echo $_GET['gameid'];?>"/>
													<label for="Discount">Descuento</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
													<input type="text" class="form-control" name="discount" id="discount" placeholder="Descuento" required />
													</div>
												</div>
												<div class="form-group">
												<button type="button" name="insert-offer" id="insert-offer" class="btn btn-info pull-left">Agregar</button>
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