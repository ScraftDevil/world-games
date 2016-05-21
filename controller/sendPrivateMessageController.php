<?php

//session_start();

require_once("../model/autoload.php");
include("sendMessageValidationController.php");

$myId = $_SESSION['user_id'];

$infoMessage = json_decode($_REQUEST['infoMessage']);

$emailReceiver = $infoMessage->emailReceiver;
$message = $infoMessage->message;

$errors = 0;

$errors = sendMessageValidation($emailReceiver, $message);

	if ($errors == 0) {
		$shopDb = unserialize($_SESSION['dbconnection']);

		$myMessage = new Message($message, "", $myId, "");
		$shopDb = unserialize($_SESSION['dbconnection']);
		$shopDb->sendPrivateMessage($myMessage, $emailReceiver);

		$response = 0;
	}
	else {
		$response = 1;		
	}

	echo json_encode($response);

?>