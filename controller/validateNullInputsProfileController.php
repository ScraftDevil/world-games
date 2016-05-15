<?php

include("validateEmailController.php");
	
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

		if ($birthdate == null) {
			$birthdate = $registered->getBirthDate();
		}

		return $birthdate;
	}

	function setInputPaypalAccountValue($paypal, $registered) {

		$newPaypalAccount = null;

		if ($paypal == null) {
			$newPaypalAccount = $registered->getPaypalAccount();
		}
		else {
			if (validateEmail($paypal)) {
				$newPaypalAccount = $paypal;
			}
			else {
				$newPaypalAccount = $registered->getEmail();
			}
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