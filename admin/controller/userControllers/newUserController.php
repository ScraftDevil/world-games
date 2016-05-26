<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['user'];

	$user = json_decode($post);

	$group = $user->group;

	if ($group == "registered" || $group == "professional" || $group == "administrator") {
		$username = $user->username;
		$password = $user->password;
		$email = $user->email;
		$birthdate = $user->birthdate;
		switch ($group) {
			case 'registered':
				$country = $user->country;
				$proces = addRegistered($username, $password, $email, $birthdate, $country);
				$response = messages($proces, $group);
			break;

			case 'professional':
				$proces = addProfessional();
				if ($proces == 0) {
					//header("Location:../view/newUserView.php?group=".$group."&msg=fail");
				} else if ($proces == 1) {
					//header("Location:../view/userListView.php?group=".$group."&msg=errusername");
				} else {
					//header("Location:../view/userListView.php?group=".$group."&msg=success");
				}
			break;

			case 'administrator':
				$proces = addAdministrator();
				if ($proces == 0) {
					//header("Location:../view/newUserView.php?group=".$group."&msg=fail");
				} else if ($proces == 1) {
					//header("Location:../view/userListView.php?group=".$group."&msg=errusername");
				} else {
					//header("Location:../view/userListView.php?group=".$group."&msg=success");
				}
			break;			
		}
	} else {
		//header("Location:../index.php");
	}


	function addRegistered($username, $password, $email, $birthdate, $country) {
		if ($username != "" AND $password != "" AND $email != "" AND $birthdate != "" AND $country != "") {
				$errors = validateRegisteredFields($username, $password, $email, $birthdate, $country);	
				if ($errors == 0) {
					$birthdate = date('Y-m-d', strtotime($birthdate));
					$registered = new Registered($username, $password, $email, $birthdate, $country);
					$proces = $registered->insertRegistered();
				} else {
					$proces = "invalid-fields";
				}
		} else {
			$proces = "null";
		}
		return $proces;
	}

	function addProfessional() {
		$proces = 0;
		if (isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['email']) AND isset($_POST['birthdate'])) {
			if (!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['email']) AND !empty($_POST['birthdate'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				$birthdate = $_POST['birthdate'];
				$birthdate = date('Y-m-d', strtotime($birthdate));
				$professional = new Professional($username, $password, $email, $birthdate);
				$proces = $professional->insertProfessional();
			}
		}
		return $proces;
	}

	function addAdministrator() {
		$proces = 0;
		if (isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['email']) AND isset($_POST['birthdate'])) {
			if (!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['email']) AND !empty($_POST['birthdate'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				$birthdate = $_POST['birthdate'];
				$birthdate = date('Y-m-d', strtotime($birthdate));
				$administrator = new Administrator($username, $password, $email, $birthdate);
				$proces = $administrator->insertAdministrator();
			}
		}
		return $proces;
	}

	function validateRegisteredFields($username, $password, $email, $birthdate, $country) {
		$errors = 0;
		if (validateUsername($username) == false || validateEmail($email) == false || validateDate($birthdate) == false) {
			$errors = $errors + 1;
		}
		return $errors;
	}

	function validateDate($date) {

		$db = unserialize($_SESSION['dbconnection']);
		$thisDate = $db->getThisDate();

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

		if (preg_match($usernameRegex, $username) == 0) {
			$correct = true;
		}

		return $correct;
	}

	function messages($proces, $group) {
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

			case "invalid-fields":
			$response = array("id" => "invalid-fields", "group" => $group);
			break;

			default:
			$response = array("id" => "error", "group" => $group);
			break;
		}
		return $response;
	}

	echo json_encode($response);

?>