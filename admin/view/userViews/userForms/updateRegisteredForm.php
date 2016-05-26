<form id="registered-user">
	<div class="row">
		<div class="col-md-12">
			<div id="general-error"></div>
			<div class="form-group">
				<label for="username">Nombre de Usuario</label><label for="user-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
				<div class="input-group input-radius">
					<input type="text" class="form-control" name="username" id="username" placeholder="Username" required><span id="user-error" class="server-error"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="password">Contraseña</label><label for="password-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
				<div class="input-group input-radius">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" required><span class="server-error"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="email">Email</label><label for="email-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
				<div class="input-group input-radius">
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" required><span class="server-error"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="bannedtime">Tiempo de Baneo</label><label for="bannedtime-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
				<div class="input-group input-radius">
					<input type="text" class="form-control" id="bannedtime" name="bannedtime" placeholder="Tiempo de Baneo" required><span class="server-error"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="birthdate">Fecha de Nacimiento</label><label for="birthdate-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
				<div class="input-group input-radius">
					<input type="text" class="form-control" id="calendar" name="birthdate" placeholder="Birthdate" required><span class="server-error"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="paypal">Paypal</label><label for="paypal-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
				<div class="input-group input-radius">
					<input type="email" class="form-control" id="paypal" name="paypal" placeholder="Paypal Email" required><span class="server-error"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="avatar">Avatar</label><label for="avatar-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
				<div class="input-group input-radius">
					<input type="file" class="form-control" id="avatar" name="avatar" placeholder="Avatar" required><span class="server-error"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="country">País</label><label for="country-error"> (<span class="glyphicon glyphicon-asterisk"></span>)</label>
				<?php include("../sections/countryList.php"); ?><span class="server-error"></span>
			</div>
			<div class="form-group">
				<button type="button" name="update-user" id="update-user" class="btn btn-info pull-left">Enviar</button>
			</div>
		</div>
	</div>
</form>