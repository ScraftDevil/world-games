<?php

require_once($_SESSION['BASE_PATH']."/model/autoload.php");

class reportDAO {

	public function getAdministratorReports($id, $order) {

		try {
			$orderSQL = "";
			if (!empty($order)) {
				$orderSQL = "ORDER BY 3, 2, ".$order;
			} else {
				$orderSQL = "ORDER BY 3, 2";
			}
			$query = ("SELECT rp.ID_Report, rp.Status, rp.Date, rp.Reason, rp.Text, r.Username AS 'UserReported', re.Username AS 'UserReclaim' FROM report rp INNER JOIN registered r INNER JOIN administrator_has_report ar INNER JOIN registered re ON r.ID_Registered=rp.Registered_ID AND ar.Registered_ID=re.ID_Registered WHERE ar.Administrator_ID='$id' GROUP BY 1 $orderSQL");

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

	public function getProfessionalReports($id, $order) {

		try {
			$orderSQL = "";
			if (!empty($order)) {
				$orderSQL = "ORDER BY 3, 2, ".$order;
			} else {
				$orderSQL = "ORDER BY 3, 2";
			}
			$query = ("SELECT rp.ID_Report, rp.Status, rp.Date, rp.Reason, rp.Text, r.Username AS 'UserReported', re.Username AS 'UserReclaim' FROM report rp INNER JOIN registered r INNER JOIN professional_has_report pr INNER JOIN registered re ON r.ID_Registered=rp.Registered_ID AND pr.Registered_ID=re.ID_Registered WHERE pr.Professional_ID='$id' GROUP BY 1; $orderSQL");

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

	

	public function getAdminReport($id_admin, $id_report) {

		try {

			$query = ("SELECT ID_Report, Status, Date, Reason, Text, (SELECT Username FROM registered WHERE ID_Registered=Registered_ID) AS UserReported, (SELECT r.Username FROM registered r INNER JOIN administrator_has_report ar ON r.ID_Registered=ar.Registered_ID) AS UserReclaim FROM report WHERE ID_Report IN (SELECT Report_ID FROM administrator_has_report WHERE Administrator_ID='$id_admin') AND ID_Report='$id_report'");

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

	public function getProfessionalReport($id_professional, $id_report) {

		try {

			$query = ("SELECT ID_Report, Status, Date, Reason, Text, (SELECT Username FROM registered WHERE ID_Registered=Registered_ID) AS UserReported, (SELECT r.Username FROM registered r INNER JOIN professional_has_report pr ON r.ID_Registered=pr.Registered_ID) AS UserReclaim FROM report WHERE ID_Report IN (SELECT Report_ID FROM professional_has_report WHERE Administrator_ID='$id_professional') AND ID_Report='$id_report'");;

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

	public function changeAdminReportStatus($id_admin, $id_report, $status) {
		$proces = null;
		try {
			$result = $this->getAdminReport($id_admin, $id_report);
			if(!$result) {
				$proces = "invalid-operation";
			} else {
				$query = ("UPDATE report SET Status=:status WHERE ID_Report=:id_report");
				$db = unserialize($_SESSION['dbconnection']);
				$resultat = $db->getLink()->prepare($query);
				$resultat->bindParam(':status', utf8_decode($status));
				$resultat->bindParam(':id_report', $id_report);
				$resultat->execute();
				$result = $resultat->FetchAll();
				$proces = "success";
			}			

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $proces;		
		}
	}

	public function changeProfessionalReportStatus($id_professional, $id_report, $status) {
		$proces = null;
		try {
			$result = $this->getProfessionalReport($id_professional, $id_report);
			if(!$result) {
				$proces = "invalid-operation";
			} else {
				$query = ("UPDATE report SET Status=:status WHERE ID_Report=:id_report");
				$db = unserialize($_SESSION['dbconnection']);
				$resultat = $db->getLink()->prepare($query);
				$stmt->bindParam(':status', $status);
				$stmt->bindParam(':id_report', $id_report);
				$resultat->execute();
				$result = $resultat->FetchAll();
				$proces = "success";
			}			

		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $proces;		
		}
	}

	public function setReportRead($id, $read) {
		try {
			$query = ("UPDATE report SET Status=:status WHERE ID_Report=:id_report");
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
			$resultat->bindParam(':status', $read);
			$resultat->bindParam(':id_report', $id);
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


	public function sendReport($myReport,$reportuserName) {

		$report = utf8_decode($myReport->getContentreport());
		$idReport = "";
		$proces = "";

		try {

			$query = ('SELECT ID_Registered FROM Registered WHERE Username = "'.$reportuserName.'";');
			$db = unserialize($_SESSION['dbconnection']);
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
        	$result = $resultat->fetch(PDO::FETCH_ASSOC);

        	if($result) {

        		//id of receiver user
        		$idReport = $result['ID_Registered'];

        		$query = ("INSERT INTO report values('','No Leído',sysdate(),'".$myReport->getReason()."', '".$myReport->getContentreport()."','".$idReport."')");
        		//die($query);
        		$resultat = $db->getLink()->prepare($query);
        		$result = $resultat->execute();

        		if($result) {

        			//id of new message
        			$newIdReport = $db->getLink()->lastInsertId();

        			$query = ("INSERT INTO professional_has_report values('1', 
        				'".$newIdReport."', '".$idReport."')");
        			$resultat = $db->getLink()->prepare($query);
        			$result = $resultat->execute();

        			$proces = "success";
        		}     		

        	} else {
        		$proces = "username";
        	}
			
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