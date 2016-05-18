<!DOCTYPE html>
<html>
	<?php

		include("../../controller/adminAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:adminLoginView.php");
		}
		include("../resources/sections/head.php"); 

	?>
<body>
	<?php

		include("../resources/sections/header.php"); 

	?>
	<div class="container-fluid">
		<div class="row row-admin">
			<?php include ("../resources/sections/menu.php"); ?>
			<div class="col-md-offset-1 col-md-8 admin-content">
				<div class="container container-content">
					<div class="">
						<p>Total mujeres</p>
						<p>Total hombre</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>