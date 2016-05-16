<?php

session_start();

	/* Input null validation */
	function nullInputValidate($value) {
		$valid = true;

		if ($value == null) {
			$valid = false;
		}

		return $valid;
	}
	
?>