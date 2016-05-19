<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

class registeredDAO {

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

		$id = $registered->getId();
		$email = $registered->getEmail();
		$country = utf8_decode($registered->getCountry());

		try {

			$query = ('SELECT ID_Registered FROM Registered WHERE Email = "$email";');

			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$result = $resultat->execute();

        	if(!$result == "" || $result == $id) {
	        	$query = ('UPDATE registered r INNER JOIN country c ON "'.$country.'" = c.Name 
				SET r.Email = "'.$registered->getEmail().'", r.BirthDate = "'.$registered->getBirthDate().'",
				r.PaypalAccount = "'.$registered->getPaypalAccount().'", r.AvatarURL = "'.$registered->getAvatarUrl().'", 
				r.Country_ID = c.ID_Country WHERE r.ID_Registered = "'.$registered->getId().';"');
				
				$db = unserialize($_SESSION['dbconnection']);
				$resultat = $db->getLink()->prepare($query);
	        	$resultat->execute();

	        	$response = "success";
        	}
        	else {
        		$response = "email";
        	}

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $response;
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

	public function insertRegistered($registered) {
		try {
			$username = $registered->getUsername();
			$email = $registered->getEmail();
			$db = unserialize($_SESSION['dbconnection']);
			$query = ("SELECT p.Username FROM professional p WHERE p.Username='$username' UNION SELECT a.Username FROM administrator a WHERE a.Username='$username' UNION SELECT r.Username FROM registered r WHERE r.Username='$username'");
			$resultat = $db->getLink()->prepare($query);
			$resultat->execute();
 			$result = $resultat->fetch(PDO::FETCH_ASSOC);
 			if (!$result) {
 				$query = ("SELECT p.Username FROM professional p WHERE p.Email='$email' UNION SELECT a.Username FROM administrator a WHERE a.Email='$email' UNION SELECT r.Username FROM registered r WHERE r.Email='$email'");
				$resultat = $db->getLink()->prepare($query);
				$resultat->execute();
 				$result = $resultat->fetch(PDO::FETCH_ASSOC);
				if (!$result) {
					$query = ("INSERT INTO registered (ID_Registered, Username, Password, Email, BannedTime, BirthDate, PaypalAccount, AvatarURL, Shop_ID, Country_ID) VALUES (:id, :username, :password, :email, :bannedtime, :birthdate, :paypal, :avatar, :shop_id, :country)");
					$stmt = $db->getLink()->prepare($query);
					$stmt->bindParam(':id', $this->getLastID());
				    $stmt->bindParam(':username', $registered->getUsername());
				    $stmt->bindParam(':password', $registered->getPassword());
				    $stmt->bindParam(':email', $registered->getEmail());
				    $stmt->bindParam(':bannedtime', $registered->getBannedTime());
				    $stmt->bindParam(':birthdate', $registered->getBirthDate());
				    $stmt->bindParam(':paypal', $registered->getPaypalAccount());
				    $stmt->bindParam(':avatar', $registered->getAvatarUrl());
				    $stmt->bindParam(':shop_id', $this->getShopID());
				    $stmt->bindParam(':country', $registered->getCountry());
				    $stmt->execute();
				    $proces = "success";
				} else {
					$proces = "email";
				}
			} else {
				$proces = "username";
			}
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
			die();
		} finally {
			return $proces;
		}
	}

	private function getLastID() {
		$db = unserialize($_SESSION['dbconnection']);
	    $stmt = $db->getLink()->prepare("SELECT COUNT(*) as total FROM registered");
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result[0]['total'] + 1;
	}

	private function getShopID() {
		$db = unserialize($_SESSION['dbconnection']);
	    $stmt = $db->getLink()->prepare("SELECT ID_Shop FROM shop WHERE Name='WorldGames'");
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result[0]['ID_Shop'];
	}
}

?>