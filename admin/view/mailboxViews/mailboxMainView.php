<!DOCTYPE html>
<html>

	<?php include("../sections/head.php"); ?>
	
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
									<h2 class="panel-title"> Buzón de <?php echo $_SESSION["username"];?></h2>
								</div>
								<div class="panel-body">
									<div class="grid">
										<div class="row">
											<div class="col-md-offset-1 col-md-5">
												<a href="reportListView.php">
													<div class="col-md-12 mailbox">
														<div class="mail-logo">
															<i class="fa fa-envelope" aria-hidden="true"></i>
														</div>
														<div class="col-md-12">
															<div class="col-md-12 mail-title">Buzón de Quejas</div>
														</div>
													</div>
												</a>
											</div>
											<div class="col-md-5">
												<a href="complaintListView.php">
													<div class="col-md-12 mailbox">
														<div class="mail-logo">
															<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
														</div>
														<div class="col-md-12">
															<div class="col-md-12 mail-title">Buzón de Denuncias</div>
														</div>
													</div>
												</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>