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

	//get data of database
	public function getTypeReparations() {
	    $stmt = $this->getLink()->prepare("SELECT Code, Description FROM TypeReparations"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getTypeReparationByCode($code) {
	    $stmt = $this->getLink()->prepare("SELECT Code, Description FROM TypeReparations WHERE Code=$code"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getReparations() {
	    $stmt = $this->getLink()->prepare("SELECT StartDate, Time, TeamMechanic, Owner, Car, TypeReparation FROM Reparations"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getTeamsMechanics() {
	    $stmt = $this->getLink()->prepare("SELECT ID, Name FROM TeamsMechanics"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getMechanics($teamMechanicID) {
	    $stmt = $this->getLink()->prepare("SELECT ID, Name FROM Mechanics WHERE TeamMechanic=$teamMechanicID"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getOwners() {
	    $stmt = $this->getLink()->prepare("SELECT NIF, Name, Surname, Lastname, Car, Birthdate FROM Owners"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getOwner($ownerID) {
	    $stmt = $this->getLink()->prepare("SELECT NIF, Name, Surname, Lastname, Car FROM Owners WHERE  ID=$ownerID"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getCar($idCar) {
	    $stmt = $this->getLink()->prepare("SELECT RegistrationPlate, Brand, Model, FuelType FROM Cars WHERE id=$idCar"); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getOwnersCar($order) {
		if (!empty($order)) {
			$sql = "SELECT O.NIF, O.Name, O.Surname, O.Lastname, O.Birthdate, C.RegistrationPlate, C.Brand, C.Model, C.FuelType FROM Owners O, Cars C WHERE C.ID=O.Car ORDER BY ".$order.";";
		} else {
			$sql = "SELECT O.NIF, O.Name, O.Surname, O.Lastname, O.Birthdate, C.RegistrationPlate, C.Brand, C.Model, C.FuelType FROM Owners O, Cars C WHERE C.ID=O.Car;";
		}
	    $stmt = $this->getLink()->prepare($sql); 
	    $stmt->execute();
	    $result = $stmt->FetchAll();
	    return $result;
	}

	public function getStatsReparations() {
		$statsReparations = array();
		$owners = $this->getOwners();
		for ($i=0; $i < count($owners); $i++) {
			$nifowner = $owners[$i][0];
			$sql = "SELECT COUNT(R.ID) AS numberReparations, O.NIF FROM Reparations R INNER JOIN Owners O WHERE O.ID=R.Owner AND O.NIF='$nifowner'";
			$stmt = $this->getLink()->prepare($sql); 
		    $stmt->execute();
		    $reparations = $stmt->FetchAll(PDO::FETCH_CLASS);
		    for ($j=0; $j < count($reparations); $j++) {
		    	$statsReparations[] = $reparations[0];
		    }
		}
	    return $statsReparations;
	}

	public function getOpinions() {
		$sql = "SELECT O.username, O.message, O.date FROM Opinions O";
		$stmt = $this->getLink()->prepare($sql); 
		$stmt->execute();
	    $result = $stmt->FetchAll();
	    $list = array();
	    for ($i=0; $i < count($result); $i++) {
	    	array_push($list, new Opinion($result[$i][0], $result[$i][1], $result[$i][2]));
	    }
	    return $list;
	}
}
?>