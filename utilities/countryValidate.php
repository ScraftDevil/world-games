<?php

	function validateCountry($country) {
		$correct = false;

		$db = unserialize($_SESSION['dbconnection']);

		$correct = $db->existCountry($country);

		if ($correct == 0) {
			array_push($_SESSION['msg'], "¡El país seleccionado no existe!");
		}

		return $correct;
	}

?>