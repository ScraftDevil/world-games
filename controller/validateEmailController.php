<?php

	function validateEmail($email) {
		$correct = false;

		/* Email regular expression */
		$emailSintax = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';

		if (preg_match($emailSintax, $email)) {
			$correct = true;
		}

		return $correct;
	}

?>