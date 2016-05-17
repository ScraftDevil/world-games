<?php
require_once("../model/autoload.php");

class gameDAO {

    public function insertGame($games) {

        $query = "insert into game values('', '" . $games->getTitle() . "', '" . $games->getPrice() . "', '" . 0 ."','".$games->getPlataform()."')";

        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();

        return $resultat;
    }

}
 ?>