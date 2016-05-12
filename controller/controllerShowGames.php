<?php
session_start();
require_once("../model/autoload.php");
include_once("../view/showGames.php");
$shop = unserialize($_SESSION['shop']);
$shop->populateShop();
$all = $shop->getGames();
showGames($all);
?>