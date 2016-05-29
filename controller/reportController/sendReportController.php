<?php
session_start();
require_once($_SESSION['BASE_PATH']."/model/autoload.php");
//include("../profileControllers/sendMessageValidationController.php");


$infoReport = json_decode($_POST['infoReport']);

$reportuserName = $infoReport->reportuserName;
$reasonreport = $infoReport->reasonreport;
$contentReport = $infoReport->contentReport;

  

$errors = 0;
$response = null;

//$errors = sendMessageValidation($reportuserName, $message);

//	if ($errors == 0) {
	


		$myReport = new Report($reasonreport,$contentReport, "","", $reportuserName);
		
		$db = unserialize($_SESSION['dbconnection']);
		$response = $db->sendReport($myReport,$reportuserName);
		
//	}
//	else {
//		$response = "error";		
	//}

	echo json_encode($response);

?>