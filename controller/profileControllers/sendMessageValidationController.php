<?php

	include("../../utilities/inputNullValidate.php");

	function sendMessageValidation($receiverName, $message) {

		$errors = 0;

		//Email validation
		if(!nullInputValidate($receiverName)) {
			$errors++;
		}

		//Message validation
		if(!nullInputValidate($message)) {
			$errors++;
		}

		return $errors;
	}

?>