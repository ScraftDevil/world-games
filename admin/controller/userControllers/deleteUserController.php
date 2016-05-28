<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	

	if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
		$string = $_POST['delete'];
		$id = "";
		$group = "";
		$separate = false;
		for ($i = 0; $i < strlen($string); $i++) { 
			if ($separate == false) {
				if ($string[$i] == "-") {
					$separate = true;
				} else {
					$id = $id.$string[$i];
				}
			} else {
				if ($string[$i] != "-") {
					$group = $group.$string[$i];
				}
			}
		}
		echo $id;
		if ($group == "registered" || $group == "professional" || $group == "administrator") {
			switch ($group) {
				case 'registered':
					$proces = deleteRegistered($id);
					if ($proces == -1) {
						$_SESSION['msg'] = "deleteFail";
						header("Location:../../view/userViews/".$group."ListView.php");
					} else {
						$_SESSION['msg'] = "deleteSuccess";
						header("Location:../../view/userViews/".$group."ListView.php");
					}
				break;

				case 'professional':
					$proces = deleteProfessional();
					if ($proces == -1) {
						//header("Location:../../view/userViews/newUserView.php?group=".$group."&msg=deleteFail");
					} else {
						//header("Location:../../view/userViews/userListView.php?group=".$group."&msg=deleteSuccess");
					}
				break;

				case 'administrator':
					$proces = deleteAdministrator();
					if ($proces == -1) {
						//header("Location:../../view/userViews/newUserView.php?group=".$group."&msg=deleteFail");
					} else {
						//header("Location:../../view/userViews/userListView.php?group=".$group."&msg=deleteSuccess");
					}
				break;		
			}
		} else {
			//header("Location:../../index.php");
		}
	} else {
		//header("Location:../../index.php");
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