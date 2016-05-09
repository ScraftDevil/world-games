<?php
	
	require_once($_SESSION['BASE_PATH']."model/autoload.php");

	$GLOBALS['SERVER'] = "localhost";
	$GLOBALS['USERNAME'] = "root";
	$GLOBALS['PASSWORD'] = "";
	$GLOBALS['DATABASE'] = "worldgames";

	if (!isset($_SESSION['dbconnection'])) {
		$db = new mysqldb();
		$_SESSION['dbconnection'] = serialize($db);
	}
?>