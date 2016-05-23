<?php

if (session_id() == '') {
	session_start();
}

require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	// Variable de respuesta para json

$response = "";

$post = $_POST['offer'];

$offer = json_decode($post);

$id = $offer->id;
$discount = $offer->discount;
$offer = new Offer($discount);
$offer->setId($id);
$offer->setDiscount($discount);
$proces = updateOffer($offer);
$response = messages($proces);

function updateOffer($offer) {
	if ($offer->getId() != "" AND $offer->getDiscount()) {
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->updateAllOffer($offer);
	} else {
		$proces = "null";
	}
	return $proces;
}

function messages($proces) {
	$response = null;
	switch($proces) {
		case "success":
		$response = array("id" => "success");
		break;

		case "username":
		$response = array("id" => "username-error");
		break;

		case "email":
		$response = array("id" => "email-error");
		break;

		case "null":
		$response = array("id" => "null-error");
		break;

		default:
		$response = array("id" => "error");
		break;
	}
	return $response;
}

echo json_encode($response);

?>