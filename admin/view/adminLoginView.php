<!DOCTYPE html>
<html>
<?php include("sections/head.php"); ?>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-offset-4 col-md-4">
				<div class="card card-container">
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
				</div>
			</div>
		</div>
	</div>
</body>
</html>