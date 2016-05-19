<?php
session_start();
require_once("../model/autoload.php");
$db = unserialize($_SESSION['dbconnection']);
$gameid = $_POST["gameid"];
$sql = "SELECT SUM(V.Valoration)/COUNT(*) as score FROM Valoration V INNER JOIN game_has_valoration GV WHERE GV.Valoration_ID=V.ID_Valoration AND GV.Game_ID_Game=$gameid";
$stmt = $db->getLink()->prepare($sql);
$stmt->execute();
$result = $stmt->FetchAll();
echo $result[0]['score'];
?>