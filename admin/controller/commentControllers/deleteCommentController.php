<?php
if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	

	
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$id = $_POST['delete'];
			$result = deleteComment($id);
			if($result != -1) {
				header("Location:../../view/commentViews/commentListView.php?msg=deleteSuccess");
			} else {
				header("Location:../../view/commentViews/commentListView.php?msg=deleteFail");
			}
		} else {
			header("Location:../../view/commentViews/commentListView.php?msg=deleteFail");
		}
	

	

	function deleteComment($id) {
		$proces = -1;
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->deleteComment($id);
		return $proces;
	}

	

	

?>