<?php
session_start();
require_once($_SESSION['BASE_PATH']."/model/autoload.php");
//include("../profileControllers/sendMessageValidationController.php");


$infoComplain = json_decode($_POST['infoComplain']);


$reasoncomplain = $infoComplain->reasoncomplain;
$contentcomplain = $infoComplain->contentcomplain;

  

$errors = 0;
$response = null;

//$errors = sendMessageValidation($reportuserName, $message);

//	if ($errors == 0) {
	


		$myComplain = new Complaint($reasoncomplain,$contentcomplain,"", "");
		
		$db = unserialize($_SESSION['dbconnection']);
		$response = $db->sendComplain($myComplain);
		
//	}
//	else {
//		$response = "error";		
	//}

	echo json_encode($response);

?>