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
		$id = $user->id;
		$username = $user->username;
		$password = $user->password;
		$email = $user->email;
		$bannedtime = $user->bannedtime;
		$birthdate = $user->birthdate;
		$birthdate = date('Y-m-d', strtotime($birthdate));
		switch ($group) {
			case 'registered':
				$paypal = $user->paypal;
				$avatar = $user->avatar;
				$country = $user->country;
				$registered = new Registered($username, $password, $email, $birthdate, $country);
				$registered->setID($id);
				$registered->setBannedTime($bannedtime);
				$registered->setPaypalAccount($paypal);
				$registered->setAvatarUrl($avatar);
				$proces = updateRegistered($registered);
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


	function updateRegistered($registered) {
		if ($registered->getUsername() != "" AND $registered->getPassword() != "" AND $registered->getEmail() != "" AND $registered->getBirthdate() != "" AND $registered->getCountry() != "") {
				$db = unserialize($_SESSION['dbconnection']);
				$proces = $db->updateAllRegisteredUser($registered);
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

			default:
			$response = array("id" => "error", "group" => $group);
			break;
		}
		return $response;
	}

	echo json_encode($response);

?>