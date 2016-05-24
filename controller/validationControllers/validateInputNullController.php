<?php

session_start();

	/* Input null validation */
	function nullInputValidate($value) {
		$valid = true;

		if ($value == "") {
			$valid = false;
		}		

		return $valid;
	}
	
?>