<?php

//session_start();

require_once("../model/autoload.php");
include("sendMessageValidationController.php");

$myId = $_SESSION['user_id'];

$infoMessage = json_decode($_REQUEST['infoMessage']);

$receiverName = $infoMessage->receiverName;
$message = $infoMessage->message;

$errors = 0;
$response = null;

$errors = sendMessageValidation($receiverName, $message);

	if ($errors == 0) {
		$shopDb = unserialize($_SESSION['dbconnection']);

		$myMessage = new Message($message, "", $myId, "");
		$shopDb = unserialize($_SESSION['dbconnection']);
		$response = $shopDb->sendPrivateMessage($myMessage, $receiverName);		

	}
	else {
		$response = "error";		
	}

	echo json_encode($response);

?>