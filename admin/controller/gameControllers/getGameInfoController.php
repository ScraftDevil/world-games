<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$post = $_POST['data'];

	$data = json_decode($post);

	$response = null;

	$registered = null;

	$group = $data->group;
	$id = $data->id;

	if ($data != null) {
		if ($group == "registered" || $group == "professional" || $group == "administrator") {
			else {
				$response = array("id" => "id-error");
			}
		} else {
			$response = array("id" => "group-error");
		}
	} else {
		$response = array("id" => "data-error");
	}

	function getRegisteredInfo($id) {
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->getAllRegisteredInfo($id);
		return $proces;
	}

	

	function validateID($id) {
		$proces = false;
		if ($id != null AND $id != "") {
			$id = intval($id);
			if (!is_nan($id)) {
				$proces = true;
			}
		}
		return $proces;
	}

	echo json_encode($response);

?>