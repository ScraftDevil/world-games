<?php

	$username = $_POST['username'];

	require_once("../../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	if (isset($_POST['username']) AND isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$admin = new administratorDAO();
		$valid = $admin->login($username, $password);
		if ($valid) {
			$_SESSION['adminAuth'] = true;
			header("Location: ../index.php");
		} else {
			header("Location: ../view/adminLoginView.php?MSGCODE=invalid_pass");
		}		
	}

?>