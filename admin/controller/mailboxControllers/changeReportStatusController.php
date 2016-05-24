<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$id = $_POST['change-status'];
	$status = $_GET["status"];

	$response = null;

	$report = null;

	$group = strtolower($_SESSION['usertype']);

	if ($id != null) {
		if ($status == "No leído" || $status == "Leído" || $status == "Denegado" || $status == "Aceptado") {
			$report = changeReportStatus($_SESSION['userid'], $id, $group, $status);
			if ($report == "success") {
				header("Location:../../view/mailboxViews/reportListView.php?msg=success");
			} else {
				header("Location:../../view/mailboxViews/reportListView.php?msg=access-error");
			}
		} else {
			header("Location:../../view/mailboxViews/reportListView.php?msg=status-error");
		}
	} else {
		header("Location:../../view/mailboxViews/reportListView.php?msg=data-error");
	}

	function changeReportStatus($id_user, $id_report, $group, $status) {
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->changeReportStatus($id_user, $id_report, $group, $status);
		return $proces;
	}

?>