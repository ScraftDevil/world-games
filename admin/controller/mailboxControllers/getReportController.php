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
			switch($group) {
				case "administrator":
				getAdministratorReport($_SESSION[''], $id, $group);
				break;
			}
		} else {
			$response = array("id" => "group-error");
		}
	} else {
		$response = array("id" => "data-error");
	}

	function getAdministratorReport($id_user, $id_report, $group) {
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->getReport($id_user, $id_report, $group);
		return $proces;
	}

	function deleteProfessional() {
		$proces = -1;
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$db = unserialize($_SESSION['dbconnection']);
			$proces = $db->deleteProfessionalUser($_POST['delete']);
		}
		return $proces;
	}

	function deleteAdministrator() {
		$proces = -1;
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$db = unserialize($_SESSION['dbconnection']);
			$proces = $db->deleteAdministratorUser($_POST['delete']);
		}
		return $proces;
	}

	function validateID($id) {
		$proces = false;
		if ($id != null AND $id != "") {
			$id = intval($id);
			if (!is_nan($id)) {
				$proces = true;
			}
		}
		return $proces;
	}

	echo json_encode($response);

?>