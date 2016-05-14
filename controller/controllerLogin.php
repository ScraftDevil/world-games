<?php

	require_once("../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	$status = array();

	if (isset($_POST['username']) AND isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db = unserialize($_SESSION['dbconnection']);
		$userid = $db->registeredBackLogin($username, $password);
		if ($userid!=-1) {
			$_SESSION['frontAuth'] = true;
			$_SESSION['user_id'] = $userid;
			$status["STATUS"] = "LOGIN_OK";
		} else {
			$status["STATUS"] = "LOGIN_INVALID_INFO";
		}
	} else {
		 $status["STATUS"] = "LOGIN_INVALID_INFO";
	}

	echo json_encode($status);

?>