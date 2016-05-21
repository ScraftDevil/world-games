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

	if ($group == "registered" || $group == "professional" || $group == "administrator") {
		switch ($group) {
			case 'registered':
				$proces = deleteRegistered($id);
				if ($proces == -1) {
					header("Location:../../view/userViews/newUserView.php?group=".$group."&msg=deleteFail");
				} else {
					header("Location:../../view/userViews/userListView.php?group=".$group."&msg=deleteSuccess");
				}
			break;

			case 'professional':
				$proces = deleteProfessional();
				if ($proces == -1) {
					header("Location:../../view/userViews/newUserView.php?group=".$group."&msg=deleteFail");
				} else {
					header("Location:../../view/userViews/userListView.php?group=".$group."&msg=deleteSuccess");
				}
			break;

			case 'administrator':
				$proces = deleteAdministrator();
				if ($proces == -1) {
					header("Location:../../view/userViews/newUserView.php?group=".$group."&msg=deleteFail");
				} else {
					header("Location:../../view/userViews/userListView.php?group=".$group."&msg=deleteSuccess");
				}
			break;		
		}
	} else {
		header("Location:../../index.php");
	}

	function deleteRegistered($id) {
		$proces = -1;
		$db = unserialize($_SESSION['dbconnection']);
		$proces = $db->deleteRegisteredUser($id);
		return $proces;
	}

	function deleteProfessional() {
		$proces = -1;
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$db = unserialize($_SESSION['dbconnection']);
			$proces = $db->deleteProfessionalUser($_POST['delete']);
		}
		return $proces;
	}

	function deleteAdministrator() {
		$proces = -1;
		if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
			$db = unserialize($_SESSION['dbconnection']);
			$proces = $db->deleteAdministratorUser($_POST['delete']);
		}
		return $proces;
	}

?>