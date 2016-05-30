<?php

	function validateTelephone($telephone) {
		
		$correct = false;

		/* Telephone regular expression */
		$telephoneSintax = '/[\d]{9}/';

		if (preg_match($telephoneSintax, $telephone) {
			$correct = true;
		}

		return $correct;
	}

?>