<?php

	require_once("../../model/autoload.php");
	require_once("recaptchaValidationController.php");

	// coge la librería recaptcha
    require_once("../../lib/recaptchalib.php");

	if (session_id() == '') {
	    session_start();
	}

	//clave secreta
	$secret = "6Lf_HSETAAAAAEAlKHOPiCbqTFYm8FmSLej3-4_Y";

	//aquí guarda la respuesta del catpcha del usuario
	$captcha = $_POST['recaptcha'];

	$status = array();

	if (isset($_POST['username']) AND isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$db = unserialize($_SESSION['dbconnection']);
		$userid = $db->registeredBackLogin($username, $password);
		if ($userid!=-1) {
			if (validateCaptcha($captcha, $secret)) {
				$_SESSION['frontAuth'] = true;
				$_SESSION['user_id'] = $userid;
				$status["STATUS"] = "LOGIN_OK";			
			}
			else {
				$status["STATUS"] = "RECATPCHA_ERROR";	
			}
		} else {
			$status["STATUS"] = "LOGIN_INVALID_INFO";
		}
	} else {
		 $status["STATUS"] = "LOGIN_INVALID_INFO";
	}

	echo json_encode($status);

?>