<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

class registeredDAO {

	/* Get User if Login is Valid */
	public function login($username, $password) {
      $userid = -1;
      try {
        $db = unserialize($_SESSION['dbconnection']);
        $stmt = $db->getLink()->prepare("SELECT ID_Registered FROM registered WHERE Username='$username' AND Password='".md5($password)."' LIMIT 1;");
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
 	
	/* Metodo para obtener datos del usuario registrado */
	public function getRegisteredInfo($id) {

		try {

			$query = ("SELECT r.ID_Registered, r.Username, r.Password, r.Email, r.BannedTime, r.BirthDate, r.PaypalAccount, r.AvatarURL, c.Name as 'Pais'
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

	public function getAllRegisteredInfo($id) {
		try {

			$query = ("SELECT r.Username, r.Password, r.Email, r.BannedTime, r.BirthDate, r.PaypalAccount, r.AvatarURL, r.Country_ID, (SELECT c.Name FROM country c WHERE c.ID_Country=r.Country_ID) AS Country FROM registered r where ID_Registered = '$id'");				
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
 			while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
				$username = $row['Username'];
				$password = $row['Password'];
				$email = $row['Email'];
				$bannedtime = $row['BannedTime'];
				$birthdate = $row['BirthDate'];
				$paypal = $row['PaypalAccount'];
				$avatar = $row['AvatarURL'];
				$countryID = $row['Country_ID'];
				$country = $row['Country'];
				$user = array('username'=> $username, 'password'=> $password, 'email'=>$email, 'bannedtime'=> $bannedtime, "birthdate"=> date('d-m-Y', strtotime($birthdate)), "paypal"=> $paypal, "avatar"=>$avatar, "countryID"=>$countryID, "country"=>utf8_encode($country));
			}
			$result = $user;

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}

	}

	public function getPrivateMessages($id) {

		try {

			/* Obtener mensajes del usuario y el nombre del usuario que envió el mensaje */
			$query = ("SELECT ID_Message, Username, Content, Date FROM message INNER JOIN registered_has_message ON ID_Message = Message_ID 
					INNER JOIN registered ON Registered_ID = ID_Registered WHERE Receiver_ID = '".$id."' ORDER BY Date ASC");
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
        	$result = $resultat->FetchAll();
        	//$result = $resultat->fetch(PDO::FETCH_ASSOC);
			
		} catch (PDOException $e) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;
			$_SESSION['dbconnection'] = serialize($db);			
		}
	}	
 	
 	/* Metodo para actualizar los datos del usuario registrado */
	public function updateRegisteredUser($registered) {

		$id = $registered->getId();
		$email = $registered->getEmail();
		$country = $registered->getCountry();

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
        		$response = "email-error";
        	}

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $response;
			$_SESSION['dbconnection'] = serialize($db);			
		}

	}

	public function updateAllRegisteredUser($registered) {
		$proces = "";
		try {
			$db = unserialize($_SESSION['dbconnection']);
			// USERNAME VALIDATION IN TABLES
			if($this->usernameInUse($registered, $db, "update") == false) {
				// EMAIL VALIDATION IN TABLES
				if($this->emailInUse($registered, $db, "update") == false) {
					// UPDATE ALL COLUMNS IN REGISTERED TABLE

					// registered all info
					$id = $registered->getId();
					$username = $registered->getUsername();
					$password = $registered->getPassword();
					$email = $registered->getEmail();
					$bannedtime = $registered->getBannedTime();
					$birthdate = $registered->getBirthDate();
					$paypal = $registered->getPaypalAccount();
					$avatar = $registered->getAvatarUrl();
					$country = $registered->getCountry();

					// update string
					$updateString = "Username='$username', ";
					
					if ($password != null && $password != "") {
						$updateString = $updateString."Password='$password', ";
					}

					$updateString = $updateString."Email='$email', ";

					if ($bannedtime != null && $bannedtime != "") {
						$updateString = $updateString."BannedTime='$bannedtime', ";
					} else {
						$updateString = $updateString."BannedTime='', ";
					}

					$updateString = $updateString."BirthDate='$birthdate', ";

					if ($paypal != null && $paypal != "") {
						$updateString = $updateString."PaypalAccount='$paypal', ";
					} else {
						$updateString = $updateString."PaypalAccount='', ";
					}

					if ($avatar != null && $avatar != "") {
						if ($avatar == "no") {
							$updateString = $updateString."AvatarURL='', ";
						}
					}

					$updateString = $updateString."Country_ID='$country'";

					$query = ("UPDATE registered SET ".$updateString." WHERE ID_Registered='$id'");
					$stmt = $db->getLink()->prepare($query);
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
			$proces = "error";
			die();
		} finally {
			return $proces;
		}
	}

	private function emailInUse($registered, $db, $type) {
		$use = 0;

		$email = $registered->getEmail();
		$id = $registered->getID();

		// Select que comprueba si existe el email en cualquiera de las tablas de usuario
		$query = ("SELECT p.Username FROM professional p WHERE p.Email='$email' UNION SELECT a.Username FROM administrator a WHERE a.Email='$email' UNION SELECT r.Username FROM registered r WHERE r.Email='$email'");
		$resultat = $db->getLink()->prepare($query);
		$resultat->execute();
 		$emailInTables = $resultat->fetch(PDO::FETCH_ASSOC);

 		switch($type) {
 			case "insert":
 				if (!$emailInTables) {
		 			$use = false;
		 		} else {
		 			$use = true;
		 		}
 			break;

 			case "update":
 				// Select que comprueba si el nombre de usuario es el mismo que esta usando
		 		$query = ("SELECT ID_Registered FROM registered WHERE Email='$email' AND ID_Registered='$id'");
				$resultat = $db->getLink()->prepare($query);
				$resultat->execute();
		 		$thisEmail = $resultat->fetch(PDO::FETCH_ASSOC);
	 			// Si el nombre de usuario existe en una tabla, esta es la tabla del usuario y su ID coincide o si el nombre de usuario no existe en ninguna tabla devuelve un 0 porque puede usarlo, en caso contrario devuelve un 1 denegando la operacion.
		 		if (!$emailInTables) {
		 			$use = false;
		 		} else {
		 			if (!$thisEmail) {
		 				$use = true;
		 			} else {
		 				$use = false;
		 			}
		 		}
 			break;
 		}

 		return $use;
	}

	private function usernameInUse($registered, $db, $type) {
		$use = 0;

		$username = $registered->getUsername();
		$id = $registered->getID();

		// Select que comprueba si existe el nombre de usuario en cualquiera de las tablas de usuario
		$query = ("SELECT p.Username FROM professional p WHERE p.Username='$username' UNION SELECT a.Username FROM administrator a WHERE a.Username='$username' UNION SELECT r.Username FROM registered r WHERE r.Username='$username'");
		$resultat = $db->getLink()->prepare($query);
		$resultat->execute();
 		$usernameInTables = $resultat->fetch(PDO::FETCH_ASSOC);

 		switch($type) {
 			case "insert":
 				if (!$usernameInTables) {
		 			$use = false;
		 		} else {
		 			$use = true;
		 		}
 			break;

 			case "update":
 				// Select que comprueba si el nombre de usuario es el mismo que esta usando
		 		$query = ("SELECT ID_Registered FROM registered WHERE Username='$username' AND ID_Registered='$id'");
				$resultat = $db->getLink()->prepare($query);
				$resultat->execute();
		 		$thisUsername = $resultat->fetch(PDO::FETCH_ASSOC);
	 			// Si el nombre de usuario existe en una tabla, esta es la tabla del usuario y su ID coincide o si el nombre de usuario no existe en ninguna tabla devuelve un 0 porque puede usarlo, en caso contrario devuelve un 1 denegando la operacion.
		 		if (!$usernameInTables) {
		 			$use = false;
		 		} else {
		 			if (!$thisUsername) {
		 				$use = true;
		 			} else {
		 				$use = false;
		 			}
		 		}
 			break;
 		}

 		return $use;
	}

	/* Metodo para eliminar el usuario registrado */
	public function deleteRegistered($id) {
		$proces = -1;
		try {
			$db = unserialize($_SESSION['dbconnection']);
			$sql = ("SELECT ID_Registered FROM registered WHERE ID_Registered='$id'");
			$resultat = $db->getLink()->prepare($sql);
			$result = $resultat->execute();
			if ($result) {
				$query = ("DELETE FROM registered WHERE ID_Registered = '$id'");
				$resultat = $db->getLink()->prepare($query);
        		$resultat->execute();
        		$proces = 1;
			}
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $proces;			
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
		$proces = "";
		try {
			$db = unserialize($_SESSION['dbconnection']);
			// USERNAME VALIDATION IN TABLES
			if($this->usernameInUse($registered, $db, "insert") == false) {
				// EMAIL VALIDATION IN TABLES
				if($this->emailInUse($registered, $db, "insert") == false) {
					// INSERT ALL COLUMNS IN REGISTERED TABLE
					$query = ("INSERT INTO registered (ID_Registered, Username, Password, Email, BannedTime, BirthDate, PaypalAccount, AvatarURL, Shop_ID, Country_ID) VALUES ('', :username, :password, :email, :bannedtime, :birthdate, :paypal, :avatar, :shopid, :country)");
					$stmt = $db->getLink()->prepare($query);
				    $stmt->bindParam(':username', $registered->getUsername());
				    $stmt->bindParam(':password', $registered->getPassword());
				    $stmt->bindParam(':email', $registered->getEmail());
				    $stmt->bindParam(':bannedtime', $registered->getBannedTime());
				    $stmt->bindParam(':birthdate', $registered->getBirthDate());
				    $stmt->bindParam(':paypal', $registered->getPaypalAccount());
				    $stmt->bindParam(':avatar', $registered->getAvatarUrl());
				    $stmt->bindParam(':shopid', $this->getShopID());
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

	/* Insert Message on DB */
	public function sendPrivateMessage($myMessage, $receiverName) {

		$message = utf8_decode($myMessage->getContent());
		$idReceiver = "";
		$proces = "";

		try {

			$query = ('SELECT ID_Registered FROM Registered WHERE Username = "'.$receiverName.'";');
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
        	$result = $resultat->fetch(PDO::FETCH_ASSOC);

        	if($result) {

        		//id of receiver user
        		$idReceiver = $result['ID_Registered'];

        		$query = ("INSERT INTO message values('', '".$message."', sysdate())");
        		$resultat = $db->getLink()->prepare($query);
        		$result = $resultat->execute();

        		if($result) {

        			//id of new message
        			$newIdMessage = $this->getLastID_Message();

        			$query = ("INSERT INTO registered_has_message values('".$myMessage->getSenderUser()."', 
        				'".$idReceiver."', '".$newIdMessage."')");
        			$resultat = $db->getLink()->prepare($query);
        			$result = $resultat->execute();

        			$proces = "success";
        		}     		

        	} else {
        		$proces = "username";
        	}
			
		} catch (PDOException $e) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $proces;
			$_SESSION['dbconnection'] = serialize($db);			
		}
	}

	private function getLastID_Message() {
		$db = unserialize($_SESSION['dbconnection']);
	    $stmt = $db->getLink()->prepare("SELECT MAX(ID_Message) as total FROM message");
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result[0]['total'];
	}

	/* REGISTERED LIST */

	public function getAllRegistered() {
		try {
			$query = ("SELECT ID_Registered, Username, Email, BannedTime, BirthDate, PaypalAccount, Country_ID FROM registered");				
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
 			$result = $resultat->FetchAll();;
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}
	}
}

?>