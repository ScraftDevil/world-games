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
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Comentario creado satisfactoriamente!</strong></div>";
				break;
				
				case "errusername":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Ese Comentario ya existe!</strong></div>";
				break;

				case "deleteFail":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Error al borrar el Comentario!</strong></div>";
				break;

				case "deleteSuccess":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Comentario eliminado satisfactoriamente!</strong></div>";
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
									<h2 class="panel-title">Lista de Comentarios</h2>
								</div>
								<div class="panel-body">
									<div class="grid">
										<?php
											if ($message != null) {
												echo $message;
											}
										?>
										
										<?php
											include("../../controller/commentControllers/showCommentController.php");
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