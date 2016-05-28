<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['game'];

	$game = json_decode($post);

	

	

	function updateRegistered($registered) {
		if ($registered->getUsername() != "" AND $registered->getPassword() != "" AND $registered->getEmail() != "" AND $registered->getBirthdate() != "" AND $registered->getCountry() != "") {
				$db = unserialize($_SESSION['dbconnection']);
				$proces = $db->updateAllRegisteredUser($registered);
		} else {
			$proces = "null";
		}
		return $proces;
	}

	

	function validateDateFormat($date) {

		$correct = false;

		/* Date regular expression */
		$dateSintax = '/[0-9]{2}\-[0-9]{2}\-[0-9]{4}/';


		if (preg_match($dateSintax, $date)) {
			$correct = true;
		}

		return $correct;

	}

	function validateEmail($email) {
		$correct = false;

		/* Email regular expression */
		$emailSintax = '/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/';

		if (preg_match($emailSintax, $email)) {
			$correct = true;
		}

		return $correct;
	}

	/*function messages($proces, $group) {
		$response = null;
		switch($proces) {
			case "success":
			$response = array("id" => "success", "group" => $group);
			break;

			case "username":
			$response = array("id" => "username-error", "group" => $group);
			break;

			case "email":
			$response = array("id" => "email-error", "group" => $group);
			break;

			case "null":
			$response = array("id" => "null-error", "group" => $group);
			break;

			default:
			$response = array("id" => "error", "group" => $group);
			break;
		}
		return $response;
	}*/

	echo json_encode($response);

?>