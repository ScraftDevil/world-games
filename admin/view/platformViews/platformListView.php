<!DOCTYPE html>
<html>
	<?php 

		include("../sections/head.php"); 

		if(isset($_GET['msg']) AND !empty($_GET['msg'])) {
			$msg = $_GET['msg'];
			switch($msg) {
				case "success":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Plataforma creada satisfactoriamente!</strong></div>";
				break;
				
				case "errusername":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Esa Plataforma ya existe!</strong></div>";
				break;

				case "deleteFail":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error al borrar la Plataforma!</strong></div>";
				break;

				case "deleteSuccess":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Plataforma eliminada satisfactoriamente!</strong></div>";
				break;

				case "gameNotSelected":
				$message = "<div class=\"alert alert-warning\"><strong>Aviso:</strong> No has seleccionado ningúna plataforma para gestionar el juego.</div>";
				break;

				

				default:
					$message = null;
				break;
			}
		} else {
			$message = null;
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
									<h2 class="panel-title">Lista de Plataformas</h2>
								</div>
								<div class="panel-body">
									<div class="grid">
										<?php
											if ($message != null) {
												echo $message;
											}
										?>
										<div class="new-button">
											<button type="button" class="btn btn-success"><a href="newPlatformView.php"><i class="fa fa-user" aria-hidden="true"></i> Nueva Plataforma</a></button>
											
										</div>
										<?php
											include("../../controller/platformControllers/showPlatformController.php");
										?>
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
		<script type="text/javascript" src="../resources/js/platformManage.js"></script>
		<script>
	</script>
	</footer>
</body>
</html>