<!DOCTYPE html>
<html>
	<?php

		include("../sections/head.php"); 
		
				
		$label = null;
		$id = null;

		

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			if ($id != "" AND $id != null) {
				$id = intval($id);
				if (is_nan($id)) {
					header("Location:gameListView.php");
				}
			} else {
				header("Location:gameListView.php");
			}
		} else {
			header("Location:gameListView.php");
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
									<h2 class="panel-title">Update Juego</h2>
								</div>
								<div class="panel-body">
									<form id="forminsert">
										<div class="col-md-4">
											<div id="general-error"></div>
											<div class="form-group">
												<span for="Title">Titulo</span><span > (<span class="glyphicon glyphicon-asterisk"></span>)</span>
												<input type="title" class="form-control" name="title" id="title" placeholder="Titulo"  />
											</div>
											<div class="form-group">
												<span for="Precio">Precio</span><span for="password-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</span>
												<input type="price" class="form-control" id="price" name="price" placeholder="Precio" />
											</div>

											<div class="form-group">
												<span for="plataform">Stock</span>
												<input disabled type="number" class="form-control stockgame" id="stock" name="stock" value="0" />
												<button type="button" name="sumar" id="sumar" class="btn btn-info pull-left marginstock">Incrementar Stock</button>
												<button type="button" name="restar" id="restar" class="btn btn-info  marginstock">Decrementar Stock</button>
											</div>
											<div class="form-group widthselect">
												<span for="plataform">Genero</span><span for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</span>
												<?php include("../sections/genreList.php"); ?><span class="server-error"></span>
											</div>
											<div class="form-group">
												<span for="plataform">Plataforma</span><span for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</span>
												<?php include("../sections/platformList.php"); ?><span class="server-error"></span>
											</div>
											<div class="form-group">
												<button type="button" name="insert-game" id="insert-game" class="btn btn-info pull-left">Enviar</button>
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
		<script type="text/javascript">
			group = "<?php echo $group ?>";
			id = "<?php echo $_GET['id']; ?>";
		</script>
		<script type="text/javascript" src="../resources/js/usersManage.js"></script>
	</footer>
</body>
</html>