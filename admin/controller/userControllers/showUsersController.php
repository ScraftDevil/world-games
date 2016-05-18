<?php
	require_once($_SESSION['BASE_PATH']."/model/autoload.php");

	if (isset($_GET['group'])) {
		if ($_GET['group'] == "registered" || $_GET['group'] == "professional" || $_GET['group'] == "administrator") {
			$group = $_GET['group'];
		} else {
			$group = false;
		}
	} else {
		$group = false;
	}

	if ($group != false) {
		switch ($group) {
			case 'registered':
				include_once("../../views/userViews/dataGrids/registeredGrid.php");
				break;
			case 'professional':
				include_once("../../views/userViews/dataGrids/professionalGrid.php");
				break;
			case 'administrator':
				include_once("../../views/userViews/dataGrids/administratorGrid.php");
				break;
			default:
				$group = false;
				break;
		}
		showUsers();
	} else {
		header("Location:../../index.php");
	}
	
?>