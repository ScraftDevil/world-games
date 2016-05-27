<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");
	
	include($_SESSION["BASE_PATH"]."/utilities/usernameValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/passwordValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/emailValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/dateValidate.php");
	include($_SESSION["BASE_PATH"]."/utilities/countryValidate.php");

	function validateRegisteredFields($username, $password, $email, $birthdate, $country) {
		$errors = 0;
		if (validateUsername($username) == false || validatePassword($password) == false || validateEmail($email) == false || validateDate($birthdate) == false || validateCountry($country) == false) {
			$errors = 1;
		} else {
			$errors = 0;
		}
		return $errors;
	}

?>