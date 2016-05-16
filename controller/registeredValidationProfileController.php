<?php

	include("validateInputNullController.php");
	include("validateEmailController.php");
	include("validateDateController.php");

	function validateInputs($id, $email, $birthdate, $paypal, $image, $country) {

	$registered = unserialize($_SESSION['registered']);

	//Email validation
	if(nullInputValidate($email)) {
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

	return $registered;

	}

?>