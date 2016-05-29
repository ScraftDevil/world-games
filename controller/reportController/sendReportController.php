<?php

require_once("../../model/autoload.php");
//include("../profileControllers/sendMessageValidationController.php");

$myId = $_SESSION['user_id'];

$infoReport = json_decode($_REQUEST['infoReport']);

$reportuserName = $infoReport->reportuserName;
$reason = $infoReport->reason;
$contentreport = $infoReport->contentreport;


  

$errors = 0;
$response = null;

//$errors = sendMessageValidation($receiverName, $message);

	if ($errors == 0) {
		$shopDb = unserialize($_SESSION['dbconnection']);
  
$reason, $date, $status, $userRegistered, $professionalUser, $administratorUser


		$myReport = new Report($reason, "","No Leído", $myId, "","");
		$shopDb = unserialize($_SESSION['dbconnection']);
		$response = $shopDb->sendPrivateMessage($myMessage, $receiverName);
	}
	else {
		$response = "error";		
	}

	echo json_encode($response);

?>