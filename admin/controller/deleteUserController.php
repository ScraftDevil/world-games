<?php

	require_once("../../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}
	$group = $_GET['group'];

	if ($group == "registered" || $group == "professional" || $group == "administrator") {
		switch ($group) {
			case 'registered':
				$proces = deleteRegistered();
				if ($proces == -1) {
					header("Location:../view/newUserView.php?group=".$group."&msg=deleteFail");
				} else {
					header("Location:../view/userListView.php?group=".$group."&msg=deleteSuccess");
				}
			break;			
		}
	} else {
		header("Location:../index.php");
	}

	function deleteRegistered() {
		$proces = -1;
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$db = unserialize($_SESSION['dbconnection']);
			$proces = $db->deleteRegisteredUser($_POST['delete']);
		}
		return $proces;
	}

?>