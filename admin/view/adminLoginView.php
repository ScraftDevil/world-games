<!DOCTYPE html>
<html>
	<?php

	include("../controller/authController.php");

	if (checkAuth()) {
		header("Location:adminView.php");
	}

	include("sections/head.php");

	?>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-offset-4 col-sm-4 col-md-offset-4 col-md-4 quit-padding-right">
				<div class="card card-container">
					<h3 class="admin-panel">Panel de Administración</h3>
					<img id="profile-img" class="profile-img-card" src="images/avatar.png" />
					<p id="profile-name" class="profile-name-card"></p>
					<form class="form-signin">
						<span id="reauth-email" class="reauth-email"></span>
						<input type="text" id="username" name="username" class="form-control" placeholder="Username" required autofocus>
						<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
						<div id="remember" class="checkbox">
							<label>
								<input type="checkbox" value="remember-me"> Remember me
							</label>
						</div>
						<button class="btn btn-lg btn-primary btn-block btn-signin login" type="submit" id="login"><i class="fa fa-unlock-alt" aria-hidden="true"></i> Sign in</button>
						<a href="#" class="forgot-password">Forgot the password?</a>
						<div id="msg" role="alert" style="margin-top:40px"></div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php include("sections/footer.php"); ?>
</body>
</html>