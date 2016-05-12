<?php

	session_start();

	require_once("../model/autoload.php");

	function getRegisteredInfo($id) {

	$shopDb = unserialize($_SESSION['dbconnection']);	
	$registeredUser = $shopDb->getRegisteredInfo($id);	

	return $registeredUser;

	}

	function updateRegisteredInfo() {

		$username = $_REQUEST['name'];
		$password = $_REQUEST['password'];
		$email = $_REQUEST['email'];
		$birthdate = $_REQUEST['birthdate'];
		$paypal = $_REQUEST['paypal'];
		$image = $_REQUEST['profileImage'];

		$shopDb = unserialize($_SESSION['dbconnection']);

		$registered = new Registered($username, $password, $email, $birthdate, $paypal, $image);
		$shopDb->updateRegisteredUser($registered);
		$_SESSION['dbconnection'] = serialize($shopDb);
	}

	

?>