<?php

	require_once("../model/autoload.php");

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
	}

?>