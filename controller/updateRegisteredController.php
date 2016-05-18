<?php

	require_once("../model/autoload.php");
	include("registeredValidationProfileController.php");

	$id = $_SESSION['user_id'];
	$email = $_REQUEST['email'];
	$birthdate = $_REQUEST['birthdate'];
	$birthdate = date('Y-m-d', strtotime($birthdate));
	$paypal = $_REQUEST['paypal'];
	$image = $_REQUEST['profileImage'];
	$country = $_REQUEST['country'];

	$shopDb = unserialize($_SESSION['dbconnection']);

	$errors = 0;

	//Validacion de los campos introducidos. Si devuelve 0 es que no hay errores
	$errors = validateInputs($id, $email, $birthdate, $paypal, $image, $country, $errors);

	if ($errors == 0) {
		$shopDb = unserialize($_SESSION['dbconnection']);

		$registered = new Registered('', '', $email, $birthdate, $country);
		$registered->setId($id);
		$registered->setPaypalAccount($paypal);
		$registered->setAvatarURL($image);

		$shopDb->updateRegisteredUser($registered);
	}
	else {
		//header("Location: ../view/registeredProfileView.php");
	}

?>