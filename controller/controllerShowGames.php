<?php
require_once("../model/autoload.php");
$shop = unserialize($_SESSION['shop']);
$shop->populateShop();
$games = $shop->getGames();
?>