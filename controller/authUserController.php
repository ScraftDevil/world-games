<?php

	require_once("../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	if (isset($_POST['username']) AND isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db = unserialize($_SESSION['dbconnection']);
		$valid = $db->registeredLogin($username, $password);
		if ($valid != null) {
			$user = array("session" => true, "username" => $username, "ID" => $valid);
			$_SESSION['frontAuth'] = json_encode($user);
			header("Location: ../index.php");
		} else {
			header("Location: ../view/login.php?MSGCODE=invalid_pass");
		}		
	}

?>