<?php
require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

class offerDAO {

    public function insertOffer($offer) {
        $query = "insert into offer values('', '" . $offer->getDiscount() . "', '".$offer->getGame()."')";
        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();
        return $resultat;
    }
}
 ?>