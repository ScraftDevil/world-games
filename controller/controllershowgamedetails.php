<?php

require_once("../model/autoload.php");
//include_once("../view/ShowdetallGame.php");
$shop = unserialize($_SESSION['shop']);

	//$shop->getGame($gameid);
$game = $shop->getGame($gameid);

?>

