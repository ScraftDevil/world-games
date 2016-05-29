<?php

	require_once("../../model/autoload.php");
	include("registeredValidationProfileController.php");

	$id = $_SESSION['user_id'];
	
	$registered = json_decode($_REQUEST['registered']);

	$email = $registered->email;
	$birthdate = $registered->birthdate;
	$paypal = $registered->paypal;
	$image = $registered->image;
	$country = $registered->country;	

	$shopDb = unserialize($_SESSION['dbconnection']);

	$errors = 0;

	$response = "";

	$_SESSION['msg'] = array();

	//Validacion de los campos introducidos. Si devuelve 0 es que no hay errores
	$errors = registeredProfileUpdateValidations($email, $birthdate, $paypal, $image, $country);

	if ($errors == 0) {
		$shopDb = unserialize($_SESSION['dbconnection']);
		$birthdate = date("Y-m-d", strtotime($birthdate));
		$registered = new Registered('', '', $email, $birthdate, $country);
		$registered->setId($id);
		$registered->setPaypalAccount($paypal);
		$registered->setAvatarURL($image);

		$result = $shopDb->updateRegisteredUser($registered);
		$response = messages($result);
	}
	else {
		$response = messages("invalid-fields");		
	}

	//Determinación del mensaje del error convertido en un array json
	function messages($result) {
		$response = null;
		switch($result) {

			case "success":
				$response = array("id" => "success");
				unset($_SESSION['msg']);
			break;

			case "email":
				$response = array("id" => "email-error", "errors" => $_SESSION['msg']);
				unset($_SESSION['msg']);
			break;

			case "invalid-fields":
				$response = array("id" => "invalid-fields", "errors" => $_SESSION['msg']);
				unset($_SESSION['msg']);
			break;

			default:
				$response = array("id" => "error");
				unset($_SESSION['msg']);
			break;
		}
		return $response;
	}

	echo json_encode($response);

?>