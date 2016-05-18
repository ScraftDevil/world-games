<?php

	include("validateInputNullController.php");
	include("validateEmailController.php");
	include("validateDateController.php");

	function validateInputs($id, $email, $birthdate, $paypal, $image, $country, $errors) {

	$registered = unserialize($_SESSION['registered']);


	//Email validation
	if(nullInputValidate($email)) {
		if (!validateEmail($email)) {
			$errors++;
		}
	}
	else {
		$errors++;
	}

	//BirthDate validation
	if(nullInputValidate($birthdate) AND $birthdate != '1970-01-01') {
		if (!validateDate($birthdate) AND !validateDateFormat($birthdate)) {
			$errors++;
		}
	}
	else {
		$errors++;
	}

	//PaypalAccount validation
	if(nullInputValidate($paypal)) {
		if (!validateEmail($paypal)) {
			$errors++;
		}
	}

	//Image validation (validación en desarrollo)

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