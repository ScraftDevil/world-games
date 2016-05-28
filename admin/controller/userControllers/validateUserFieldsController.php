<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");
	
	include($_SESSION["BASE_PATH"]."/utilities/usernameValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/passwordValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/emailValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/dateValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/countryValidate.php");

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