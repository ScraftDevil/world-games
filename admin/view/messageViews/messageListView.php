<!DOCTYPE html>
<html>
	<?php

		include("../sections/head.php"); 

		if(isset($_GET['msg']) AND !empty($_GET['msg'])) {
			$msg = $_GET['msg'];
			switch($msg) {
				case "success":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Mensaje creado satisfactoriamente!</strong></div>";
				break;
				
				case "errusername":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Ese Mensaje ya existe!</strong></div>";
				break;

				case "deleteFail":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error al borrar el Mensaje!</strong></div>";
				break;

				case "deleteSuccess":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Mensaje eliminado satisfactoriamente!</strong></div>";
				break;

				case "gameNotSelected":
				$message = "<div class=\"alert alert-warning\"><strong>Aviso:</strong> No has seleccionado ningún mensaje para gestionar su oferta.</div>";
				break;

				case "successOffer":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Se ha creado la oferta del mensaje con exito!</strong></div>";
				break;

				case "errorOffer":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡No se ha podido añadir la oferta en el mensaje!</strong></div>";
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
									<h2 class="panel-title">Lista de Mensajes</h2>
								</div>
								<div class="panel-body">
									<div class="grid">
										<?php
											if ($message != null) {
												echo $message;
											}
										?>
										
										<?php
											include("../../controller/messageControllers/showMessageController.php");
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
		<script type="text/javascript" src="../resources/js/gamesManage.js"></script>
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
			$("#offerGame a").attr("href", "../offerViews/manageOfferView.php?gameid="+idgame);
			$(this).parent().parent().parent().attr("class", "selected");
		});
		</script>
	</footer>
</body>
</html>