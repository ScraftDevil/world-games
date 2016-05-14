<?php
	
	function setInputEmailValue($email, $registered) {

		if ($email == null) {
			$email = $registered->getEmail();
		}

		return $email;
	}

	function setInputBirthDateValue($birthdate, $registered) {

		if ($birthdate == null) {
			$birthdate = $registered->getBirthDate();
		}

		return $birthdate;
	}

	function setInputPaypalAccountValue($paypal, $registered) {

		if ($paypal == null) {
			$paypal = $registered->getPaypalAccount();
		}

		return $paypal;
	}

	function setInputImageValue($image, $registered) {

		if ($image == null) {
			$image = $registered->getAvatarUrl();
		}

		return $image;
	}
	
?>