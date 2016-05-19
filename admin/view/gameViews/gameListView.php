<!DOCTYPE html>
<html>
	<?php

		include("../../controller/adminAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:../adminLoginView.php");
		}
		if ($_SESSION['usertype'] == "Professional") {
			header("Location:../index.php");
		}
		include("../sections/head.php"); 


		if(isset($_GET['msg']) AND !empty($_GET['msg'])) {
			$msg = $_GET['msg'];
			switch($msg) {
				case "success":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Juego creado satisfactoriamente!</strong></div>";
				break;
				
				case "errusername":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Ese Juego ya existe!</strong></div>";
				break;

				case "deleteFail":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error al borrar el Juego!</strong></div>";
				break;

				case "deleteSuccess":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> Juego eliminado satisfactoriamente!</strong></div>";
				break;

				case "gameNotSelected":
				$message = "<div class=\"alert alert-warning\"><strong>Aviso:</strong> No has seleccionado ningun juego para gestionar la seva oferta.</div>";
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
							<h2> Lista de  Juegos</h2>
							<div class="grid">
								<?php
									if ($message != null) {
										echo $message;
									}
								?>
								<div class="new-button">
									<button type="button" class="btn btn-success"><a href="newGameView.php"><i class="fa fa-user" aria-hidden="true"></i> Nuevo Juego</a></button>
									<button type="button" id="offerGame" class="btn btn-success"><a href=""><i class="fa fa-cog" aria-hidden="true"></i> Gestionar Oferta</a></button>
								</div>
								<?php
									include("../../controller/gameControllers/showGameController.php");
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<footer>
		<?php include("../sections/footer.php"); ?>	
		<script>
		var idgame = 0;
		$("#offerGame").click(function () {
			var anySelected = false;
			$('.grid tr').each(function() {
				if ($(this).hasClass("selected")) {
					anySelected = true;
				}
			});
			if (!anySelected) {
				window.location.href = 'gameListView.php?msg=gameNotSelected';
				return false;
			}
		});
		$(".selectGame").click(function () {
			$('.grid tr').each(function() {
				$(this).removeClass("selected");
			});
			idgame = $(this).parent().parent().parent().find("td:eq(0)").text();
			$("#offerGame a").attr("href", "offers/offersGameView.php?gameid="+idgame);
			$(this).parent().parent().parent().attr("class", "selected");
		});
		</script>
	</footer>
</body>
</html>