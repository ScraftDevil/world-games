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
        $this->populateGames($db->getGames());
        //end get data games
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

    function populateGames($list) {
        foreach ($list as $row) {
            $idGame = $row['ID_Game'];
            $gameObj = new Game($row['Title'], $row['Price'], $row['Stock']);
            $gameObj->setID($idGame);
            $offer = new Offer($row['Discount']);
            //$plataform = new Plataform($row['Plataform']);
            //$genres = $gameObj->getGenresGame($idGame);
            /*
            $genresObj = array();
            foreach ($genre as $genres) {
                  $genresObj[] = new Genre($genre['Genre']);
            }*/
            $gameObj->setOffer($offer);
            //$gameObj->setGenres($genre);
            //$gameObj->setPlataform($plataform);
            array_push($this->games, $gameObj);
        }
    }
}

?>