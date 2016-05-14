<?php

	function validateEmail($email) {
		$correct = false;

		$emailSintax = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';

		if (preg_match($emailSintax, $email)) {
			$correct = true;
		}

		return $correct;
	}

?>