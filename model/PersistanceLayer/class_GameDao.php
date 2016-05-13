<?php
require_once("controller/function_Autoload.php");

class GameDao {

    public function addGame($game) {

        $query = "insert into game values('', '" . $game->getTitle() . "', '" . $game->getPrice() . "', '" . $game->getStock()  "')";

        $db = unserialize($_SESSION['pdo']);
        $resultat = $db->connectarBD()->prepare($query);
        $resultat->execute();

        return $resultat;
    }
 ?>