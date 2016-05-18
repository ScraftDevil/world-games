<?php

	include("validateInputNullController.php");
	include("validateEmailController.php");
	include("validateDateController.php");

	function validateInputs($id, $email, $birthdate, $paypal, $image, $country, $errors) {

	$registered = unserialize($_SESSION['registered']);

	//Email validation
	// Aunque este vacía, coge por defecto la fecha 1970-01-01
	if(nullInputValidate($email)) {
		if (!validateEmail($email)) {
			//$newEmail = $email;
			//$newEmail = $registered->getEmail();
			array_push($errors, "El correo introducido no es válido");
		}
	}
	else {
		//$newEmail = $registered->getEmail();
		array_push($errors, "Debes introducir un correo electrónico");
	}

	//Falla la comprobacion de si es null o no, ya que por defecto coge el valor 1970-01-01
	if(nullInputValidate($birthdate)) {
		if (!validateDate($birthdate)) {
			array_push($errors, "No puedes introducir una fecha posterior a hoy!");
		}
	}
	else {
		array_push($errors, "Debes introducir una fecha");
	}

	//PaypalAccount validation
	if(nullInputValidate($paypal)) {
		if (!validateEmail($paypal)) {
			array_push($errors, "El correo introducido no es válido");
		}
	}

	//Image validation (validación en desarrollo)
	/*if(nullInputValidate($image)) {
		$newImage = $image;
	}
	else {
		$newImage = "";
	}*/

	return $errors;


	############### ------------------------------ ###############
	/* VERSION BETA FUNCIONANDO EXCEPTO QUE ACTUALIZA AUNQUE HAYA UN ERROR */
	############### ------------------------------ ###############
	//Email validation
	/*if(nullInputValidate($email)) {
		if (validateEmail($email)) {
			$newEmail = $email;
		} else {
			$newEmail = $registered->getEmail();
		}
	}
	else {
		$newEmail = $registered->getEmail();
	}

	//BirthDate validation
	if(nullInputValidate($birthdate)) {
		if (validateDate($birthdate)) {
			$newBirthDate = $birthdate;
		} else {
			$newBirthDate = $registered->getBirthDate();
		}
	}
	else {
		$newBirthDate = $registered->getBirthDate();
	}

	//PaypalAccount validation
	if(nullInputValidate($paypal)) {
		if (validateEmail($paypal)) {
			$newPaypalAccount = $paypal;
		} else {
			$newPaypalAccount = $registered->getPaypalAccount();
		}
	}
	else {
		$newPaypalAccount = "";
	}

	//Image validation (validación en desarrollo)
	if(nullInputValidate($image)) {
		$newImage = $image;
	}
	else {
		$newImage = "";
	}

	$registered = new Registered('', '', $newEmail, $newBirthDate, $country);
	$registered->setId($id);
	$registered->setPaypalAccount($newPaypalAccount);
	$registered->setAvatarURL($newImage);

	return $registered;*/

	}

?>