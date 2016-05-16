<?php

	// controlador de conversion de fecha. Convierte de "y/m/d" a "d/m/y"
	include("dateConversionController.php");

	function validateDate($date) {

		$dateSelected = dateConversion($date);
		$actualDate = dateConversion(date('Y-m-d'));

		$valid = false;

		if ($dateSelected <= $actualDate) {
			$valid = true;
		}

		return $valid;

	}

?>