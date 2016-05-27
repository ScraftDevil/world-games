<?php
if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	

	
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$id = $_POST['delete'];
			$result = deletePlatform($id);
			if($result != -1) {
				header("Location:../../view/platformViews/platformListView.php?msg=deleteSuccess");
			} else {
				header("Location:../../view/platformViews/platformListView.php?msg=deleteFail");
			}
		} else {
			header("Location:../../view/platformViews/platformListView.php?msg=deleteFail");
		}
	

	

	function deletePlatform($id) {
		$proces = -1;
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->deletePlatform($id);
		return $proces;
	}

	

	

?>