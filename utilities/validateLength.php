<?php

	function validateLength($value, $maxLength) {

		$correct = false;

		if (strlen($value) <= $maxLength) {
			$correct = true;
		}

		return $correct;
	}

?>