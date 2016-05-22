<?php

	session_start();

	require_once("../model/autoload.php");
	include("../view/showPrivateMessagesView.php");

	$shopDb = unserialize($_SESSION['dbconnection']);
	$id = $_SESSION['user_id'];

	$privateMessages = $shopDb->getPrivateMessages($id);

	if ($privateMessages == null) {
		echo "<span>No dispones de ningún mensaje actualmente<span>";
	} else {

		showPrivateMessagesView($privateMessages);
	}

?>