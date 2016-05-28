<?php
session_start();
require_once("../../model/autoload.php");
$shop = unserialize($_SESSION['shop']);
$shop->populateShop();//update all data
$shoppingCart = $_POST["shoppingCart"];
$status['status'] = "ERROR";
if (!empty($shoppingCart)) {
	if (isset($_SESSION['user_id'])) {
		$userid = $_SESSION['user_id'];
		$totalprice = 0;
		$quantity = count($shoppingCart);
		$registered = $shop->getRegistered($userid);
		$games = array();
		for ($i=0; $i < count($shoppingCart); $i++) {
			$totalprice += (($shoppingCart[$i]['price'])*($shoppingCart[$i]['quantity']));
			$game = $shop->getGame($shoppingCart[$i]['id']);
			if (empty($game) || ($game->getStock()<=0)) {
				$status['status'] = "ERROR_STOCK";
			} else {
				$games[] = $game;
			}
		}
		if ($status['status'] != "ERROR_STOCK") {
			$tax = 21;
			$shopping = new Shopping($totalprice, $tax, $quantity, date("Y-m-d"), $registered, $games);
			if($shop->insertShopping($shopping, $userid)) {
				$status['status'] = "SHOPPING_OK";
			} else {
				$status['status'] = "ERROR";
			}
		}
	} else {
		$status['status'] = "LOGIN_ERROR";
	}
} else {
	$status['status'] = "ERROR";
}
echo json_encode($status);
?>