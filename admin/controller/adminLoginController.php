<?php

	require_once("../../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	if (isset($_POST['username']) AND isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db = unserialize($_SESSION['dbconnection']);
		$valid = $db->adminBackLogin($username, $password);
		if ($valid) {
			$_SESSION['adminAuth'] = true;
			$_SESSION['user'] = $username;
			$_SESSION['user_id'] = $db->getAdminID($username, $password);
			$_SESSION['userType'] = "admin";
			header("Location: ../index.php");
		} else {
			$valid = $db->professionalBackLogin($username, $password);
			if ($valid) {
				$_SESSION['adminAuth'] = true;
				$_SESSION['user'] = $username;
				$_SESSION['user_id'] = $db->getProfessionalID($username, $password);
				$_SESSION['userType'] = "professional";
				header("Location: ../index.php");
			} else {
				header("Location: ../view/adminLoginView.php?MSGCODE=invalid_pass");
			}
		}		
	}

?>