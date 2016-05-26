<?php

	function validateDate($date) {

		$thisDate = date("d-m-Y");

		$correct = false;

		/* Date regular expression */
		$dateSintax = '/[0-9]{2}\-[0-9]{2}\-[0-9]{4}/';


		if (preg_match($dateSintax, $date) == 1 AND $date < $thisDate) {
			$correct = true;
		}

		return $correct;

	}

	function validateEmail($email) {
		$correct = false;

		/* Email regular expression */
		$emailSintax = '/@.+\./';

		if (preg_match($emailSintax, $email) == 1) {
			$correct = true;
		}

		return $correct;
	}

	function validateUsername($username) {
		$correct = false;

		$usernameRegex = '/[~_@#$^*()+=[\]{}|\\,.?¿¡!;:<>´`^ áàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜ]/';

		if (preg_match($usernameRegex, $username) == 0 AND strlen($username) <= 20) {
			$correct = true;
		}

		return $correct;
	}

?>