<!DOCTYPE html>
<html>
	<?php
		$gameid = 0;
		if (isset($_GET['gameid'])) {
			$gameid = $_GET['gameid'];
		}
		include("../../controller/adminAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:../adminLoginView.php");
		}
		if ($_SESSION['usertype'] == "Professional") {
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
									<h2 class="panel-title">Gestion de oferta</h2>
								</div>
								<div class="panel-body">
									<div class="grid">
										<div class="new-button">
											<button id="newOffer" type="button" class="btn btn-success"><a href="newOfferView.php?gameid=<?php echo $_GET['gameid'];?>" id="newOfferRef"><i class="fa fa-gift" aria-hidden="true"></i> Nueva Oferta</a></button>
										</div>
										<?php
											include("../../controller/offerControllers/showOfferController.php");
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
		<script type="text/javascript" src="../resources/js/offersManage.js"></script>
	</footer>
</body>
</html>