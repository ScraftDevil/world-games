<?php
require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

class gameDAO {

    public function insertGame($games) {
        $query = "insert into game values('', '" . $games->getTitle() . "', '" . $games->getPrice() . "', '" . 0 ."','".$games->getPlatform()."', 0)";
        $db = unserialize($_SESSION['dbconnection']);
        $resultat = $db->getLink()->prepare($query);
        
        $status = null;
        $status = $resultat->execute();
        if($status) {
			$lastid = $db->getLink()->lastInsertId();
			for ($i=0; $i < count($games->getGenres()); $i++) {
				$idgenre = $games->getGenres()[$i]->getId();
				$query2 = "INSERT INTO game_has_genre (Game_ID , Genre_ID) VALUES ($lastid, $idgenre)";
				$result = $db->getLink()->prepare($query2);
				$status = $result->execute();
			}
		}
        return $status;
    }

    public function getAllGames($order) {
    	$orderSQL = "";
		if (!empty($order)) {
			$orderSQL = "ORDER BY ".$order;
		}
		$sqlDiscount = ", (SELECT O.Discount FROM Offer O WHERE O.ID_Offer = G.Offer_ID) as Discount";
		$sqlPlatform = ", (SELECT P.Name FROM platform P WHERE P.ID_Platform = G.Platform_ID) as Platform";
		$sql = "SELECT G.ID_Game, G.Title, G.Price, G.Stock ".$sqlDiscount." ".$sqlPlatform." FROM game G $orderSQL";
		$db = unserialize($_SESSION['dbconnection']);
		$stmt = $db->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	public function deleteGame($id) {

		try {
			
			$query = ("DELETE FROM game WHERE ID_Game = '$id'");

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

	function getGenreByID($idgenre) {
		$db = unserialize($_SESSION['dbconnection']);
		$sql = "SELECT ID_Genre, Name FROM genre WHERE ID_Genre = '".$idgenre."'";
        $stmt = $db->getLink()->prepare($sql); 
        $stmt->execute();
        $result = $stmt->FetchAll();
        return $result;
	}

	public function getGenresGame($gameid) {
		$db = unserialize($_SESSION['dbconnection']);
		$sql = "SELECT GE.ID_Genre, GE.Name FROM game_has_genre GG INNER JOIN Genre GE
		WHERE GE.ID_Genre = GG.Genre_ID AND GG.Game_ID = $gameid";
		$stmt = $db->getLink()->prepare($sql); 
		$stmt->execute();
		$result = $stmt->FetchAll();
		return $result;
	}

	function getAllGameInfo($id) {
		try {
			$db = unserialize($_SESSION['dbconnection']);
			$query = "SELECT G.Title, G.Price, G.Stock, P.ID_Platform as PlatformID, P.Name as Platform FROM game G INNER JOIN platform P WHERE P.ID_Platform=G.Platform_ID AND G.ID_Game = '$id'";
			$resultat = $db->getLink()->prepare($query);
        	$resultat->execute();
 			while ($row = $resultat->fetch(PDO::FETCH_ASSOC)) {
				$title = $row['Title'];
				$price = $row['Price'];
				$stock = $row['Stock'];
				$platform = $row['Platform'];
				$platformid = $row['PlatformID'];
				$game = array('Title'=> $title, 'Price'=> $price, 'Stock'=>$stock, 'Genres'=>$this->getGenresGame($id), 'Platform'=>$platform, 'PlatformID'=>$platformid);
			}
			$result = $game;
		} catch(PDOException $ex) {
			echo "An Error ocurred!";
			some_loggging_function($ex->getMessage());
		} finally {
			return $result;		
		}
	}

	public function updateGame($game) {
        $query = "UPDATE game SET Title='".$game->getTitle()."', Price='".$game->getPrice()."', Stock='".$game->getStock()."', Platform_ID='".$game->getPlatform()->getId()."' WHERE ID_Game='".$game->getId()."'";
        $db = unserialize($_SESSION['dbconnection']);
        $result = $db->getLink()->prepare($query);
        $status = null;
        $status = $result->execute();
        if ($status) {
        	$query = "DELETE FROM game_has_genre WHERE Game_ID='".$game->getId()."'";
        	$result = $db->getLink()->prepare($query);
        	$status = $result->execute();
        	if ($status) {
        		$genres = $game->getGenres();
        		foreach($genres as $genre) {
        			$genreid = $genre->getId();
        			$query = "INSERT INTO game_has_genre VALUES(".$game->getId().", ".$genreid.")";
	        		$result = $db->getLink()->prepare($query);
	        		$status = $result->execute();
        		}
        	}
        }
        return $status;
    }
}
?>