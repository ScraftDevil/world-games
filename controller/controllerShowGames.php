<?php
session_start();
//include_once("../controller/controllerLogin.php");
require_once("../model/autoload.php");
include_once("../view/showGames.php");
$shop = unserialize($_SESSION['shop']);
$shop->populateShop();
$all = $shop->getGames();
showGames($all);
?>