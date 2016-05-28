<?php

	if (($_SESSION['userDataGrid']) == "administrator") {
		?> <form id="new-user-admin"> <?php
	} else if (($_SESSION['userDataGrid']) == "professional") {
		?> <form id="new-user-pro"> <?php
	}

?>

	<div id="general-error"></div>
	<div class="form-group">
		<label for="username">Nombre de Usuario</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
		<div class="input-group input-radius">
			<input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
		</div>
	</div>
	<div class="form-group">
		<label for="password">Contraseña</label><label for="password-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
		<div class="input-group input-radius">
			<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
		</div>
	</div>
	<div class="form-group">
		<label for="email">Email</label><label for="email-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
		<div class="input-group input-radius">
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
		</div>
	</div>
	<div class="form-group">
		<label for="birthdate">Fecha de Nacimiento</label><label for="birthdate-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
		<div class="input-group input-radius">
			<input type="text" class="form-control" id="calendar" name="birthdate" placeholder="Birthdate" required>
		</div>
	</div>
	<div class="form-group">
		<?php

			if (($_SESSION['userDataGrid']) == "administrator") {
				?> <button type="button" name="insert-admin" id="insert-admin" class="btn btn-info pull-left">Enviar</button> <?php
			} else if (($_SESSION['userDataGrid']) == "professional") {
				?> <button type="button" name="insert-pro" id="insert-pro" class="btn btn-info pull-left">Enviar</button> <?php
			}

		?>
	</div>
</form>