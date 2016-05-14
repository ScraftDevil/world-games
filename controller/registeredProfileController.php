<?php

	session_start();
	
	require_once("../model/autoload.php");
	include("registeredValidationProfileController.php");


	function createObjectRegistered($registered) {
		var_dump($registered);

		$name = $registered[0][0];
		$email = $registered[0][1];
		$birthDate = $registered[0][2];
		$paypalAccount = $registered[0][3];
		$avatarUrl = $registered[0][4];

		$registeredObj = new Registered($name, "", $email, $birthDate, "");
		$registeredObj->setPaypalAccount($paypalAccount);
		$registeredObj->setAvatarURL($avatarUrl);
		return $registeredObj;

	}

	function getRegisteredInfo($id) {

	$shopDb = unserialize($_SESSION['dbconnection']);
	$registeredUser = $shopDb->getRegisteredInfo($id);	

	return $registeredUser;

	}

	function updateRegisteredInfo($id) {
		
		$email = $_REQUEST['email'];
		$birthdate = $_REQUEST['birthdate'];
		$paypal = $_REQUEST['paypal'];
		$image = $_REQUEST['profileImage'];

		$shopDb = unserialize($_SESSION['dbconnection']);

		//metodo que devuelve un objeto Registered. Guardará los campos segun los input 
		//y si estan vacíos cogerá el valor del objeto serializado registered
		$registered = validateInputs($id, $email, $birthdate, $paypal, $image);

		$shopDb->updateRegisteredUser($registered);
	}

	function deleteRegisteredUser($id) {
		$shopDb = unserialize($_SESSION['dbconnection']);
		$shopDb->deleteRegisteredUser($id);
		//metodo de logout
		//esto es provisional
		//Pendiente hacer un logout de sesion con un redirect bien hecho
		header ("Location: ../index.php");
	}


	if (isset($_REQUEST['update'])) {
		updateRegisteredInfo($_SESSION['user_id']);
	}

	if (isset($_REQUEST['delete'])) {
		if (isset($_REQUEST['deleteCheckBox'])) {
			deleteRegisteredUser($_SESSION['user_id']);
		}	
	}	

?>