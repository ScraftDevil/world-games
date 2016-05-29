<?php

	include("../backAuthControllers/authController.php");

	require_once($_SESSION['BASE_PATH']."/model/autoload.php");

	include("validateUserFieldsController.php");

	// Variable de respuesta para json

	$response = "";

	$post = $_POST['user'];

	$user = json_decode($post);

	$users = $_SESSION['userDataGrid'];
	$_SESSION['msg'] = array();

	if ($users == "registered" || $users == "professional" || $users == "administrator") {
		$id = $_SESSION['selectedID'];
		$username = $user->username;
		$password = $user->password;
		$email = $user->email;
		$bannedtime = $user->bannedtime;
		$birthdate = $user->birthdate;
		switch ($users) {
			case 'registered':
				$paypal = $user->paypal;
				$avatar = $user->avatar;
				$country = $user->country;
				$errors = validateRegisteredUpdateFields($username, $password, $email, $bannedtime, $birthdate, $paypal, $avatar, $country);
				if ($errors == 0) {
					$proces = updateRegistered($id, $username, $password, $email, $bannedtime, $birthdate, $paypal, $avatar, $country);
					$response = messages($proces, $users);
				} else {
					$response = messages("invalid-fields", "registered");
				}
			break;

			case 'professional':
				$phone = $user->phone;
				$errors = validateProfessionalUpdateFields($username, $password, $email, $bannedtime, $birthdate, $phone);
				if ($errors == 0) {
					$proces = updateProfessional($id, $username, $password, $email, $bannedtime, $birthdate, $phone);
					$response = messages($proces, $users);
				} else {
					$response = messages("invalid-fields", "professional");
				}
			break;

			case 'administrator':
				$errors = validateAdministratorUpdateFields($username, $password, $email, $bannedtime, $birthdate);
				if ($errors == 0) {
					$proces = updateAdministrator($id, $username, $password, $email, $bannedtime, $birthdate);
					$response = messages($proces, $users);
				} else {
					$response = messages("invalid-fields", "administrator");
				}
			break;			
		}
	} else {
		//header("Location:../index.php");
	}

	
	function messages($proces, $users) {
		$response = null;
		switch($proces) {

			case "success":
				$response = array("id" => "success", "group" => $users);
				$_SESSION['msg'] = "u-success";
			break;

			case "username":
				$response = array("id" => "username-error", "group" => $users);
				$_SESSION['msg'] = "username-error";
			break;

			case "email":
				$response = array("id" => "email-error", "group" => $users);
				$_SESSION['msg'] = "email-error";
			break;

			case "invalid-fields":
				$response = array("id" => "invalid-fields", "errors" => $_SESSION['msg'], "group" => $users);
				unset($_SESSION['msg']);
			break;

			default:
				$response = array("id" => "error", "group" => $users);
			break;
		}
		return $response;
	}


	function updateRegistered($id, $username, $password, $email, $bannedtime, $birthdate, $paypal, $avatar, $country) {
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->updateAdminRegistered($id, $username, $password, $email, $bannedtime, $birthdate, $paypal, $avatar, $country);
		$_SESSION['shop'] = serialize($shop);
		return $proces;
	}

	function updateProfessional($id, $username, $password, $email, $bannedtime, $birthdate, $phone) {
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->updateAdminProfessional($id, $username, $password, $email, $bannedtime, $birthdate, $phone);
		$_SESSION['shop'] = serialize($shop);
		return $proces;
	}

	function updateAdministrator($id, $username, $password, $email, $bannedtime, $birthdate) {
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->updateAdminAdministrator($id, $username, $password, $email, $bannedtime, $birthdate);
		$_SESSION['shop'] = serialize($shop);
		return $proces;
	}

	echo json_encode($response);

?>