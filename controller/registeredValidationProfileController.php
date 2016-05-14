<?php

	include("validateEmailController.php");
	include("validateNullnputsProfileController.php");

	function validateInputs($id, $username, $password, $email, $paypal, $image) {

	$registered = unserialize($_SESSION['registered']);

	$newName = setInputsNameValue($username, $registered);
	$newPassword = setInputPasswordValues($password, $registered);

	if (validateEmail($email)) {
		echo "correcto";
		$newEmail = setInputEmailValues($email, $registered);	
	}
	else {
		echo "email incorrect";
	}
	
	$newPaypalAccount = setInputPaypalAccountValues($paypal, $registered);
	$newImage = setInputImageValues($image, $registered);

	$registered = new Registered($newName, $newPassword, $newEmail, $birthdate, '');
	$registered->setId($id);
	$registered->setPaypalAccount($newPaypalAccount);
	$registered->setAvatarURL($newImage);

	return $registered;

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