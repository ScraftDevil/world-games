<?php
require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

class messageDAO {

    public function insertGame($games) {

        $query = "insert into game values('', '" . $games->getTitle() . "', '" . $games->getPrice() . "', '" . 0 ."','".$games->getPlatform()."')";

        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();

        return $resultat;
    }

   

public function getAllMessages($order) {

	$orderSQL = "";
		if (!empty($order)) {
			$orderSQL = "ORDER BY ".$order;
		}

//".$sqlRegistered." ".$sqlReceiver." INTENTO DE SUBSELECT
		/*$sqlRegistered = ", (SELECT R.Username FROM registered R WHERE R.Registered_ID = R.ID_Registered) as registered";
		$sqlReceiver = ", (SELECT R.Username FROM registered R WHERE R.Receiver_ID = R.ID_Registered) as receiver";*/
		$sql = "SELECT M.ID_Message, M.Content, M.Date FROM message M $orderSQL ";
		$db = unserialize($_SESSION['dbconnection']);
		$stmt = $db->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}
}
?>