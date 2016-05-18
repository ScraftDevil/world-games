<?php
require_once("../model/autoload.php");
$shop = unserialize($_SESSION['shop']);
$game = $shop->getGame($gameid);
?>