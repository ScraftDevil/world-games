<?php

	session_start();

	include($_SESSION["BASE_PATH"]."/utilities/emailValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/dateValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/countryValidate.php");

	function registeredProfileUpdateValidations($email, $birthdate, $paypal, $image, $country) {

	$registered = unserialize($_SESSION['registered']);

	$errors = 0;

	//Email validation
	if(validateEmail($email) == false) {
		$errors++;		
	}

	//BirthDate validation
	if(validateDate($birthdate) == false) {
		$errors++;
	}

	//PaypalAccount validation
	if ($paypal != null) {
		if(validateEmail($paypal) == false) {
			$errors++;
		}
	}

	//Country validation
	/*if (validateCountry($country) == false) {
		$errors++;
	}*/

	//Image validation (validación en desarrollo)

	return $errors;

	}

?>