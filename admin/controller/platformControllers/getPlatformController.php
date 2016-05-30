<?php

	if (session_id() == '') {
		session_start();
	}

	require_once($_SESSION['BASE_PATH']."/model/autoload.php");
	
	$id = $_POST['platform'];
	$platform = getPlatform($id);
	if (!$platform) {
		header("../../view/platformViews/platformListView.php");
	}

	function getPlatform($id) {
		$shop = unserialize($_SESSION['shop']);;
		$platform = $shop->getPlatform($id);
		return $platform;
	}

?>