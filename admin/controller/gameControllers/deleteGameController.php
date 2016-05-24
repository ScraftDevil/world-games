<?php
if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	

	if (isset($_GET['group']) AND !empty($_GET['group'])) {
		$group = $_GET['group'];
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$id = $_POST['delete'];
		} else {
			header("Location:../../view/userViews/newUserView.php?group=".$group."&msg=deleteFail");
		}
	} else {
		header("Location:../../index.php");
	}

	

	function deleteRegistered($id) {
		$proces = -1;
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->deleteGame($id);
		return $proces;
	}

	

	

?>