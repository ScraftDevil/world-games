<?php
	session_start();
	require_once("../../model/autoload.php");
	$db = unserialize($_SESSION['dbconnection']);
	$gameid = $_POST["gameid"];
	$result = $db->getGameValoration($gameid);
	echo $result[0]['score'];
?>