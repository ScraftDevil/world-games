<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

class ComplaintDAO {

	public function getAllComplaints($order) {

		try {
			$orderSQL = "";
			if (!empty($order)) {
				$orderSQL = "ORDER BY 3, 2, ".$order;
			} else {
				$orderSQL = "ORDER BY 3, 2";
			}

			$query = ("SELECT c.ID_Complaint, c.Status, c.Date, c.Reason, g.Title AS 'GameComplainted', p.Name AS 'Platform', r.Username AS 'User' FROM complaint c INNER JOIN game_has_complaint gc INNER JOIN game g INNER JOIN platform p INNER JOIN registered r ON c.ID_Complaint=gc.Complaint_ID AND gc.Game_ID=g.ID_Game AND gc.Registered_ID=r.ID_Registered GROUP BY 1 $orderSQL");

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

	public function sendComplain($myComplain) {

		
		$idReport = "";
		$proces = "";

		try {
$report = utf8_decode($myComplain->getContentcomplain());
			/*$query = ('SELECT ID_Registered FROM Registered WHERE Username = "'.$reportuserName.'";');
			
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
        	$result = $resultat->fetch(PDO::FETCH_ASSOC);*/

        	//if($result) {

        		//id of receiver user
        		//$idReport = $result['ID_Registered'];
$db = unserialize($_SESSION['dbconnection']);
        		$query = ("INSERT INTO complaint values('','".$myComplain->getReason()."', '".$myComplain->getContentcomplain()."',sysdate(),'No Leído')");
        		
        		$resultat = $db->getLink()->prepare($query);
        		$result = $resultat->execute();

        		if($result) {

        			//id of new message
        			$newIdComplain = $db->getLink()->lastInsertId();

        			$query = ("INSERT INTO game_has_complaint values('2', 
        				'".$newIdComplain."', '2')");
        			$resultat = $db->getLink()->prepare($query);
        			$result = $resultat->execute();

        			$proces = "success";
        		}     		

        	/*} else {
        		$proces = "username";
        	}*/
			
		} catch (PDOException $e) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $proces;
			$_SESSION['dbconnection'] = serialize($db);			
		}
	}


}

?>