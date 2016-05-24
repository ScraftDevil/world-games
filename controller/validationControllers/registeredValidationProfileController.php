<?php

	include("validateInputNullController.php");
	include("validateEmailController.php");
	include("validateDateController.php");

	function validateInputs($email, $birthdate, $paypal, $image, $country) {

	$registered = unserialize($_SESSION['registered']);

	$errors = 0;

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

	}

?>