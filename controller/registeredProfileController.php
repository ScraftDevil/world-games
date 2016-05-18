<?php

	require_once("../model/autoload.php");
	include("registeredValidationProfileController.php");


	function createObjectRegistered($registered) {

		$name = $registered[0][0];
		$email = $registered[0][1];
		$birthDate = $registered[0][3];
		$birthDate = date('d-m-Y', strtotime($birthDate));
		$paypalAccount = $registered[0][4];
		$avatarUrl = $registered[0][5];
		$country = $registered[0][6];

		$registeredObj = new Registered($name, "", $email, $birthDate, $country);
		$registeredObj->setPaypalAccount($paypalAccount);
		$registeredObj->setAvatarURL($avatarUrl);

		return $registeredObj;

	}

	function getRegisteredInfo($id) {

	$shopDb = unserialize($_SESSION['dbconnection']);
	$registeredUser = $shopDb->getRegisteredInfo($id);	
	return $registeredUser;

	}

	/* Metodo para obtener la lista de nombres de los paises de la BD */
	function getCountriesList($myCountry) {
		$shopDb = unserialize($_SESSION['dbconnection']);
		$countries = $shopDb->getCountriesList();

    	// version estandar valida solo para usuarios ya registrados, ya que selecciona el pais con el que se registró
    	for ($x = 0; $x < count($countries); $x++) {
        	if ($countries[$x][0] == $myCountry) {
        		?><option selected><?php echo utf8_encode($myCountry) ?></option><?php
        	} else {
        		?><option><?php echo utf8_encode($countries[$x][0]) ?></option><?php
        	}
    	}

    	/* version modularizada para tambien poder ser utilizada en el formulario de registro, etc
		 falta comprobar si en el formulario de registro no afecta el valor seleccionado*/
		/*for ($x = 0; $x < count($countries); $x++) {
			if (isset($_SESSION['user_id'])) {
				if ($countries[$x][0] == $myCountry) {
					?><option selected><?php echo utf8_encode($myCountry) ?></option><?php
				} else {
					?><option><?php echo utf8_encode($countries[$x][0]) ?></option><?php
				}
			}        	
    	}*/
	}

	function updateRegisteredInfo($id) {
		
		$email = $_REQUEST['email'];
		$birthdate = $_REQUEST['birthdate'];
		$birthdate = date('Y-m-d', strtotime($birthdate));
		$paypal = $_REQUEST['paypal'];
		$image = $_REQUEST['profileImage'];
		$country = $_REQUEST['country'];

		$shopDb = unserialize($_SESSION['dbconnection']);

		$errors = array();

		//metodo que devuelve un objeto Registered. Guardará los campos segun los input 
		//y si estan vacíos cogerá el valor del objeto serializado registered
		//$registered = validateInputs($id, $email, $birthdate, $paypal, $image, $country);
		$errorsList = validateInputs($id, $email, $birthdate, $paypal, $image, $country, $errors);

		if ($errorsList == null) {
			$registered = new Registered('', '', $email, $birthdate, $country, $errors);
			$registered->setId($id);
			$registered->setPaypalAccount($paypal);
			$registered->setAvatarURL($image);
			$shopDb->updateRegisteredUser($registered);
		}
		else {
			print_r($errorsList);
		}
		
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