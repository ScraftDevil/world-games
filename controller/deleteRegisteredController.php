<?php
	
	session_start();

	require_once("../model/autoload.php");

	$id = $_SESSION['user_id'];

	if($id != null) {

		$shopDb = unserialize($_SESSION['dbconnection']);
		include("../controller/controllerLogout.php");

		//$shopDb->deleteRegisteredUser($id);
		//metodo de logout
		header ("Location: ../view/home.php?msg=ACCOUNT_DELETED");

	}
	

?>