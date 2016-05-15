<?php

	include("validateEmailController.php");
	include("validateNullInputsProfileController.php");

	function validateInputs($id, $email, $birthdate, $paypal, $image) {

	$registered = unserialize($_SESSION['registered']);

	if (validateEmail($email)) {
		//echo "correcto";
		$newEmail = setInputEmailValue($email, $registered);
		echo $newEmail;
	}/*
	else {
		echo "email incorrect";
	}*/
	
	$newBirthDate = setInputBirthDateValue($birthdate, $registered);
	$newPaypalAccount = setInputPaypalAccountValue($paypal, $registered);
	$newImage = setInputImageValue($image, $registered);

	$registered = new Registered('', '', $newEmail, $newBirthDate, '');
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