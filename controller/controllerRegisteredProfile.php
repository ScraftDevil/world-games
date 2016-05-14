<?php

	session_start();
	
	require_once("../model/autoload.php");
	include("controllerRegisteredValidationProfile.php");

	function getRegisteredInfo($id) {

	$shopDb = unserialize($_SESSION['dbconnection']);
	$registeredUser = $shopDb->getRegisteredInfo($id);	

	return $registeredUser;

	}

	function updateRegisteredInfo($id) {

		$username = $_REQUEST['name'];
		$password = $_REQUEST['confirmNewPassowrd'];
		$email = $_REQUEST['email'];
		$birthdate = $_REQUEST['birthdate'];
		$paypal = $_REQUEST['paypal'];
		$image = $_REQUEST['profileImage'];

		$shopDb = unserialize($_SESSION['dbconnection']);
		//metodo para validar si los datos (obligatorios) enviados estan vacios
		validateInputs($username, $password, $email, $paypal, $image);
		/*$registered = new Registered($username, $password, $email, $birthdate, '');
		$registered->setId($id);

		$shopDb->updateRegisteredUser($registered);*/
	}

	function deleteRegisteredUser($id) {
		$shopDb = unserialize($_SESSION['dbconnection']);
		$shopDb->deleteRegisteredUser($id);
		//metodo de logout
		//esto es provisional
		header ("Location: ../index.php");
	}


	if (isset($_REQUEST['update'])) {
		updateRegisteredInfo(2);
	}

	if (isset($_REQUEST['delete'])) {
		if (isset($_REQUEST['deleteCheckBox'])) {
			deleteRegisteredUser(3);
		}	
	}	

?>