<?php
	echo getcwd();
	include_once("../controller/adminLoginController.php");
	require_once($_SESSION['BASE_PATH']."/model/autoload.php");
	include_once("dataGrids/usersGrid.php");
	//$garage = unserialize($_SESSION['garage']);
	//$garage->populateGarage();
	//$all = $garage->getClients();
	showUsers();
?>