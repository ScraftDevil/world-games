<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION['BASE_PATH']."/model/autoload.php");

	$status = array();

	if (isset($_POST['username']) AND isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db = unserialize($_SESSION['dbconnection']);
		$infouser = $db->staffLogin($username, $password);
		if (isset($infouser['userid']) && !empty($infouser['userid'])) {
			$_SESSION['adminAuth'] = true;
			$_SESSION['usertype'] = $infouser['usertype'];
			$_SESSION['userid'] = $infouser['userid'];
			//para evitar tener que recoger el nombre con consulta sql (where id=) despues...
			$_SESSION['username'] = $infouser['username'];
			$status["STATUS"] = "LOGIN_OK";
		} else {
			$status["STATUS"] = "LOGIN_INVALID_INFO";
		}
	} else {
		 $status["STATUS"] = "LOGIN_INVALID_INFO";
	}

	echo json_encode($status);

?>