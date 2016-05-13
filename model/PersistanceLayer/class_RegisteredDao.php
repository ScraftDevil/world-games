<?php

require_once("../model/autoload.php");

class RegisteredDao {

	/* Metodo para obtener datos del usuario registrado */
	public function showRegisteredInfo($id) {

		try {

			$query = ("SELECT Username, Email, BirthDate, PaypalAccount FROM Registered WHERE ID_Registered = '$id'");

			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();

 			$result = $resultat->FetchAll();

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;
			$_SESSION['dbconnection'] = serialize($shopDb);			
		}

	}
 	
 	/* Metodo para actualizar los datos del usuario registrado */
	public function updateRegisteredUser($registered) {
		echo $registered->getUsername();

		try {			

			$query = ('UPDATE Registered SET Username = "'.$registered->getUsername().'", 
			Password = "'.$registered->getPassword().'", Email = "'.$registered->getEmail().'", 
			PaypalAccount = "'.$registered->getPaypalAccount().'", AvatarURL = "'.$registered->getAvatarUrl().'" 
			WHERE ID_Registered = 2');

			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
        	header("Location:../view/showRegisteredProfile.php");

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $resultat;
			$_SESSION['dbconnection'] = serialize($db);			
		}

	}

	/* Metodo para eliminar el usuario registrado */
	public function deleteRegisteredUser($id) {

		try {
			
			$query = ("DELETE FROM Registered WHERE ID_Registered = '$id'");

			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $resultat;
			$_SESSION['dbconnection'] = serialize($shopDb);			
		}
	}
}

?>