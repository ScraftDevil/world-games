<?php
if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	

	
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$id = $_POST['delete'];
			$result = deleteGame($id);
			if($result != -1) {
				header("Location:../../view/gameViews/gameListView.php?msg=deleteSuccess");
			} else {
				header("Location:../../view/gameViews/gameListView.php?msg=deleteFail");
			}
		} else {
			header("Location:../../view/gameViews/gameListView.php?msg=deleteFail");
		}
	

	

	function deleteGame($id) {
		$proces = -1;
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->deleteGame($id);
		return $proces;
	}

	

	

?>