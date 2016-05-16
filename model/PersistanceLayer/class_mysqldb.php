<?php
require_once($_SESSION['BASE_PATH']."config/db.inc.php");

class mysqldb {
	private $dsn, $username, $password, $link;

	public function __construct() {
		$this->setDSN("mysql:dbname=".$GLOBALS['DATABASE'].";host=".$GLOBALS['SERVER']);
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
		$sqlDiscount = ", (SELECT O.Discount FROM Offer O WHERE O.Game_ID = G.ID_Game) as Discount";
		$sqlPlataform = ", (SELECT P.Name FROM plataform P WHERE P.ID_Plataform = G.Plataform_ID) as Plataform";
		$sql = "SELECT G.ID_Game, G.Title, G.Price, G.Stock ".$sqlDiscount." ".$sqlPlataform." FROM game G WHERE G.Stock>0";
		$stmt = $this->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	public function getGenresGame($gameid) {
		$sql = "SELECT GE.ID_Genre, GE.Name FROM game_has_genre GG INNER JOIN Genre GE
		WHERE GE.ID_Genre = GG.Genre_ID AND GG.Game_ID = $gameid";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	public function getCountriesList() {
		$registeredDao = new RegisteredDAO();
		$countries = $registeredDao->getCountriesList();
		return $countries;
	}

	public function getRegisteredInfo($id) {
		$registeredDao = new RegisteredDAO();
		$registered = $registeredDao->getRegisteredInfo($id);
		return $registered;
	}

	public function updateRegisteredUser($registered) {
		$registeredDao = new RegisteredDAO();
		$registered = $registeredDao->updateRegisteredUser($registered);
	}

	public function deleteRegisteredUser($id) {
		$registeredDao = new RegisteredDAO();
		$registered = $registeredDao->deleteRegisteredUser($id);		
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
    	$sql = "SELECT ID_Administrator, Username FROM Administrator WHERE Username='$username' AND Password='$password' LIMIT 1;";
		$stmt = $this->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		if (!$result) {
			$sql = "SELECT ID_Professional, Username FROM Professional WHERE Username='$username' AND Password='$password' LIMIT 1;";
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
    	$sql = "SELECT ID_Registered FROM Registered WHERE Username='$username' AND Password='$password';";
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
}
?>