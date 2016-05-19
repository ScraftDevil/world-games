<?php
	
	session_start();

	require_once("../model/autoload.php");

	$id = $_SESSION['user_id'];

	if($id != null) {

		$shopDb = unserialize($_SESSION['dbconnection']);

		//Logout del usuario
		include("../controller/controllerLogout.php");

		$shopDb->deleteRegisteredUser($id);
		
		//redirecciona tras borrar la sesion y el usuario
		header ("Location: ../view/home.php?msg=ACCOUNT_DELETED");

	}
	

?>