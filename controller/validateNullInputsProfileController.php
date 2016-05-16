<?php

session_start();

include("validateEmailController.php");
include("validateDateController.php");
	
	function setInputEmailValue($email, $registered) {

		$newEmail = null;

		if ($email == null) {
			$newEmail = $registered->getEmail();
		}
		else {
			if (validateEmail($email)) {
				$newEmail = $email;
			}
			else {
				$newEmail = $registered->getEmail();
			}
		}

		return $newEmail;
	}

	function setInputBirthDateValue($birthdate, $registered) {

		$newBirthDate = null;

		if ($birthdate == null) {
			$newBirthDate = $registered->getBirthDate();
		}
		else {
			if (validateDate($birthdate)) {
				$newBirthDate = $birthdate;
			} else {
				$newBirthDate = $registered->getBirthDate();
			}
		}

		return $newBirthDate;
	}

	function setInputPaypalAccountValue($paypal, $registered) {

		$newPaypalAccount = null;

		if ($paypal != null) {
			if (validateEmail($paypal)) {
				$newPaypalAccount = $paypal;
			}
			else {
				$newPaypalAccount = $registered->getPaypalAccount();
			}
		}
		else {
			$newPaypalAccount = "";
		}

		return $newPaypalAccount;
	}

	function setInputImageValue($image, $registered) {

		if ($image == null) {
			$image = $registered->getAvatarUrl();
		}

		return $image;
	}
	
?>