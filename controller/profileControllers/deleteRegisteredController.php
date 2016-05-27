<?php
	
	session_start();

	require_once($_SESSION['BASE_PATH']."/model/autoload.php");

	$id = $_SESSION['user_id'];

	if($id != null) {

		$shopDb = unserialize($_SESSION['dbconnection']);

		//Logout del usuario
		include("../frontAuthControllers/logoutController.php");

		$shopDb->deleteRegisteredUser($id);
		
		//redirecciona tras borrar la sesion y el usuario
		header ("Location: ../../view/mainViews/home.php?msg=ACCOUNT_DELETED");

	}
	

?>