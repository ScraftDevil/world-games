<?php
require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

class genreDAO {

   

    
public function deleteGenre($id) {

		try {
			
			$query = ("DELETE FROM genre WHERE ID_Genre = '$id'");

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

	/*function getGenreByID($idgenre) {
		$db = unserialize($_SESSION['dbconnection']);
		$sql = "SELECT ID_Genre, Name FROM genre WHERE ID_Genre = '".$idgenre."'";
        $stmt = $db->getLink()->prepare($sql); 
        $stmt->execute();
        $result = $stmt->FetchAll();
        return $result;
	}*/
}
?>