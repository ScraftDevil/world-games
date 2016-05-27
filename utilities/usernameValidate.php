<?php

	function validateUsername($username) {
		$correct = false;

		$usernameRegex = '/[~_@#$^*()+=[\]{}|\\,.?¿¡!;:<>´`^ áàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜ]/';

		if ($username != null && $username != "") {
			if (preg_match($usernameRegex, $username) == 0) {
				if (strlen($username) >= 3 && strlen($username) <= 20) {
					$correct = true;
				} else {
					array_push($_SESSION['msg'], "username" => "¡El nombre de usuario debe tener una longitud entre 3 y 20 carácteres!");
				}
			} else {
				array_push($_SESSION['msg'], "username" => "¡El nombre de usuario contiene carácteres especiales!");
			}
		} else {
			array_push($_SESSION['msg'], "username" => "¡El nombre de usuario esta vacío!");
		}

		return $correct;
	}

?>