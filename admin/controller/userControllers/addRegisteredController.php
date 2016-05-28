<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	function addRegistered($username, $password, $email, $birthdate, $country) {
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->addRegistered($username, $password, $email, $birthdate, $country);
		$_SESSION['shop'] = serialize($shop);
		return $proces;
	}

?>