<?php

	include_once("userValidations.php");

	function addRegistered($username, $password, $email, $birthdate, $country) {
		if ($username != "" AND $password != "" AND $email != "" AND $birthdate != "" AND $country != "") {
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