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

	function validateDate($date) {

		$thisDate = date("d-m-Y");

		$correct = false;

		/* Date regular expression */
		$dateSintax = '/[0-9]{2}\-[0-9]{2}\-[0-9]{4}/';


		if (preg_match($dateSintax, $date) == 1 && $date < $thisDate) {
			$correct = true;
		}

		return $correct;

	}

	function validateEmail($email) {
		$correct = false;

		$emailSintax = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';

		if (preg_match($emailSintax, $email) == 1) {
			$correct = true;
		}

		return $correct;
	}

	function validateUsername($username) {
		$correct = false;

		$usernameRegex = '/[~_@#$^*()+=[\]{}|\\,.?¿¡!;:<>´`^ áàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜ]/';

		if (preg_match($usernameRegex, $username) == 0) {
			if (strlen($username) >= 3 && strlen($username) <= 20) {
				$correct = true;
			}
		}

		return $correct;
	}

	function validateCountry($country) {
		$correct = false;

		$db = unserialize($_SESSION['dbconnection']);

		$correct = $db->existCountry($country);

		return $correct;
	}

	function validatePassword($password) {
		$correct = false;
		if (strlen($password) >= 6 && strlen($password) <= 20) {
			$correct = true;
		} else {
			$correct = false;
		}
		return $correct;
	}

?>