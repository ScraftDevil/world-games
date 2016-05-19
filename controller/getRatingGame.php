<?php
session_start();
require_once("../model/autoload.php");
$db = unserialize($_SESSION['dbconnection']);
$gameid = $_POST["gameid"];
$sql = "SELECT SUM(V.Valoration)/COUNT(*) as score FROM Valoration V WHERE 1";
$stmt = $db->getLink()->prepare($sql);
$stmt->execute();
$result = $stmt->FetchAll();
echo $result[0]['score'];
?>