<?php
	require_once("../../model/autoload.php");
	$shop = unserialize($_SESSION['shop']);
	$genres = $shop->getGenres();
?>