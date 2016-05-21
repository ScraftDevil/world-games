<?php

	include("validateInputNullController.php");
	include("validateEmailController.php");

	function sendMessageValidation($email, $message) {

		$errors = 0;

		//Email validation
		if(nullInputValidate($email)) {
			if (!validateEmail($email)) {
				$errors++;
			}
		}
		else {
			$errors++;
		}

		//Message validation
		if(!nullInputValidate($message)) {
			$errors++;
		}

		return $errors;
	}

?>