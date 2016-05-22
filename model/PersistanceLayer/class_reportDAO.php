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

			$query = ("SELECT ID_Report, Status, Date, Reason, Text, (SELECT Username FROM registered WHERE ID_Registered=Registered_ID) AS User FROM report WHERE ID_Report IN (SELECT Report_ID FROM administrator_has_report WHERE Administrator_ID='$id') $orderSQL");

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

}

?>