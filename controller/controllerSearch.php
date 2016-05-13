<?php
session_start();
require_once("../model/autoload.php");
include_once("../view/showSearchGames.php");
$db = unserialize($_SESSION['dbconnection']);
if (!empty($_POST['search'])) {
	$list = $db->searchGame($_POST['search']);
	showSearchGames($list);
}
?>