<!DOCTYPE html>
<html>
	<?php

		include("../../controller/adminAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:adminLoginView.php");
		}
		include("../sections/head.php");

	?>
<body>
	<?php

		include("../sections/header.php");

		if(isset($_GET['msg']) AND !empty($_GET['msg'])) {
			$msg = $_GET['msg'];
			switch($msg) {

				case "success":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Queja actualizada!</strong></div>";
				break;

				case "u-success":
				$message = "<div class=\"alert success\"><strong><span class=\"glyphicon glyphicon-ok\"></span> ¡Usuario actualizado satisfactoriamente!</strong></div>";
				break;
				
				case "username-error":
				$message = "<div class=\"alert error\"><strong><span class=\"glyphicon glyphicon-remove\"></span> ¡Ese nombre de Usuario ya existe!</strong></div>";
				break;

				default:
					$message = null;
				break;
			}
		} else {
			$message = null;
		}

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
									<h2 class="panel-title"> Buzón de Quejas de <?php echo $_SESSION["username"];?></h2>
								</div>
								<div class="panel-body">
									<?php
										if ($message != null) {
											echo $message;
										}
									?>
									<div class="grid">
										<?php 
										include("../../controller/mailboxControllers/showReportsController.php"); ?>
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
	</footer>
</body>
</html>