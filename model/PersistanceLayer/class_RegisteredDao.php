<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

class RegisteredDAO {

	/* Get User if Login is Valid */
	public function login($username, $password) {
      $userid = -1;
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $stmt = $db->getLink()->prepare("SELECT ID_Registered FROM registered WHERE Username='$username' AND Password='$password' LIMIT 1;");
        $stmt->execute();
        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() > 0) {
          $userid = $userRow['ID_Registered'];
        }
      } catch (PDOException $e) {
        print "¡Error!: " . $e->getMessage() . "<br/>";
        die();
      } finally {
        return $userid;
      }
 	}

 	/* Metodo para obtener el nombre de cada pais de la tabla Country */
 	public function getCountriesList() {

 		try {

			//$query = ("SELECT r.Email, r.BannedTime, r.BirthDate, r.PaypalAccount, r.AvatarURL, c.Name as 'Pais'
			//FROM registered r INNER JOIN country c ON r.Country_ID = c.ID_Country where r.ID_Registered = '$id';");
			$query = ("SELECT Name FROM Country ORDER BY Name");

			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();

 			$result = $resultat->FetchAll(); 			

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}

 	}
 	
	/* Metodo para obtener datos del usuario registrado */
	public function getRegisteredInfo($id) {

		try {

			$query = ("SELECT r.Username, r.Email, r.BannedTime, r.BirthDate, r.PaypalAccount, r.AvatarURL, c.Name as 'Pais'
			FROM registered r INNER JOIN country c ON r.Country_ID = c.ID_Country where r.ID_Registered = '$id';");			

			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();

 			$result = $resultat->FetchAll();

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}

	}
 	
 	/* Metodo para actualizar los datos del usuario registrado */
	public function updateRegisteredUser($registered) {

		try {			

			/*$query = ('UPDATE Registered SET Email = "'.$registered->getEmail().'", BirthDate = "'.$registered->getBirthDate().'",
			PaypalAccount = "'.$registered->getPaypalAccount().'", AvatarURL = "'.$registered->getAvatarUrl().'" 
			WHERE ID_Registered = "'.$registered->getId().'"');*/

			/*update registered r INNER JOIN country c ON 'Méjico' = c.Name SET r.Email = 'german@worldgames.com', 
			r.BirthDate = '2013-09-16', r.PaypalAccount = '', r.AvatarURL = '', r.Country_ID = c.ID_Country 
			WHERE r.ID_Registered = '6';*/
			$query = ('UPDATE registered r INNER JOIN country c ON "'.$registered->getCountry().'" = c.Name 
			SET r.Email = "'.$registered->getEmail().'", r.BirthDate = "'.$registered->getBirthDate().'",
			r.PaypalAccount = "'.$registered->getPaypalAccount().'", r.AvatarURL = "'.$registered->getAvatarUrl().'", 
			r.Country_ID = c.ID_Country WHERE r.ID_Registered = "'.$registered->getId().'"');
			
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
        	//header("Location:../view/registeredProfileView.php");

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

	/* Metodo para obtener todos los datos de todos los usuarios registrados */
	public function showRegistereds($order) {

		try {
			$orderSQL = "";
			if (!empty($order)) {
				$orderSQL = "ORDER BY ".$order;
			}
			$query = ("SELECT ID_Registered, Username, Password, Email, BannedTime, BirthDate, PaypalAccount, AvatarURL, (SELECT c.Name FROM Country c WHERE c.ID_Country=r.Country_ID) as Country FROM Registered r $orderSQL");
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
			$resultat->execute();
 			$result = $resultat->FetchAll();

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}

	}
}

?>