<?php

	function validateUsername($username) {
		$correct = false;

		$usernameRegex = '/[~_@#$^*()+=[\]{}|\\,.?¿¡!;:<>´`^ áàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜ]/';

		if (preg_match($usernameRegex, $username) == 0) {
			if (strlen($username) >= 3 && strlen($username) <= 20) {
				$correct = true;
			}
		}

		return $correct;
	}

?>