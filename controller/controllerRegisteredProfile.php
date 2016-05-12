<?php

	session_start();

	require_once("../model/autoload.php");

	function getRegisteredInfo($id) {

	$shopDb = unserialize($_SESSION['dbconnection']);	
	$registeredUser = $shopDb->getRegisteredInfo($id);	

	return $registeredUser;

	}

	

?>