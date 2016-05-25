<?php
	session_start();
	require_once("../../model/autoload.php");
	include_once("../../view/gameViews/showOpinionsView.php");
	$db = unserialize($_SESSION['dbconnection']);
	$gameid = $_POST["gameid"];
	$result = $db->getGameComments($gameid);
	printMessages($result);
?>