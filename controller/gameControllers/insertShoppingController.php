<?php
session_start();
require_once("../../model/autoload.php");
$shop = unserialize($_SESSION['shop']);
$shoppingCart = $_POST["shoppingCart"];
if (!empty($shoppingCart)) {
	if (isset($_SESSION['user_id'])) {
		$userid = $_SESSION['user_id'];
		//calculate totalprice, quantityitems
		$totalprice = 0;
		$quantity = count($shoppingCart);
		$registered = $shop->getRegistered($userid);
		$games = array();
		for ($i=0; $i < count($shoppingCart); $i++) {
			$totalprice += $shoppingCart[$i]['price'];
			$games[] = "";
		}
		//
		$shopping = new Shopping($totalprice, 0, $quantity, date("Y-m-d"), $registered, $games);
		var_dump($shopping);
		$shop->insertShopping($shopping);
		$status['status'] = "SHOPPING_OK";
	} else {
		$status['status'] = "LOGIN_ERROR";
	}
} else {
	$status['status'] = "ERROR";
}
echo json_encode($status);
?>