<?php

	require_once("../../model/autoload.php");
	include("registeredValidationProfileController.php");

	$id = $_SESSION['user_id'];
	
	$registered = json_decode($_REQUEST['registered']);

	$email = $registered->email;
	$birthdate = $registered->birthdate;
	//$birthdate = date('Y-m-d', strtotime($birthdate));
	$paypal = $registered->paypal;
	$image = $registered->image;
	$country = $registered->country;

	$shopDb = unserialize($_SESSION['dbconnection']);

	$errors = 0;

	$response = "";

	$_SESSION['msg'] = array();

	//Validacion de los campos introducidos. Si devuelve 0 es que no hay errores
	$errors = validateInputs($email, $birthdate, $paypal, $image, $country);

	if ($errors == 0) {
		$shopDb = unserialize($_SESSION['dbconnection']);
		$birthdate = date("Y-m-d", strtotime($birthdate));
		$registered = new Registered('', '', $email, $birthdate, $country);
		$registered->setId($id);
		$registered->setPaypalAccount($paypal);
		$registered->setAvatarURL($image);

		$result = $shopDb->updateRegisteredUser($registered);

		$response = 0;
	}
	else {
		$response = 1;		
	}

	echo json_encode($response);

?>