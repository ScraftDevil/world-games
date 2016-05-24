<?php
session_start();
require_once("../model/autoload.php");
$shop = unserialize($_SESSION['shop']);
$shop->populateShop();
if (isset($_POST['genre'])) {
	$games = $shop->filterGames($_POST['genre'], "genre");
} else if (isset($_POST['platform'])) {
	$games = $shop->filterGames($_POST['platform'], "platform");
}
//check image exists and add to response json with object games
//to do
//
if (!empty($games)) {
	echo json_encode($games);
}
?>