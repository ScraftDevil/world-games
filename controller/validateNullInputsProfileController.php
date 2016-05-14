<?php
	
	function setInputsNameValue($username, $registered) {

		if ($username == null) {
			$username = $registered->getUsername();
		}

		return $username;
	}

	function setInputPasswordValues($password, $registered) {

		if ($password == null) {
			$password = $registered->getPassword();
		}

		return $password;
	}


	function setInputEmailValues($email, $registered) {

		if ($email == null) {
			$email = $registered->getEmail();
		}

		return $email;
	}

	function setInputPaypalAccountValues($paypal, $registered) {

		if ($paypal == null) {
			$paypal = $registered->getPaypalAccount();
		}

		return $paypal;
	}

	function setInputImageValues($image, $registered) {

		if ($image == null) {
			$image = $registered->getAvatarUrl();
		}

		return $image;
	}
	
?>