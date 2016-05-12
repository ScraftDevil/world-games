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
<<<<<<< HEAD
			<div class="col-xs-12 col-sm-offset-4 col-sm-4 col-md-offset-4 col-md-4 quit-padding-right">
				<div class="card card-container">
					<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
					<p id="profile-name" class="profile-name-card"></p>
					<form class="form-signin">
						<span id="reauth-email" class="reauth-email"></span>
						<input type="text" id="username" class="form-control" placeholder="Username" required autofocus>
						<input type="password" id="password" class="form-control" placeholder="Password" required>
						<div id="remember" class="checkbox">
							<label>
								<input type="checkbox" value="remember-me"> Remember me
							</label>
						</div>
						<button class="btn btn-lg btn-primary btn-block btn-signin login" type="button" id="login">Sign in</button>
						<a href="#" class="forgot-password">Forgot the password?</a>
						<div id="message"></div>
					</form>
				</div>
=======
			<div class="col-md-offset-4 col-md-4 card card-container">
				<img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
				<p id="profile-name" class="profile-name-card"></p>
				<form class="form-signin">
					<span id="reauth-email" class="reauth-email"></span>
					<input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
					<input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
					<div id="remember" class="checkbox">
						<label>
							<input type="checkbox" value="remember-me"> Remember me
						</label>
					</div>
					<button class="btn btn-lg btn-primary btn-block btn-signin login" type="submit">Sign in</button>
					<a href="#" class="forgot-password">Forgot the password?</a>
				</form>
>>>>>>> origin/master
			</div>
		</div>
	</div>
</body>
</html>