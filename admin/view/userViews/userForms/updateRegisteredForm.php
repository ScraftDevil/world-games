<form id="update-registered">
	<div id="general-error"></div>
	<div class="form-group">
		<label for="username">Nombre de Usuario</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
		<div class="input-group input-radius">
			<input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $name; ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="password">Contraseña</label>
		<div class="input-group input-radius">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" required><span class="server-error"></span>
		</div>
	</div>
	<div class="form-group">
		<label for="email">Email</label><label for="email-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
		<div class="input-group input-radius">
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="bannedtime">Tiempo de Baneo</label>
		<div class="input-group input-radius">
			<input type="text" class="form-control" id="bannedtime" name="bannedtime" placeholder="Tiempo de Baneo" value="<?php echo $bannedtime ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="birthdate">Fecha de Nacimiento</label><label for="birthdate-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
		<div class="input-group input-radius">
			<input type="text" class="form-control" id="calendar" name="birthdate" placeholder="Birthdate" value="<?php echo $birthdate ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="paypal">Paypal</label>
		<div class="input-group input-radius">
			<input type="email" class="form-control" id="paypal" name="paypal" placeholder="Paypal Email" value="<?php echo $paypal ?>" required>
		</div>
	</div>
	<div class="form-group">
		<label for="avatar">Avatar</label><label for="avatar-error"></label>
		<?php
		if ($avatar == "avatar.png") {
			$path = "../../../view/resources/images/avatars/".$_POST['user']."/".$avatar;
			?>
			<div class="avatar-url">
				<img id="img" src="<?php echo $path ?>" />
			</div>
			<div class="delete-avatar">
				<button class="btn btn-danger" id="avatar" value="yes" type="button" id="deleteAvatar">Borrar Avatar</button>
			</div>
				<?php
			} else {
				$path = "../../../view/resources/images/avatars/default.png";
				?>	
				<div class="avatar-url">
					<img id="img" src="<?php echo $path ?>" />
				</div>
			<?php
		}
		?>
	</div>
	<div class="form-group">
		<label for="country">País</label><label for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
		<?php include("../sections/countryListWithSelected.php"); ?>
	</div>
	<div class="form-group">
		<button type="button" name="update-userregistered" id="update-userregistered" class="btn btn-info pull-left">Enviar</button>
	</div>
</form>