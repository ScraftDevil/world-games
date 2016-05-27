<?php

	function validatePassword($password) {
		$correct = false;
		if ($password != null && $password != "") {
			if (strlen($password) >= 6 && strlen($password) <= 20) {
				$correct = true;
			} else {
				array_push($_SESSION['msg'], "¡La contraseña debe tener una logitud entre 6 y 20 carácteres!");
			}
		} else {
			array_push($_SESSION['msg'], "¡La contraseña no puede estar vacía!");
		}
		return $correct;
	}

?>