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
		$sqlDiscount = "(SELECT O.Discount FROM game_has_offer GO INNER JOIN offer O
		WHERE GO.Game_ID = G.ID_Game AND O.ID_Offer = GO.Offer_ID) as Discount";
		$sqlGenre = "(SELECT GE.Name FROM game_has_genre GG INNER JOIN Genre GE
		WHERE GG.Game_ID = G.ID_Game AND GE.ID_Genre = GG.Genre_ID) as Genre";
		$sqlPlatafform = "(SELECT GE.Name FROM game_has_plataform GG INNER JOIN plataform GE
		WHERE GG.Game_ID = G.ID_Game AND GE.ID_Plataform = GG.Plataform_ID) as Plataform";
		$sql = "SELECT G.ID_Game, G.Title, G.Price, G.Stock, " . $sqlDiscount . ", " . $sqlGenre . ", " . $sqlPlatafform . "  
		FROM game G WHERE G.Stock>0";
	    $stmt = $this->getLink()->prepare($sql); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getProfessional($username, $password) {
	    $stmt = $this->getLink()->prepare("SELECT ID_Professional FROM professional WHERE Username='$username' AND Password='$password' LIMIT 1;"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

}
?>