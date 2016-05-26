<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");
	
	include("userValidations.php");

	function addRegistered($username, $password, $email, $birthdate, $country) {
		$errors = null;
		if ($username != "" && $password != "" && $email != "" && $birthdate != "" && $country != "") {
				$errors = validateRegisteredFields($username, $password, $email, $birthdate, $country);
				if ($errors == 0) {
					$birthdate = date('Y-m-d', strtotime($birthdate));
					$registered = new Registered($username, $password, $email, $birthdate, $country);
					$proces = $registered->insertRegistered();
				} else {
					$proces = "invalid-fields";
				}
		} else {
			$proces = "null";
		}
		return $proces;
	}

?>