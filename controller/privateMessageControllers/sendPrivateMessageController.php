<?php

require_once("../../model/autoload.php");
include("../profileControllers/sendMessageValidationController.php");
include($_SESSION["BASE_PATH"]."/utilities/validateLength.php");

$myId = $_SESSION['user_id'];

$infoMessage = json_decode($_REQUEST['infoMessage']);

$receiverName = $infoMessage->receiverName;
$message = $infoMessage->message;

$errors = 0;
$response = null;

$errors = sendMessageValidation($receiverName, $message);

	if (validateLength($message, 100)) {

		if ($errors == 0) {
			$shopDb = unserialize($_SESSION['dbconnection']);

			$myMessage = new Message($message, "", $myId, "");
			$shopDb = unserialize($_SESSION['dbconnection']);
			$response = $shopDb->sendPrivateMessage($myMessage, $receiverName);
		}
		else {
			$response = "error";		
		}
		
	} else {
		$response = "overlength";
	}

	echo json_encode($response);

?>