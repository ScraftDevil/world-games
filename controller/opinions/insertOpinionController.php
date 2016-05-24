<?php
session_start();
require_once("../../model/autoload.php");
$comment = $_POST["comment"];
$gameid = $_POST["gameid"];
if (!empty($comment)) {
	if (isset($_SESSION['user_id'])) {
	$userid = $_SESSION['user_id'];
	$db = unserialize($_SESSION['dbconnection']);
	$query = "INSERT INTO comment VALUES('', '$gameid', '$comment', now())";
	$result = $db->getLink()->prepare($query);
	if($result->execute()) {
		$lastid = $db->getLink()->lastInsertId();
		$query = "INSERT INTO registered_has_comment (Registered_ID, Comment_ID, Game_ID) VALUES ($userid, $lastid, $gameid)";
		$result = $db->getLink()->prepare($query);
		echo $result->execute();
	}
	} else {
		echo "LOGIN_ERROR";
	}
} else {
	echo "EMPTY_INPUT";
}
?>