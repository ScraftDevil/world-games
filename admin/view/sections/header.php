<?php

	$user = $_SESSION['adminAuth'];
	$username = $_SESSION['username'];

?>
<header id="adminView">
	<div class="row">
		<div class="col-md-2">
			<div class="logo"><a href="../mainViews/adminView.php"><img src="../resources/images/logo.png"/></a></div>
		</div>
		<div class="col-md-offset-2 col-md-4">
			<h1 id="header-name">Panel de Administración</h1>
		</div>
		<div class="col-md-4">
			<form id="logout" action="../../controller/adminAuthControllers/adminLogoutController.php" method="POST">
				<div class="row">
					<?php
					if (strlen($username) > 6) {
						echo "<div class=\"col-md-offset-1 col-md-5 pro-user\">";
					} else {
						echo "<div class=\"col-md-offset-2 col-md-4 admin-user\">";
					}
					?>
					<h4>Hola, <?php echo "<a href=\"../userViews/userDataEditView.php?group=".strtolower($_SESSION['usertype'])."&id=".$_SESSION['userid']."\">".$username."</a>"; ?></h4>
				</div>
				<div class="col-md-4">
					<button class="btn btn-lg btn-primary btn-block btn-signin login" name="logout" type="submit" id="logout-button"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</button>
				</div>
			</div>
		</form>
	</div>
</div>
</header>