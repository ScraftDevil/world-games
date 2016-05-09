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

	/*
	public function getCar($idCar) {
	    $stmt = $this->getLink()->prepare("SELECT RegistrationPlate, Brand, Model, FuelType FROM Cars WHERE id=$idCar"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}*/
}
?>