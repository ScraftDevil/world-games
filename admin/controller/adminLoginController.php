<?php

	require_once("../../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	if (isset($_POST['username']) AND isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db = unserialize($_SESSION['dbconnection']);
		$valid = json_decode($db->adminLogin($username, $password), true);
		if ($valid['ID'] != null) {
			$user = array("session" => true, "username" => $username, "ID" => $valid['ID'], "group" => $valid['Group']);
			$_SESSION['adminAuth'] = json_encode($user);
			header("Location: ../index.php");
		} else {
			header("Location: ../view/adminLoginView.php?MSGCODE=invalid_pass");
		}		
	}

?>