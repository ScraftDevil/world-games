<?php
if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	

	
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$id = $_POST['delete'];
			$result = deleteOffer($id);
			if($result != -1) {
				header("Location:../../view/gameViews/gameListView.php?msg=successDeleteOffer");
			} else {
				header("Location:../../view/gameViews/gameListView.php?msg=failDeleteOffer");
			}
		} else {
			header("Location:../../view/gameViews/gameListView.php?msg=failDeleteOffer");
		}
	

	

	function deleteOffer($id) {
		$proces = -1;
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->deleteOffer($id);
		return $proces;
	}

	

	

?>