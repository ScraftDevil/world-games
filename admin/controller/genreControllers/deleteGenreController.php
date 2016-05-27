<?php
if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	

	
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$id = $_POST['delete'];
			$result = deleteGenre($id);
			if($result != -1) {
				header("Location:../../view/genreViews/genreListView.php?msg=deleteSuccess");
			} else {
				header("Location:../../view/genreViews/genreListView.php?msg=deleteFail");
			}
		} else {
			header("Location:../../view/genreViews/genreListView.php?msg=deleteFail");
		}
	

	

	function deleteGenre($id) {
		$proces = -1;
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->deleteGenre($id);
		return $proces;
	}

	

	

?>