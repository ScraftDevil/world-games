<?php

	$user = $_SESSION['adminAuth'];
	$username = $_SESSION['username'];
	$group = $_SESSION['usertype'];

?>
<header id="adminView">
	<div class="row">
		<div class="col-md-2">
			<div class="logo"><a href="../mainViews/mainView.php"><img src="../resources/images/logo.png"/></a></div>
		</div>
		<div class="col-md-offset-2 col-md-4">
			<h1 id="header-name">Panel de Administración</h1>
		</div>
		<div class="col-md-4">
			<form id="logout" action="../../controller/backAuthControllers/backLogoutController.php" method="POST">
				<div class="row">
					<?php

						if (strlen($username) > 6) {
							echo "<div class=\"col-md-offset-1 col-md-5 pro-user\">";
						} else {
							echo "<div class=\"col-md-offset-2 col-md-4 admin-user\">";
						}

						if ($group == "Administrator") {
							?> <h4>Hola, <?php echo "<a href=\"../userViews/userDataEditView.php?group=".strtolower($group)."&id=".$_SESSION['userid']."\">".$username."</a>"; ?></h4> <?php
						} else {
							?> <h4>Hola, <?php echo $username; ?></h4> <?php
						}

					?>
				</div>
				<div class="col-md-4">
					<button class="btn btn-lg btn-primary btn-block btn-signin login" name="logout" type="submit" id="logout-button"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
				</div>
			</div>
		</form>
	</div>
</div>
</header>