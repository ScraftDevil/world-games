<?php

require_once("../model/autoload.php");

class RegisteredDao {

	public function showRegisteredInfo($id) {
		
		$query = ("SELECT Username, Email, BirthDate, PaypalAccount FROM Registered WHERE ID_Registered = '$id'");

		$db = unserialize($_SESSION['dbconnection']);
		$resultat = $db->getLink()->prepare($query);
        $resultat->execute();

 		$result = $resultat->FetchAll();
 		
        return $result;

	}
	
}

?>