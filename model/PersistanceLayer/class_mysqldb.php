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

	public function getRegisteredInfo($id) {
		$registeredDao = new RegisteredDao();
		$registered = $registeredDao->showRegisteredInfo($id);
		return $registered;
	}

	public function updateRegisteredUser($registered) {
		$registeredDao = new RegisteredDao();
		$registered = $registeredDao->updateRegisteredUser($registered);
	}

	public function deleteRegisteredUser($id) {
		$registeredDao = new RegisteredDao();
		$registered = $registeredDao->deleteRegisteredUser($id);		
	}

	public function searchGame($value) {
    	$sql = "SELECT G.ID_Game, G.Title, G.Price FROM game G WHERE G.Title LIKE '%".$value."%'";
		$stmt = $this->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
    }
}
?>