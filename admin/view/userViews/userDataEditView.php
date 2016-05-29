<!DOCTYPE html>
<html>
	<?php

		include("../sections/head.php"); 
		
		require_once($_SESSION['BASE_PATH']."/model/autoload.php");

		if ($_SESSION['usertype'] == "Professional") {
			header("Location:../index.php");
		}
		

		$users = null;
		$label = null;
		$id = null;

		if(isset($_SESSION['userDataGrid'])) {
			switch ($_SESSION['userDataGrid'])  {

				case "administrator":
					$label = 'Administrador';
					$users = 'administrator';
				break;

				case "professional":
					$label ='Profesional';
					$users = 'professional';
				break;
				
				case "registered":
					$label = 'Registrado';
					$users = 'registered';
				break;

			}
		}

		if (isset($_POST['user']) && $_POST['user'] != "") {
			$id = $_POST['user'];
			$_SESSION['selectedID'] = $id;
			$shop = unserialize($_SESSION['shop']);
			$info = json_decode($shop->getUserWithGroup($id, $users));
			$name = $info->username;
			$email = $info->email;
			$bannedtime = $info->bannedtime;
			$birthdate = $info->birthdate;
			$paypal = $info->paypal;
			$avatar = $info->avatar;
			$countryID = $info->countryID;
			$country = $info->country;
		} else {
			header("Location:".$users."ListView.php");
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
									<h2 class="panel-title"> Modificar Usuario <span id="user"></span></h2>
								</div>
							  	<div class="panel-body">
								    <?php
								    	switch ($users)  {

											case "administrator":
												$label = 'Administrador';
												$users = 'administrator';

											break;

											case "professional":
												$label ='Profesional';
												$users = 'professional';
											break;

											case "registered":
												include("userForms/updateRegisteredForm.php");
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