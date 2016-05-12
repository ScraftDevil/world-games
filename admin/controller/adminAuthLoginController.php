<?php

	$username = $_POST['username'];

	require_once("../../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}

	if (isset($_POST['username']) AND isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db = unserialize($_SESSION['dbconnection']);
		$user = $db->getAdministrator($username, $password);
		echo "1 - ".$user;
		if ($user != null) {
			$_SESSION['user'] = $user;
			$_SESSION['adminAuth'] = true;
		} else {
			$_SESSION['adminAuth'] = false;
		}

		$response = array(
		    "status" => $_SESSION['adminAuth']
		);

		echo json_encode($response);
	}

?>