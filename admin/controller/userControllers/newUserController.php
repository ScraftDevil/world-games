<?php

	include("../backAuthControllers/authController.php");

	include("validateRegisteredFieldsController.php");
	include("addRegisteredController.php");

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
				$errors = validateRegisteredFields($username, $password, $email, $birthdate, $country);
				if ($errors == 0) {
					$proces = addRegistered($username, $password, $email, $birthdate, $country);
					$response = messages($proces, $group);
				} else {
					$response = messages("invalid-fields", "registered");
				}
				
				
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

			case "invalid-fields":
			$response = array("id" => "invalid-fields", "errors" => $_SESSION['msg']);
			break;

			default:
			$response = array("id" => "error", "group" => $group);
			break;
		}
		return $response;
	}

	echo json_encode($response);

?>