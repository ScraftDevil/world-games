<?php
require_once($_SESSION['BASE_PATH']."config/db.inc.php");

class mysqldb {
	private $dsn, $username, $password, $link;

	public function __construct() {
		$this->setDSN("mysql:dbname=".$GLOBALS['DATABASE'].";host=".$GLOBALS['SERVER'].";charset=utf8");
		$this->setUsername($GLOBALS['USERNAME']);
		$this->setPassword($GLOBALS['PASSWORD']);
		$this->connect();
	}

	public function getDSN() {
		return $this->dsn;
	}

	public function setDSN($value) {
		$this->dsn = $value;
	}
	
	public function getUsername() {
		return $this->username;
	}

	public function setUsername($value) {
		$this->username = $value;
	}
	
	public function getPassword() {
		return $this->password;
	}

	public function setPassword($value) {
		$this->password = $value;
	}

	private function connect() {
		try {
			$this->link = new PDO($this->dsn, $this->username, $this->password);
		} catch (PDOException $e) {
			print "¡Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}

	public function __sleep() {
		return array('dsn', 'username', 'password');
	}

	public function __wakeup() {
		$this->connect();
	}

	public function getLink() {
		return $this->link;
	}

	public function getGames() {
		$sqlDiscount = ", (SELECT O.Discount FROM Offer O WHERE O.ID_Offer = G.Offer_ID) as Discount";
		$sqlPlatform = ", (SELECT P.Name FROM platform P WHERE P.ID_Platform = G.Platform_ID) as Platform";
		$sql = "SELECT G.ID_Game, G.Title, G.Price, G.Stock ".$sqlDiscount." ".$sqlPlatform." FROM game G WHERE G.Stock>0";
		$stmt = $this->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	public function getAllGames($order) {
		$gameDAO = new gameDAO();
		return $gameDAO->getAllGames($order);
	}

	public function getAllGameInfo($id) {
		$gameDAO = new gameDAO();
		$game = $gameDAO->getAllGameInfo($id);
		return $game;
	}


	public function getOfferGame($gameid) {
		$sql = "SELECT G.Title as Game, O.ID_Offer, O.Discount FROM game G INNER JOIN offer O WHERE O.ID_Offer=G.Offer_ID AND G.ID_Game=$gameid";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	public function getAllMessages($order) {
		$messageDAO = new messageDAO();
		return $messageDAO->getAllMessages($order);
	}

	public function getAllComment($order) {
		$commentDAO = new commentDAO();
		return $commentDAO->getAllComment($order);
	}

	public function getGenresGame($gameid) {
		$sql = "SELECT GE.ID_Genre, GE.Name FROM game_has_genre GG INNER JOIN Genre GE
		WHERE GE.ID_Genre = GG.Genre_ID AND GG.Game_ID = $gameid";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	/* Metodo para obtener el ID y el nombre de cada pais de la tabla Country */
	public function getCountries() {
		$sql = "SELECT ID_Country, Name FROM Country ORDER BY Name";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	public function getCountryByName($name) {
		$country = utf8_decode($name);
		$sql = "SELECT ID_Country, Name FROM Country WHERE Name='$country'";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	public function existCountry($id) {
		$sql = "SELECT ID_Country FROM Country WHERE ID_Country='$id'";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if($result) {
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}


	public function getPlatform() {
		$sql = "SELECT ID_Platform, Name FROM platform";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	public function getGenre() {
		$sql = "SELECT ID_Genre, Name FROM genre";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	//OFFER GET DATA
	public function getAllOfferInfo($idoffer) {
		$sql = "SELECT ID_Offer, Discount FROM offer";
		$stmt = $this->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	//OFFER UPDATE DATA
	public function updateAllOffer($offer) {
		$sql = "UPDATE offer SET Discount = '".$offer->getDiscount()."' WHERE ID_Offer='".$offer->getId()."'";
		$stmt = $this->getLink()->prepare($sql);
		return $stmt->execute();
	}

	public function getRegisteredInfo($id) {
		$registeredDao = new RegisteredDAO();
		$registered = $registeredDao->getRegisteredInfo($id);
		return $registered;
	}

	public function getAllRegisteredInfo($id) {
		$registeredDao = new registeredDAO();
		$registered = $registeredDao->getAllRegisteredInfo($id);
		return $registered;
	}

	public function updateRegisteredUser($registered) {
		$registeredDao = new RegisteredDAO();
		$result = $registeredDao->updateRegisteredUser($registered);
		return $result;
	}

	public function updateAllRegisteredUser($registered) {
		$registeredDao = new registeredDAO();
		return $registeredDao->updateAllRegisteredUser($registered);
	}

	public function deleteRegistered($id) {
		$registeredDao = new registeredDAO();
		$registered = $registeredDao->deleteRegistered($id);
		return $registered;		
	}

	public function deleteGenre($id) {
		$GenreDAO = new GenreDAO();
		$genre = $GenreDAO->deleteGenre($id);		
	}
	
	public function deletePlatform($id) {
		$PlatformDAO = new PlatformDAO();
		$platform = $PlatformDAO->deletePlatform($id);		
	}

	public function deleteComment($id) {
		$CommentDAO = new CommentDAO();
		$comment = $CommentDAO->deleteComment($id);		
	}

	public function deleteMessage($id) {
		$MessageDAO = new MessageDAO();
		$message = $MessageDAO->deleteMessage($id);		
	}


	public function deleteGame($id){
		$gameDAO = new gameDAO();
		$game = $gameDAO->deleteGame($id);
	}

	public function deleteOffer($id){
		$offerDAO = new offerDAO();
		$offer = $offerDAO->deleteOffer($id);
	}

	public function searchGame($value) {
    	$sql = "SELECT G.ID_Game, G.Title, G.Price FROM game G WHERE G.Title LIKE '%".$value."%'";
		$stmt = $this->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
    }

    public function staffLogin($username, $password) {
    	$info = array();
    	$sql = "SELECT ID_Administrator, Username FROM Administrator WHERE Username='$username' AND Password='".md5($password)."' LIMIT 1;";
		$stmt = $this->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$result) {
			$sql = "SELECT ID_Professional, Username FROM Professional WHERE Username='$username' AND Password='".md5($password)."' LIMIT 1;";
			$stmt = $this->getLink()->prepare($sql);
			$stmt->execute();
			$result2 = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($result2) {
				$info['userid'] = $result2['ID_Professional'];
				$info['usertype'] = "Professional";
				$info['username'] = $result2['Username'];
			}
		} else {
			$info['userid'] = $result['ID_Administrator'];
			$info['usertype'] = "Administrator";
			$info['username'] = $result['Username'];
		}
		return $info;
    }

    public function registeredLogin($username, $password) {
    	die(md5($password));
    	$sql = "SELECT ID_Registered FROM Registered WHERE Username='$username' AND Password='".md5($password)."';";
		$stmt = $this->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
    }

    public function getRegisteredUsers($order) {
    	$registered = new RegisteredDAO();
    	return $registered->showRegistereds($order);
    }

    public function registeredBackLogin($username, $password) {
    	$registered = new RegisteredDAO();
		return $registered->login($username, $password);
    }

    public function getAdministratorUsers($order) {
    	$administrator = new AdministratorDAO();
    	return $administrator->showAdministrators($order);
    }

    public function getProfessionalUsers($order) {
    	$professional = new ProfessionalDAO();
    	return $professional->showProfessionals($order);
    }

    public function getAllProfessionalInfo($id) {
		$professionalDAO = new professionalDAO();
		$professional = $professionalDAO->getAllProfessionalInfo($id);
		return $professional;
	}

    public function updateAllProfessionalUser($professional2) {
    	$professional = new ProfessionalDAO();
    	return $professional->updateAllProfessionalUser($professional2);
    }

    public function deleteProfessional($id) {
		$professional = new ProfessionalDAO();
		$professional = $professional->deleteProfessionalUser($id);	
		return $professional;
	}

	public function deleteAdministrator($id) {
		$administrator = new AdministratorDAO();
		$administrator = $administrator->deleteAdministratorUser($id);
		return $administrator;		
	}

	public function updateAllAdministratorUser($admin) {
    	$administrator = new AdministratorDAO();
    	return $administrator->updateAllAdministratorUser($admin);
    }

    public function getAllAdministratorInfo($id) {
		$administratorDAO = new administratorDAO();
		$administrator = $administratorDAO->getAllAdministratorInfo($id);
		return $administrator;
	}

	public function getPrivateMessages($id) {
		$registered = new RegisteredDAO();
		return $registered->getPrivateMessages($id);
	}

	//Función de mensajes privados de los usuarios registrados
	public function sendPrivateMessage($myMessage,$receiverName) {
		$registered = new RegisteredDAO();
		return $registered->sendPrivateMessage($myMessage, $receiverName);		
	}

	public function sendReport($myReport,$reportuserName) {
		$report = new ReportDAO();
		return $report->sendReport($myReport, $reportuserName);		
	}
public function sendComplain($myComplain) {
		$complain = new ComplaintDAO();
		return $complain->sendComplain($myComplain);		
	}



	public function getAdministratorReports($id, $order) {
		$reportDAO = new reportDAO();
		return $reportDAO->getAdministratorReports($id, $order);
	}

		public function getProfessionalReports($id, $order) {
		$reportDAO = new reportDAO();
		return $reportDAO->getProfessionalReports($id, $order);
	}


	/* Consulta para obtener una lista con los nombres de las plataformas */
	public function getPlatformNames() {

		try {
			$query = ("SELECT Name FROM platform;");
			$resultat = $this->getLink()->prepare($query);
			$resultat->execute();
			$result = $resultat->FetchAll();
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}
	}

	//Consulta para obtener la cantidad de juegos por plataforma
	public function countGameForPlatform() {

		try {
			$query = ("SELECT p.Name, COUNT(*) AS 'Total' FROM game g INNER JOIN platform p ON g.Platform_ID = p.ID_Platform GROUP BY p.Name;");
			$resultat = $this->getLink()->prepare($query);
			$resultat->execute();
			$result = $resultat->FetchAll();
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}
	}

	//Consulta para obtener la cantidad de usuarios administrator, professional y registered
	public function countUsersForType() {

		try {
			$query = ("SELECT count(*) AS 'Admin', (SELECT count(*) FROM professional) AS 'Professional', 
				(SELECT count(*) FROM registered) AS 'Registered' FROM administrator;");
			$resultat = $this->getLink()->prepare($query);
			$resultat->execute();
			$result = $resultat->FetchAll();
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}
	}

	/* Consulta para obtener una lista con los nombres de los géneros */
	public function getGenreNames() {

		try {
			$query = ("SELECT Name FROM genre;");
			$resultat = $this->getLink()->prepare($query);
			$resultat->execute();
			$result = $resultat->FetchAll();
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}
	}

	//Consulta para obtener la cantidad de juegos por género
	public function countGameForGenre() {

		try {
			$query = ("SELECT gen.Name, COUNT(*) AS 'Total' FROM genre gen INNER JOIN game_has_genre rel ON gen.ID_Genre = rel.Genre_ID 
				INNER JOIN game g ON rel.Game_ID = g.ID_Game GROUP BY gen.Name;");
			$resultat = $this->getLink()->prepare($query);
			$resultat->execute();
			$result = $resultat->FetchAll();
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}
	}

	public function getReport($id_user, $id_report, $group) {
		$reportDAO = new reportDAO();
		switch($group) {
			case "administrator":
				$result = $reportDAO->getAdminReport($id_user, $id_report);
			break;

			case "professional":
				$result = $reportDAO->getProfessionalReport($id_user, $id_report);
			break;
		}
		return $result;
	}

	public function changeReportStatus($id_user, $id_report, $group, $status) {
		$reportDAO = new reportDAO();
		switch($group) {
			case "administrator":
				$result = $reportDAO->changeAdminReportStatus($id_user, $id_report, $status);
			break;

			case "professional":
				$result = $reportDAO->changeProfessionalReportStatus($id_user, $id_report, $status);
			break;
		}
		return $result;
	}

	public function setReportRead($id, $read) {
		$reportDAO = new reportDAO();
		$reportDAO->setReportRead($id, $read);
	}

	public function getAllComplaints($order) {
		$complaintDAO = new complaintDAO();
		$result = $complaintDAO->getAllComplaints($order);
		return $result;
	}

	public function getComplaint($id) {
		$complaintDAO = new complaintDAO();
		$result = $complaintDAO->getComplaint($id);
		return $result;
	}

	public function changeComplaintStatus($id, $status) {
		$complaintDAO = new complaintDAO();
		$result = $complaintDAO->changeComplaintReportStatus($id, $status);
		return $result;
	}

	public function setComplaintRead($id, $read) {
		$complaintDAO = new complaintDAO();
		$complaintDAO->setComplaintRead($id, $read);
	}

	public function getGameComments($id) {
		$commentDAO = new commentDAO();
		return $commentDAO->getGameComments($id);
	}

	public function getGameValoration($id) {
		$valorationDAO = new valorationDAO();
		return $valorationDAO->getGameValoration($id);
	}

	public function userInsertValoration($userid, $gameid, $rate) {
		$valorationDAO = new valorationDAO();
		return $valorationDAO->userInsertValoration($userid, $gameid, $rate);
	}


	/* USERS LIST */

	public function getAllRegistered() {
		$registeredDAO = new registeredDAO();
		return $registeredDAO->getAllRegistered();
	}

	public function getAllProfessional() {
		$professionalDAO = new professionalDAO();
		return $professionalDAO->getAllProfessional();
	}

	public function getAllAdministrator() {
		$administratorDAO = new administratorDAO();
		return $administratorDAO->getAllAdministrator();
	}

	/* SHOPPING */
	public function insertShopping($shopping, $userid) {
        $status = null;
        $query = "INSERT INTO shopping VALUES('', '" . $shopping->getQuantity() . "', '" . $shopping->getTotalPrice() . "','".$shopping->getTax()."')";
        $resultat = $this->getLink()->prepare($query);
        $status = $resultat->execute();
        if($status) {
			$shoppingid = $this->getLink()->lastInsertId();
			for ($i=0; $i < count($shopping->getGames()); $i++) {
				$gameid = $shopping->getGames()[$i]->getId();
				$queryUpdGame = "UPDATE game SET Stock='".($shopping->getGames()[$i]->getStock()-1)."' WHERE ID_Game=$gameid";
				$resultUpdGame = $this->getLink()->prepare($queryUpdGame);
        		$resultUpdGame->execute();
				$query2 = "INSERT INTO game_has_shopping (Game_ID , Shopping_ID, Registered_ID) VALUES ($gameid, $shoppingid, $userid)";
				$result = $this->getLink()->prepare($query2);
				$status = $result->execute();
			}
		}
        return $status;
    }

    public function updateGame($game) {
		$gameDAO = new gameDAO();
		return $gameDAO->updateGame($game);
	}
}
?>