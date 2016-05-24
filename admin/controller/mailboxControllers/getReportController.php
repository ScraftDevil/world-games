<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$id = $_POST['id'];

	$response = null;

	$report = null;

	$group = strtolower($_SESSION['usertype']);

	if ($id != null) {
		if ($group == "professional" || $group == "administrator") {
			$report = getReport($_SESSION['userid'], $id, $group);
			$dateANDhour = explode(" ", $report[0][2]);
			$dateANDhour[0] = date("d-m-Y", strtotime($dateANDhour[0]));
			$response = array("id" => "success", "id_report" => $report[0][0], "status" => utf8_encode($report[0][1]), "date" => $dateANDhour[0], "hour" => $dateANDhour[1], "reason" => $report[0][3], "text" => utf8_encode($report[0][4]), "userreported" => $report[0][5], "userreclaim" => $report[0][6]);
			if (utf8_encode($report[0][1]) == "No leído") {
				setReportRead($id);
			}
		} else {
			$response = array("id" => "group-error");
		}
	} else {
		$response = array("id" => "data-error");
	}

	function getReport($id_user, $id_report, $group) {
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->getReport($id_user, $id_report, $group);
		return $proces;
	}

	function setReportRead($id) {
		$read = utf8_decode("Leído");
		$db = unserialize($_SESSION['dbconnection']);
		$db->setReportRead($id, $read);
	}

	echo json_encode($response);

?>