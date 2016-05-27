<?php
if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	

	
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$id = $_POST['delete'];
			$result = deleteMessage($id);
			if($result != -1) {
				header("Location:../../view/messageViews/messageListView.php?msg=deleteSuccess");
			} else {
				header("Location:../../view/messageViews/messageListView.php?msg=deleteFail");
			}
		} else {
			header("Location:../../view/messageViews/messageListView.php?msg=deleteFail");
		}
	

	

	function deleteMessage($id) {
		$proces = -1;
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->deleteMessage($id);
		return $proces;
	}

	

	

?>