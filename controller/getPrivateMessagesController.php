<?php

	session_start();

	require_once("../model/autoload.php");

	$shopDb = unserialize($_SESSION['dbconnection']);
	$id = $_SESSION['user_id'];

	$privateMessages = $shopDb->getPrivateMessages($id);

	/*for ($x = 0; $x < count($privateMessages); $x++) {
		echo "<div class='messagesList'>";
		echo "Mensaje de: ".$privateMessages['Username']."<br>";
		echo "Contenido del mensaje: ".$privateMessages['Content']."<br>";
		echo "Fecha y hora del envío: ".$privateMessages['Date']."<br>";
		echo "</div><br>";
	}*/

	if ($privateMessages == null) {
		echo "<span>No dispones de ningún mensaje actualmente<span>";
	} else {
		for ($x = 0; $x < count($privateMessages); $x++) {

			//$datetime = $privateMessages[$x]['Date'];

		echo "<div class='col-lg-10 col-md-10 col-sm-10 col-xs-10'>";

		echo "<p>Mensaje de: ".$privateMessages[$x]['Username']."";		
		echo " - Fecha y hora del envío: ".date('d-m-Y H:m:s', strtotime($privateMessages[$x]['Date']))."</p>";
		echo "Contenido del mensaje: ".utf8_encode($privateMessages[$x]['Content'])."</p></p>";
		echo "</div>";		
		}
	}


?>