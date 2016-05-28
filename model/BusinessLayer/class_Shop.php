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
            $gameObj = new Game($game['Title'], $game['Price'], $game['Stock']);
            $gameObj->setId($idGame);
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

    function populateUsers($db) {
        $registereds = $db->getAllRegistered();
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
            $platformObj = new Genre($platform['Name']);
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

    function insertShopping($shopping) {
        $db = unserialize($_SESSION['dbconnection']);
        return $db->insertShopping($shopping);
    }
}

?>