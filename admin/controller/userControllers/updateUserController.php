<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$group = $_GET['group'];
	$id = $_GET['user'];

	if ($group == "registered" || $group == "professional" || $group == "administrator") {
		if ($id != null AND $id != "") {
			switch($group) {
				case "registered":
					updateRegistered();
				break;
				
				case "professional":

				break;
				
				case "administrator":

				break;
			}
		}
	} else {
		header("Location:../../index.php");
	}

	function updateRegistered() {
		$proces = -1;
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$db = unserialize($_SESSION['dbconnection']);
			$proces = $db->deleteRegisteredUser($_POST['delete']);
		}
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

?>