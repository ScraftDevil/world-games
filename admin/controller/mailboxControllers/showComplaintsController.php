<?php
	require_once($_SESSION['BASE_PATH']."/model/autoload.php");

	if (isset($_SESSION['userid']) AND isset($_SESSION['userid'])) {
		$status = true;
	} else {
		$status = false;
	}

	if ($status != false) {
		include_once("../../view/mailboxViews/dataGrids/complaintGrid.php");
		showReports();
	} else {
		header("Location:../../index.php");
	}
	
?>