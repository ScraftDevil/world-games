<?php

	function validateDate($date) {
		$correct = false;
		if ($date != null && $date != "") {
			if (validateDateFormat($date) == true) {
				if (validateFutureDate($date) == true) {
					$correct = true;
				} else {
					array_push($_SESSION['msg'], "¡La fecha es una fecha futura!");
				}
			} else {
				array_push($_SESSION['msg'], "¡Fecha con formato incorrecto!");
			}
		} else {
			array_push($_SESSION['msg'], "¡La fecha de cumpleaños no puede estar vacía!");
		}
		return $correct;
	}


	/* Date validation (returns if a date is future or not) */
	function validateFutureDate($date) {


		$actualDate = date("Y-m-d");
		$dateSelected = date("Y-m-d", strtotime($date));

		$valid = false;

		if ($dateSelected <= $actualDate) {
			if ($actualDate != "1970-01-01") {
				$valid = true;
			}
		}

		return $valid;

	}

	/* Date format validation. Returns if a date is in dd-mm-yyyy format or not */
	function validateDateFormat($date) {

		$correct = false;

		/* Date regular expression */
		$dateSintax = '/[0-9]{2}\-[0-9]{2}\-[0-9]{4}/';


		if (preg_match($dateSintax, $date) && strlen($date) == 10) {
			$correct = true;
		}

		return $correct;

	}

?>