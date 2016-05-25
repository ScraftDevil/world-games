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
									<h2 class="panel-title">Nuevo Juego</h2>
								</div>
							  	<div class="panel-body">
								    <form id="gameinsert" >
										<div class="row">
											<div class="col-md-4">
												<div id="general-error"></div>
												<div class="form-group">
													<span for="Title">Titulo</span><span > (<span class="glyphicon glyphicon-asterisk"></span>)</span>
													
													<input type="text" class="form-control" name="title" id="title" placeholder="Titulo"  />
													<label class="error">l</label>
												</div>
												<div class="form-group">
													<label for="Precio">Precio</label><label for="password-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<div class="input-group input-radius">
														<input type="text" class="form-control" id="price" name="precio" placeholder="Precio"  />
													</div>
												</div>
												<div class="form-group  ">
												<label for="plataform">Stock</label>
														<input disabled type="number" class="form-control stockgame" id="stock" name="stock" value="0" />
														<button type="button" name="sumar" id="sumar" class="btn btn-info pull-left marginstock">Incrementar Stock</button>
														<button type="button" name="restar" id="restar" class="btn btn-info  marginstock">Decrementar Stock</button>
												</div>

												<div class="form-group widthselect">
												<label for="plataform">Genero</label><label for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
														<?php include("../sections/genreList.php"); ?><span class="server-error"></span>
												</div>									
												<div class="form-group">
													<label for="plataform">Plataforma</label><label for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
													<?php include("../sections/platformList.php"); ?><span class="server-error"></span>
												</div>
												<div class="form-group">
												<button type="button" name="insert-game" id="insert-game" class="btn btn-info pull-left">Enviar</button>
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