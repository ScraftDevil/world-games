<?php

	session_start();

	require_once("../model/autoload.php");
	include("../view/showPrivateMessagesView.php");

	$shopDb = unserialize($_SESSION['dbconnection']);
	$id = $_SESSION['user_id'];

	$privateMessages = $shopDb->getPrivateMessages($id);

	/*if ($privateMessages == null) {
		echo "<div class='no-message'>Actualmente tu bandeja de entrada está vacía.
			<i class='fa fa-frown-o' aria-hidden='true'></i>
		<div>
		<p class='no-message'>¿Y si pruebas enviándole un mensaje a alguien?</p>";
	} else {*/

		showPrivateMessagesView($privateMessages);
	//}

?>