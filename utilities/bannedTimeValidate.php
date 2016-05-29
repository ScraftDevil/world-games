<?php

	function validateBannedTime($bannedtime) {
		$correct = false;

		if ($bannedtime != null && $bannedtime != "") {
			if (is_numeric($bannedtime)) {
				$num = intval($bannedtime);
				if (is_int($num)) {
					$correct = true;
				} else {
					array_push($_SESSION['msg'], "¡El tiempo de baneo no es un número entero!");
				}
			} else {
				array_push($_SESSION['msg'], "¡El tiempo de baneo no es un número!");
			}
		} else {
			array_push($_SESSION['msg'], "¡El tiempo de baneo esta vacío!");
		}

		return $correct;
	}

?>