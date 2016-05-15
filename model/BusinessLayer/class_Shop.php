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

   function populateGames($db) {
        $games = $db->getGames();
        foreach ($games as $game) {
            $genresObj = array();
            $idGame = $game['ID_Game'];
            $genres = $db->getGenresGame($idGame);
            $gameObj = new Game($game['Title'], $game['Price'], $game['Stock']);
            $gameObj->setID($idGame);
            $offer = new Offer($game['Discount']);
            foreach ($genres as $genre) {
                $g = new Genre($genre['Name']);
                $g->setId($genre['ID_Genre']);
                $genresObj[] = $g;
            }
            $plataform = new Plataform($game['Plataform']);
            $gameObj->setOffer($offer);
            $gameObj->setGenres($genresObj);
            $gameObj->setPlataform($plataform);
            array_push($this->games, $gameObj);
        }
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
            } else if ($type=="plataform") {
                if (strtolower($game->getPlataform()->getName())==strtolower($filter)) {
                        $gamesFiltered[] = $game;
                    }
            }
        }
        return $gamesFiltered;
    }
}

?>