<?php
require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

class genreDAO {

   public function insertGenre($genre) {
       // $statusResult = 0;
        $db = unserialize($_SESSION['dbconnection']);
        $query = "insert into genre values('', '" . $genre->getName() . "')";
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();
        	        
        return $resultat;
    }
   
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

	
}
?>