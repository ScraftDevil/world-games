<?php

	function validateInputs($username, $password, $email, $paypal, $image) {

	$registered = unserialize($_SESSION['registered']);

	$nom = setInputsValues($username, $registered, 'Username');
	echo $nom;

		/*if ($username != null) {			
			echo $username;			
		} else {
			$username = $registered->getUsername();
			echo $username;
		}

		if ($password != null) {			
			echo $password;			
		} else {
			$password = $registered->getPassword();
			echo $password;
		}*/

	}

	function setInputsValues($username, $registered) {

		if ($username == null) {			
			$username = $registered->getUsername();
		}

		return $username;
	}

?>