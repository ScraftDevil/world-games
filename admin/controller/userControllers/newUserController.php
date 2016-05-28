<?php

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	include("../backAuthControllers/authController.php");

	include("validateUserFieldsController.php");

	$response = "";

	$post = $_POST['user'];

	$user = json_decode($post);

	$group = $_SESSION['userDataGrid'];

	$_SESSION['msg'] = array();

	if ($group == "registered" || $group == "professional" || $group == "administrator") {
		$username = $user->username;
		$password = $user->password;
		$email = $user->email;
		$birthdate = $user->birthdate;
		switch ($group) {
			case 'registered':
				$country = $user->country;
				$errors = validateRegisteredInsertFields($username, $password, $email, $birthdate, $country);
				if ($errors == 0) {
					$proces = addRegistered($username, $password, $email, $birthdate, $country);
					$response = messages($proces, $group);
				} else {
					$response = messages("invalid-fields", "registered");
				}
				
				
			break;

			case 'professional':
				$errors = validateAdminProfessionalInsertFields($username, $password, $email, $birthdate);
				if ($errors == 0) {
					$proces = addProfessional($username, $password, $email, $birthdate);
					$response = messages($proces, $group);
				} else {
					$response = messages("invalid-fields", "registered");
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


	function messages($proces, $group) {
		$response = null;
		switch($proces) {

			case "success":
				$response = array("id" => "success", "group" => $group);
				$_SESSION['msg'] = "i-success";
			break;

			case "username":
				$response = array("id" => "username-error", "group" => $group);
				$_SESSION['msg'] = "username-error";
			break;

			case "email":
				$response = array("id" => "email-error", "group" => $group);
				$_SESSION['msg'] = "email-error";
			break;

			case "invalid-fields":
				$response = array("id" => "invalid-fields", "errors" => $_SESSION['msg'], "group" => $group);
				unset($_SESSION['msg']);
			break;

			default:
				$response = array("id" => "error", "group" => $group);
			break;
		}
		return $response;
	}

	function addRegistered($username, $password, $email, $birthdate, $country) {
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->addRegistered($username, $password, $email, $birthdate, $country);
		$_SESSION['shop'] = serialize($shop);
		return $proces;
	}

	function addProfessional($username, $password, $email, $birthdate) {
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->addProfessional($username, $password, $email, $birthdate);
		$_SESSION['shop'] = serialize($shop);
		return $proces;
	}

	function addAdministrator($username, $password, $email, $birthdate) {
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->addProfessional($username, $password, $email, $birthdate);
		$_SESSION['shop'] = serialize($shop);
		return $proces;
	}

	echo json_encode($response);

?>