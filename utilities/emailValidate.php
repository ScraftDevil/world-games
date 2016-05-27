<?php

	function validateEmail($email) {
		$correct = false;

		/* Email regular expression */
		$emailSintax = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';
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