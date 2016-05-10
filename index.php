<?php

session_start();
require_once("config/config.inc.php");
require_once($_SESSION['BASE_PATH']."config/db.inc.php");
require_once("model/autoload.php");

if (!isset($_SESSION['shop'])) {
	$shop = new Shop("shopName");
	$shop->populateShop();
	$_SESSION['shop'] = serialize($shop);
} else {
	$shop = unserialize($_SESSION['shop']);
}

header("Location:view/home.php");
?>