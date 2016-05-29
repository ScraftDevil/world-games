<?php

	require_once($_SESSION['BASE_PATH']."/model/autoload.php");

	function createObjectRegistered($registered) {

		$id = $registered[0][0];
		$name = $registered[0][1];
		$password = $registered[0][2];
		$email = $registered[0][3];
		$bannedtime = $registered[0][4];
		$birthDate = $registered[0][5];
		$birthDate = date('d-m-Y', strtotime($birthDate));
		$paypalAccount = $registered[0][6];
		$avatarUrl = $registered[0][7];
		$country = $registered[0][8];

		$registeredObj = new Registered($name, $password, $email, $birthDate, $country);
		$registeredObj->setId($id);
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
		$countries = $shopDb->getCountries();		

    	// version estandar valida solo para usuarios ya registrados, ya que selecciona el pais con el que se registró
    	for ($x = 0; $x < count($countries); $x++) {
    		$id = $countries[$x][0];
    		
        	if ($countries[$x][1] == $myCountry) {
        		?><option selected value="<?php echo $id ?>"><?php echo $myCountry ?></option><?php
        	} else {
        		?><option value="<?php echo $id ?>"><?php echo $countries[$x][1] ?></option><?php
        	}
    	}
    	
	}

?>