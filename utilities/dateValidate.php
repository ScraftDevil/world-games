<?php

	// controlador de conversion de fecha. Convierte de "y/m/d" a "d/m/y"
	include("dateConversion.php");

	/* Date validation (returns if a date is future or not) */
	function validateDate($date) {

		$dateSelected = dateConversion($date);
		$actualDate = dateConversion(date('Y-m-d'));

		$valid = false;

		if ($dateSelected <= $actualDate) {
			$valid = true;
		}

		return $valid;

	}

	/* Date format validation. Returns if a date is in dd-mm-yyyy format or not */
	function validateDateFormat($date) {

		$correct = false;

		/* Date regular expression */
		$dateSintax = '/[0-9]{2}\-[0-9]{2}\-[0-9]{4}/';


		if (preg_match($dateSintax, $date)) {
			$correct = true;
		}

		return $correct;

	}

?>