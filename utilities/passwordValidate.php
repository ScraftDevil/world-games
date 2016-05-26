<?php

	function validatePassword($password) {
		$correct = false;
		if (strlen($password) >= 6 && strlen($password) <= 20) {
			$correct = true;
		} else {
			$correct = false;
		}
		return $correct;
	}

?>