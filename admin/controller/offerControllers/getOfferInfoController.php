<?php

if (session_id() == '') {
	session_start();
}

require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

$post = $_POST['data'];

$data = json_decode($post);

$response = null;

$offer = null;

$id = $data->id;

if ($data != null) {
	if (isset($id) && !empty($id)) {
		$offer = getOfferInfo($id);
		$response = $offer;
	} else {
		$response = array("id" => "id-error");
	}
} else {
	$response = array("id" => "data-error");
}

function getOfferInfo($id) {
	$db = unserialize($_SESSION['dbconnection']);
	$proces = $db->getAllOfferInfo($id);
	return $proces;
}

echo json_encode($response);

?>