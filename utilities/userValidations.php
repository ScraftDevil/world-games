<?php

	function validateRegisteredFields($username, $password, $email, $birthdate, $country) {
		$errors = 0;
		if (validateUsername($username) == false || validatePassword($password) == false || validateEmail($email) == false || validateDate($birthdate) == false || validateCountry($country) == false) {
			$errors = 1;
		} else {
			$errors = 0;
		}
		return $errors;
	}

	function validateAdminProfessionalFields($username, $password, $email, $birthdate) {
		$errors = 0;
		if (validateUsername($username) == false || validatePassword($password) == false || validateEmail($email) == false || validateDate($birthdate) == false) {
			$errors = 1;
		} else {
			$errors = 0;
		}
		return $errors;
	}

?>