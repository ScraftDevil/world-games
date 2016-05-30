<?php

	function validateEmail($email) {
		$correct = false;

		/* Email regular expression */
		$emailSintax = '/^([a-zA-Z0-9_\.-]+)@([\da-zA-Z\.-]+)\.([a-zA-Z\.]{2,6})$/';
		if ($email != null && $email != "") {
			if (preg_match($emailSintax, $email)) {
				$correct = true;
			} else {
				array_push($_SESSION['msg'], "¡El email tiene un formato incorrecto!");
			}
		} else {
			array_push($_SESSION['msg'], "¡El email esta vacío!");
		}
		return $correct;
	}

?>