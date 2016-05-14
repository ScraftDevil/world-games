<?php

	function validateInputs($username, $password, $email, $paypal, $image) {

	$registered = unserialize($_SESSION['registered']);

	$newName = setInputsNameValue($username, $registered);
	$newPassword = setInputPasswordValues($password, $registered);
	$newEmail = setInputEmailValues($email, $registered);
	$newPaypalAccount = setInputPaypalAccountValues($paypal, $registered);
	$newImage = setInputImageValues($image, $registered);

	echo $newName;
	echo $newPassword;
	echo $newEmail;
	echo $newPaypalAccount;
	echo $newImage;

	}

	function setInputsNameValue($username, $registered) {

		if ($username == null) {
			$username = $registered->getUsername();
		}

		return $username;
	}

	function setInputPasswordValues($password, $registered) {

		if ($password == null) {
			$password = $registered->getPassword();
		}

		return $password;
	}


	function setInputEmailValues($email, $registered) {

		if ($email == null) {
			$email = $registered->getEmail();
		}

		return $email;
	}

	function setInputPaypalAccountValues($paypal, $registered) {

		if ($paypal == null) {
			$paypal = $registered->getPaypalAccount();
		}

		return $paypal;
	}

	function setInputImageValues($image, $registered) {

		if ($image == null) {
			$image = $registered->getAvatarUrl();
		}

		return $image;
	}


	// Funcion que verifica si el input del perfil del usuario está vacío. Si lo está, 
	// devuelve lo que tiene de valor en la BBDD. Si no está vacío, devuelve el valor introducido.
	// Este método está preparado para usarse de forma modular para cualquier atributo, 
	// siempre que se le indique el atributo $atributeName de forma manual al llamar al método, 
	// ya que no todos los atributos siguen el mismo patrón	
	// FALLA SOLO CUANDO EL CAMPO ESTÁ VACÍO
	/*function setInputsValues($value, $registered, $atributeName) {

		if ($value == null) {
			//$value = $registered->get.$atributeName.();
		}

		return $value;

	}*/

?>