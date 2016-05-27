<!DOCTYPE html>
<html>
	<?php

		include("../sections/head.php"); 

		if ($_SESSION['usertype'] == "Professional") {
			header("Location:../index.php");
		}

		
		
		$users = null;
		$label = null;

		if(isset($_SESSION['userDataGrid'])) {
			switch ($_SESSION['userDataGrid'])  {
				case "administrator": {
					$label = 'Administrador';
					$users = 'administrator';
					break;
				}
				case "professional": {
					$label ='Profesional';
					$users = 'professional';
					break;
				}
				case "registered": {
					$label = 'Registrado';
					$users = 'registered';
					break;
				}
			}
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
									<h2 class="panel-title"> Nuevo Usuario <?php echo $label; ?></h2>
								</div>
							  	<div class="panel-body">
								    <?php
								    	switch($users) {
								    		
								    		case "registered":
								    			include("userForms/newRegisteredForm.php");
								    		break;

								    		case "professional": case "administrator":
								    			include("userForms/newAdminProfessionalForm.php");
								    		break;
								    	}
								    ?>
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
		<script type="text/javascript" src="../resources/js/usersManage.js"></script>
	</footer>
</body>
</html>