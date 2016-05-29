<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");
	
	include($_SESSION["BASE_PATH"]."/utilities/usernameValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/passwordValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/emailValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/dateValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/countryValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/bannedTimeValidate.php");

	function validateRegisteredInsertFields($username, $password, $email, $birthdate, $country) {
		$errors = 0;
		if (validateUsername($username) == false) {
			$errors++;
		}
		if (validatePassword($password) == false) {
			$errors++;
		}
		if (validateEmail($email) == false) {
			$errors++;
		}
		if (validateDate($birthdate) == false) {
			$errors++;
		}
		if (validateCountry($country) == false) {
			$errors++;
		}
		return $errors;
	}

	function validateRegisteredUpdateFields($username, $password, $email, $bannedtime, $birthdate, $paypal, $avatar, $country) {
		$errors = 0;
		if (validateUsername($username) == false) {
			$errors++;
		}
		if ($password != null && $password != "") {
			if (validatePassword($password) == false) {
				$errors++;
			}
		}
		if (validateEmail($email) == false) {
			$errors++;
		}
		if ($bannedtime != null && $bannedtime != "") {
			if (validateBannedTime($bannedtime) == false) {
				$errors++;
			}
		}
		if (validateDate($birthdate) == false) {
			$errors++;
		}
		if ($paypal != null && $paypal != "") {
			if (validateEmail($paypal) == false) {
				$errors++;
			}
		}
		if ($avatar != null && $avatar != "") {
			if ($avatar != "yes" && $avatar != "no") {
				$errors++;
				array_push($_SESSION['msg'], "¡Estado de avatar incorrecto!");
			}
		}
		if (validateCountry($country) == false) {
			$errors++;
		}
		return $errors;
	}

	function validateProfessionalUpdateFields($username, $password, $email, $bannedtime, $birthdate, $phone) {
		$errors = 0;
		if (validateUsername($username) == false) {
			$errors++;
		}
		if ($password != null && $password != "") {
			if (validatePassword($password) == false) {
				$errors++;
			}
		}
		if (validateEmail($email) == false) {
			$errors++;
		}
		if ($bannedtime != null && $bannedtime != "") {
			if (validateBannedTime($bannedtime) == false) {
				$errors++;
			}
		}
		if (validateDate($birthdate) == false) {
			$errors++;
		}
		if ($phone != null && $phone != "") {
			if(validatePhone($phone)) {
				$errors++;
			}
		}
		return $errors;
	}

	function validateAdminProfessionalInsertFields($username, $password, $email, $birthdate) {
		$errors = 0;
		if (validateUsername($username) == false) {
			$errors++;
		}
		if (validatePassword($password) == false) {
			$errors++;
		}
		if (validateEmail($email) == false) {
			$errors++;
		}
		if (validateDate($birthdate) == false) {
			$errors++;
		}
		return $errors;
	}

?>