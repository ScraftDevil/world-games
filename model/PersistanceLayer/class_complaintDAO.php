<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

class complaintDAO {

	public function getAllComplaints($order) {

		try {
			$orderSQL = "";
			if (!empty($order)) {
				$orderSQL = "ORDER BY 3, 2, ".$order;
			} else {
				$orderSQL = "ORDER BY 3, 2";
			}

			$query = ("SELECT c.ID_Complaint, c.Status, c.Date, c.Reason, (SELECT g.Title FROM game g INNER JOIN game_has_complaint gc INNER JOIN complaint c ON c.ID_Complaint=gc.Complaint_ID AND g.ID_Game=gc.Game_ID) as 'GameComplainted', (SELECT p.Name FROM platform p INNER JOIN game g INNER JOIN game_has_complaint gc ON g.ID_Game=gc.Game_ID AND g.Platform_ID=p.ID_Platform) AS 'Platform', (SELECT r.Username FROM registered r INNER JOIN game_has_complaint gc ON r.ID_Registered=gc.Registered_ID) as 'User' FROM complaint c $orderSQL");

			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
			$resultat->execute();

			$result = $resultat->FetchAll(); 			

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}

	}

	public function changeComplaintStatus($id, $status) {
		$proces = null;
		try {
				$query = ("UPDATE complaint SET Status=:status WHERE ID_Complaint=:id");
				$db = unserialize($_SESSION['dbconnection']);
				$resultat = $db->getLink()->prepare($query);
				$resultat->bindParam(':status', utf8_decode($status));
				$resultat->bindParam(':id', $id);
				$resultat->execute();
				$result = $resultat->FetchAll();
				$proces = "success";		
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $proces;		
		}
	}

	public function setComplaintRead($id, $read) {
		try {
			$query = ("UPDATE report SET Status=:status WHERE ID_Complaint=:id");
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
			$resultat->bindParam(':status', $read);
			$resultat->bindParam(':id', $id);
			$resultat->execute();
			$result = $resultat->FetchAll();
			$proces = "success";		
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $proces;		
		}
	}

}

?>