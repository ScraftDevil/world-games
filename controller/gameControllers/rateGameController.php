<?php
session_start();
	require_once("../../model/autoload.php");
	if (isset($_POST['rate'])) {
		$rate = $_POST["rate"];
		$gameid = $_POST["gameid"];
		if (isset($_SESSION['user_id'])) {
			$userid = $_SESSION['user_id'];
			$db = unserialize($_SESSION['dbconnection']);
			$status = $db->userInsertValoration($userid, $gameid, $rate);
		} else {
			$status['msg'] = "LOGIN_ERROR";
		}
	} else {
		$status['msg'] = "NO_RATE_INPUT";
	}
	
	echo json_encode($status);
?>