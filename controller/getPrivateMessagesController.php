<?php

	session_start();

	require_once("../model/autoload.php");
	include("../view/showPrivateMessagesView.php");

	$shopDb = unserialize($_SESSION['dbconnection']);
	$id = $_SESSION['user_id'];

	$privateMessages = $shopDb->getPrivateMessages($id);

	showPrivateMessagesView($privateMessages);

?>