<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	function addRegistered($username, $password, $email, $birthdate, $country) {
		$birthdate = date('Y-m-d', strtotime($birthdate));
		$registered = new Registered($username, $password, $email, $birthdate, $country);
		$proces = $registered->insertRegistered();
		return $proces;
	}

?>