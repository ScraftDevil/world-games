<?php
session_start();
require_once("../model/autoload.php");
if (isset($_POST['rate'])) {
	$rate = $_POST["rate"];
	$gameid = $_POST["gameid"];
	if (isset($_SESSION['user_id'])) {
		$userid = $_SESSION['user_id'];
		$db = unserialize($_SESSION['dbconnection']);
		//check if already rate this game
		$sql = "SELECT COUNT(*) AS rates FROM game_has_valoration GV WHERE GV.Registered_ID=$userid AND GV.Game_ID=$gameid";
		$stmt = $db->getLink()->prepare($sql);
		$stmt->execute();
		$result = $stmt->FetchAll();
		$rates = $result[0]['rates'];
		if ($rates<=0) {
			$query = "INSERT INTO valoration VALUES('', '$rate')";
			$result = $db->getLink()->prepare($query);
			if($result->execute()) {
				$lastid = $db->getLink()->lastInsertId();
				$query = "INSERT INTO game_has_valoration (Game_ID, Valoration_ID, Registered_ID) VALUES ($gameid, $lastid, $userid)";
				$result = $db->getLink()->prepare($query);
				if($result->execute()) {
					$status['msg'] = "RATED_OK";
				}
			} else {
				$status['msg'] = "RATED_FAIL";
			}
		} else {
			$status['msg'] = "ALREADY_RATED_GAME";
		}
	} else {
		$status['msg'] = "LOGIN_ERROR";
	}
} else {
	$status['msg'] = "NO_RATE_INPUT";
}
echo json_encode($status);
?>