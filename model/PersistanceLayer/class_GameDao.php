<?php
require_once("../model/autoload.php");

class gameDAO {

    public function addGame($game) {

        $query = "insert into game values('', '" . $game->getTitle() . "', '" . $game->getPrice() . "', '" . 0 ."')";

        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();

        return $resultat;
    }

}
 ?>