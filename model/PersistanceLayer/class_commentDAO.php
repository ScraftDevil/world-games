<?php
require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

class commentDAO {

    /*public function insertGame($games) {

        $query = "insert into game values('', '" . $games->getTitle() . "', '" . $games->getPrice() . "', '" . 0 ."','".$games->getPlatform()."')";

        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        $resultat->execute();

        return $resultat;
    }*/

	 function getAllComment($order) {

		$orderSQL = "";
			if (!empty($order)) {
				$orderSQL = "ORDER BY ".$order;
			}


			$sql = "SELECT C.ID_Comment, C.Text, C.Date ,(SELECT G.Title FROM game G WHERE G.ID_Game = RC.Game_ID) as Titlegame, (SELECT R.Username FROM registered R WHERE R.ID_Registered = RC.Registered_ID) as Userowner FROM comment as C INNER JOIN registered_has_comment as RC ON C.ID_Comment = RC.Comment_ID  $orderSQL ";
			
			$db = unserialize($_SESSION['dbconnection']);
			$stmt = $db->getLink()->prepare($sql);
			$stmt->execute();
			$result = $stmt->FetchAll();
			return $result;
		}
	

	 function getGameComments($id) {
		try {
	        $db = unserialize($_SESSION['dbconnection']);
	        $sqlUser = "(SELECT R.Username FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as Usuario";
			$sqlUserAvatar = "(SELECT R.AvatarURL FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as AvatarURL";
			$sqlUserID = "(SELECT R.ID_Registered FROM registered R WHERE R.ID_Registered=RC.Registered_ID) as UserID";
			$sql = "SELECT C.ID_Comment, C.Game_ID, C.Text, C.Date , ".$sqlUser.", ".$sqlUserAvatar.", ".$sqlUserID." FROM comment C INNER JOIN registered_has_comment RC WHERE C.ID_Comment=RC.Comment_ID AND C.Game_ID = ".$id;
	        $stmt = $db->getLink()->prepare($sql);
	        $stmt->execute();
	        $result = $stmt->fetchAll();
	     } catch (PDOException $e) {
	        print "¡Error!: " . $e->getMessage() . "<br/>";
	        die();
	    } finally {
	       return $result;
	    }
	}
}

?>