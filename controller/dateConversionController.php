<?php

	function dateConversion($date) {

		$day = substr($date, 8, 2);
		$month = substr($date, 5, 2);
		$year = substr($date, 0, 4);

		$dateConverted = (($year * 10000) + ($month * 100) + $day);

		return $dateConverted;

	}

?>