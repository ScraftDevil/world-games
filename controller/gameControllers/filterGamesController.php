<?php
session_start();
require_once("../../model/autoload.php");
$shop = unserialize($_SESSION['shop']);
$shop->populateShop();
if (isset($_POST['genre'])) {
	$games = $shop->filterGames($_POST['genre'], "genre");
} else if (isset($_POST['platform'])) {
	$games = $shop->filterGames($_POST['platform'], "platform");
}
if (!empty($games)) {
	echo json_encode($games);
} else {
	echo json_encode(array());
}
?>