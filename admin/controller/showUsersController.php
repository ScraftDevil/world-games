<?php
	require_once($_SESSION['BASE_PATH']."/model/autoload.php");

	if (isset($_GET['group'])) {
		$group = $_GET['group'];
	} else {
		$group = false;
	}

	if ($group != false) {
		switch ($group) {
			case 'registered':
				include_once("dataGrids/registeredGrid.php");
				break;
			case 'professional':
				include_once("dataGrids/professionalGrid.php");
				break;
			case 'administrator':
				include_once("dataGrids/administratorGrid.php");
				break;
		}
		showUsers();
	} else {
		header("Location:../index.php");
	}
	
?>