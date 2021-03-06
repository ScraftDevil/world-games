<?php

class Shop {

    private $id;
    private $name;
    private $users = null;
    private $games = null;

    function __construct($name) {
        $this->setName($name);
        $this->setUsers(array());
        $this->setGames(array());
    }

    function populateShop() {
        //db querys here
        $db = unserialize($_SESSION['dbconnection']);
        //reset arrays
        $this->users = array();
        $this->games = array();
        //get data for array games from database
        $this->populateGames($db);
        $this->populateUsers($db);
        //end get data games
        $this->getGenres();
    }

    function getName() {
        return $this->name;
    }

    function getUsers() {
        return $this->users;
    }

    function getGames() {
        return $this->games;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUsers($users) {
        $this->users = $users;
    }

    function setGames($games) {
        $this->games = $games;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

   	function populateGames($db) {
        $games = $db->getGames();
        foreach ($games as $game) {
            $genresObj = array();
            $idGame = $game['ID_Game'];
            $genres = $db->getGenresGame($idGame);
            $gameObj = new Game($game['Title'], $game['Price']);
            $gameObj->setId($idGame);
            $gameObj->setStock($game['Stock']);
            $offer = new Offer($game['Discount']);
            foreach ($genres as $genre) {
                $g = new Genre($genre['Name']);
                $g->setId($genre['ID_Genre']);
                $genresObj[] = $g;
            }
            $platform = new Platform($game['Platform']);
            $gameObj->setOffer($offer);
            $gameObj->setGenres($genresObj);
            $gameObj->setPlatform($platform);
            array_push($this->games, $gameObj);
        }
    }

    /**
    /*  USER FUNCTIONS
    /**/

    function populateUsers($db) {
        $this->users = array();
        $registereds = $db->getAllRegistered();
        $professionals = $db->getAllProfessional();
        $administrators = $db->getAllAdministrator();
        foreach ($registereds as $row) {
            $id = $row['ID_Registered'];
            $username = $row['Username'];
            $email = $row['Email'];
            $bannedtime = $row['BannedTime'];
            $birthdate = $row['BirthDate'];
            $paypal = $row['PaypalAccount'];
            $country = $row['Country_ID'];
            $registered = new Registered($username, "", $email, $birthdate, $country);
            $registered->setId($id);
            $registered->setBannedTime($bannedtime);
            $registered->setPaypalAccount($paypal);
            array_push($this->users, $registered);
        }
        foreach ($professionals as $row) {
            $id = $row['ID_Professional'];
            $username = $row['Username'];
            $email = $row['Email'];
            $bannedtime = $row['BannedTime'];
            $birthdate = $row['BirthDate'];
            $phone = $row['Telephone'];
            $professional = new Professional($username, "", $email, $birthdate, $phone);
            $professional->setId($id);
            $professional->setBannedTime($bannedtime);
            $professional->setTelephone($phone);
            array_push($this->users, $professional);
        }
        foreach ($administrators as $row) {
            $id = $row['ID_Administrator'];
            $username = $row['Username'];
            $email = $row['Email'];
            $bannedtime = $row['BannedTime'];
            $birthdate = $row['BirthDate'];
            $administrator = new Administrator($username, "", $email, $birthdate);
            $administrator->setId($id);
            $administrator->setBannedTime($bannedtime);
            array_push($this->users, $administrator);
        }
    }

    function addRegistered($username, $password, $email, $birthdate, $country) {
    	$birthdate = date('Y-m-d', strtotime($birthdate));
    	$password = md5($password);
    	$registered = new Registered($username, $password, $email, $birthdate, $country);
		$proces = $registered->insertRegistered();
		if ($proces == "success") {
			array_push($this->users, $registered);
		}
		return $proces;
    }

    function updateAdminRegistered($id, $username, $password, $email, $bannedtime, $birthdate, $paypal, $avatar, $country) {
        if ($password != null && $password != "") {
            $password = md5($password);
        }
        $birthdate = date('Y-m-d', strtotime($birthdate));
        $registered = new Registered($username, $password, $email, $birthdate, $country);
        $registered->setId($id);
        $registered->setBannedTime($bannedtime);
        $registered->setPaypalAccount($paypal);
        $registered->setAvatarUrl($avatar);
        $registered->setCountry($country);
        $db = unserialize($_SESSION['dbconnection']);
        $proces = $db->updateAllRegisteredUser($registered);
        $this->populateUsers($db);
        return $proces;
    }

    function deleteRegistered($id) {
        $db = unserialize($_SESSION['dbconnection']);
        $proces = $db->deleteRegistered($id);
        $this->populateUsers($db);
        return $proces;
    }

    function addProfessional($username, $password, $email, $birthdate) {
        $birthdate = date('Y-m-d', strtotime($birthdate));
        $password = md5($password);
        $professional = new Professional($username, $password, $email, $birthdate);
        $proces = $professional->insertProfessional();
        if ($proces == "success") {
            array_push($this->users, $professional);
        }
        return $proces;
    }

    function updateAdminProfessional($id, $username, $password, $email, $bannedtime, $birthdate, $phone) {
    	if ($password != null && $password != "") {
            $password = md5($password);
        }
        $birthdate = date('Y-m-d', strtotime($birthdate));
        $professional = new Professional($username, $password, $email, $birthdate);
        $professional->setId($id);
        $professional->setTelephone($phone);
        $db = unserialize($_SESSION['dbconnection']);
    	$proces = $db->updateAllProfessionalUser($professional);
    	return $proces;
    }

    function deleteProfessional($id) {
        $db = unserialize($_SESSION['dbconnection']);
        $proces = $db->deleteProfessional($id);
        $this->populateUsers($db);
        return $proces;
    }

    function addAdministrator($username, $password, $email, $birthdate) {
        $birthdate = date('Y-m-d', strtotime($birthdate));
        $password = md5($password);
        $administrator = new Administrator($username, $password, $email, $birthdate);
        $proces = $administrator->insertAdministrator();
        if ($proces == "success") {
            array_push($this->users, $administrator);
        }
        return $proces;
    }

    function updateAdminAdministrator($id, $username, $password, $email, $bannedtime, $birthdate) {
    	if ($password != null && $password != "") {
            $password = md5($password);
        }
        $birthdate = date('Y-m-d', strtotime($birthdate));
        $administrator = new Administrator($username, $password, $email, $birthdate);
        $administrator->setId($id);
        $db = unserialize($_SESSION['dbconnection']);
    	$proces = $db->updateAllAdministratorUser($administrator);
    	return $proces;
    }

    function deleteAdministrator($id) {
        $db = unserialize($_SESSION['dbconnection']);
        $proces = $db->deleteAdministrator($id);
        $this->populateUsers($db);
        return $proces;
    }

    function getUserWithGroup($id, $group) {
        $db = unserialize($_SESSION['dbconnection']);
        $info = null;
        switch($group) {
            case "registered":
                $info = $db->getAllRegisteredInfo($id);
            break;
            case "professional":
            	$info = $db->getAllProfessionalInfo($id);
            break;
            case "administrator":
            	$info = $db->getAllAdministratorInfo($id);
            break;
        }
        return json_encode($info);
    }

    /**/
    /*  Country Functions
    /**/

    function getCountrybyName($name) {
        $db = unserialize($_SESSION['dbconnection']);
        $country = $db->getCountrybyName($name);
        return $country;
    }

    function getCountries() {
        $db = unserialize($_SESSION['dbconnection']);
        $countries = $db->getCountries();
        return $countries;
    }

  	function addGame($title,$price) {

        $games = new Game($title,$price);

        $games->addGameDb($games);
        array_push($this->games, $games);

        return $games;
    }

    function getGame($idgame) {
        $gamefound = null;
        $games = $this->getGames();
        foreach ($games as $game) {
            if ($game->getId()==$idgame) {
                $gamefound = $game;
            }
        }
        return $gamefound;
    }

    function getPlatform($id) {
        $db = unserialize($_SESSION['dbconnection']);
        $name = $db->getPlatformById($id);
        return $name[0][0];
    }

    function updatePlatform($name, $id) {
        $db = unserialize($_SESSION['dbconnection']);
        $proces = $db->updatePlatform($name, $id);
        return $proces;
    }

    function getGenre($id) {
        $db = unserialize($_SESSION['dbconnection']);
        $name = $db->getGenreById($id);
        return $name[0][0];
    }

    function updateGenre($name, $id) {
        $db = unserialize($_SESSION['dbconnection']);
        $proces = $db->updateGenre($name, $id);
        return $proces;
    }

    function filterGames($filter, $type) {
        $gamesFiltered = array();
        $games = $this->getGames();
        foreach ($games as $game) {
            if ($type=="genre") { 
                foreach($game->getGenres() as $genre) {
                    if ($genre->getName()==$filter) {
                        $gamesFiltered[] = $game;
                    }
                }
            } else if ($type=="platform") {
                if (strtolower($game->getPlatform()->getName())==strtolower($filter)) {
                        $gamesFiltered[] = $game;
                    }
            }
        }
        return $gamesFiltered;
    }

    function getGenres() {
        $db = unserialize($_SESSION['dbconnection']);
        $genres = $db->getGenre();
        $genresObjList = array();
        foreach ($genres as $genre) {
            $genreObj = new Genre($genre['Name']);
            $genreObj->setId($genre['ID_Genre']);
            $genresObjList[] = $genreObj;
        }
        return $genresObjList;
    }

    function getPlatforms() {
        $db = unserialize($_SESSION['dbconnection']);
        $platforms = $db->getPlatform();
        $platformsObjList = array();
        foreach ($platforms as $platform) {
            $platformObj = new Platform($platform['Name']);
            $platformObj->setId($platform['ID_Platform']);
            $platformsObjList[] = $platformObj;
        }
        return $platformsObjList;
    }

    function getRegistered($idregistered) {
        $registeredfound = null;
        $registereds = $this->getUsers();
        foreach ($registereds as $registered) {
            if ($registered->getId()==$idregistered) {
                $registeredfound = $registered;
            }
        }
        return $registeredfound;
    }

    function insertShopping($shopping, $userid) {
        $db = unserialize($_SESSION['dbconnection']);
        return $db->insertShopping($shopping, $userid);
    }
    
    function updateGame($id, $title, $price, $stock, $platform, $genres) {
        $db = unserialize($_SESSION['dbconnection']);
        $genresObjList = array();
        for($i = 0; $i < count($genres); $i++) {
            $genresObjList [] = $this->getGenreByID($genres[$i]);
        }
        $game = new Game($title, $price);
        $game->setId($id);
        $game->setStock($stock);
        $game->setPlatform($this->getPlatformByID($platform));
        $game->setGenres($genresObjList);
        $proces = $db->updateGame($game);
        return $proces;
    }

    function getPlatformByID($idplatform) {
        $platformFound = null;
        $platforms = $this->getPlatforms();
        foreach($platforms as $platform) {
            if ($platform->getId()==$idplatform) {
                $platformFound = $platform;
            }
        }
        return $platformFound;
    }

     function getGenreByID($idgenre) {
        $genreFound = null;
        $genres = $this->getGenres();
        foreach($genres as $genre) {
            if ($genre->getId()==$idgenre) {
                $genreFound = $genre;
            }
        }
        return $genreFound;
    }

    /* Get the reports list of the user */
    function getRegisteredReports($id, $order) {
        $registeredDao = new registeredDAO();
        $reports = $registeredDao->getRegisteredReports($id, $order);
        return $reports;
    }

    /* Get the complaints list of the user */
    function getRegisteredComplaints($id, $order) {
        $registeredDao = new registeredDAO();
        $complaints = $registeredDao->getRegisteredComplaints($id, $order);
        return $complaints;
    }
}

?>