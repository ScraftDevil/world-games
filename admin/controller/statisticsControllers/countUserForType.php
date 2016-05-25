<?php

	session_start();

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$shopDb = unserialize($_SESSION['dbconnection']);

	//Consulta para obtener los 3 tipos de usuario (admin, professional y registered)
	$result = $shopDb->countUsersForType();

	$users = array("Administrator" => $result[0][0], "Professional" => $result[0][1], "Registered" => $result[0][2]);

echo json_encode($users);

?>
