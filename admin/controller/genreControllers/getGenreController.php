<?php

	if (session_id() == '') {
		session_start();
	}

	require_once($_SESSION['BASE_PATH']."/model/autoload.php");
	
	$id = $_POST['genre'];
	$genre = getGenre($id);
	if (!$genre) {
		header("../../view/genreViews/genreListView.php");
	}

	function getGenre($id) {
		$shop = unserialize($_SESSION['shop']);;
		$genre = $shop->getGenre($id);
		return $genre;
	}

?>