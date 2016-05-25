<?php

	session_start();

	require_once($_SESSION['BASE_PATH']."/model/autoload.php");
	include("../../view/userViews/showPrivateMessagesView.php");

	$shopDb = unserialize($_SESSION['dbconnection']);
	$id = $_SESSION['user_id'];

	$privateMessages = $shopDb->getPrivateMessages($id);

	showPrivateMessagesView($privateMessages);

?>