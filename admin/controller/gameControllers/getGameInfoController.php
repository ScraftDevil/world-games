<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	$post = $_POST['data'];

	$data = json_decode($post);

	$response = null;

	$game = null;

	$group = $data->group;
	$id = $data->id;

	if ($data != null) {
		
			/*else {
				$response = array("id" => "id-error");
			}*/
		
	} else {
		$response = array("id" => "data-error");
	}

	function getGameInfo($id) {
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->getAllGameInfo($id);
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