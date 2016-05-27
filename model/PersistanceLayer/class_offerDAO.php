<?php
require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

class offerDAO {

    public function insertOffer($offer) {
        $statusResult = 0;
        $db = unserialize($_SESSION['dbconnection']);
        $query = "insert into offer values('', '" . $offer->getDiscount() . "')";
        $resultat = $db->getLink()->prepare($query);
        if($resultat->execute()) {
        	$query = "update game set Offer_ID=".$db->getLink()->lastInsertId()." WHERE ID_Game=".$offer->getGame();
        	$resultat = $db->getLink()->prepare($query);
            $statusResult = $resultat->execute();
        }
        return $statusResult;
    }

    public function deleteOffer($id) {

        try {
            
            $query = ("DELETE FROM offer WHERE ID_Offer = '$id'");

            $db = unserialize($_SESSION['dbconnection']);
            $resultat = $db->getLink()->prepare($query);
            $resultat->execute();

        } catch(PDOException $ex) {
            echo "An Error ocurred!";
            some_loggging_function($ex->getMessage());
        } finally {
            return $resultat;
            $_SESSION['dbconnection'] = serialize($shopDb);         
        }
    }
}
 ?>