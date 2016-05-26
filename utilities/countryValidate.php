<?php

	function validateCountry($country) {
		$correct = false;

		$db = unserialize($_SESSION['dbconnection']);

		$correct = $db->existCountry($country);

		return $correct;
	}

?>