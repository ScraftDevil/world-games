<?php

	if (session_id() == '') {
	    session_start();
	}

	require_once($_SESSION["BASE_PATH"]."/model/autoload.php");

	if (isset($_POST['delete']) AND !empty($_POST['delete'])) {
		$id = $_POST['delete'];
		$group = $_SESSION['userDataGrid'];
		if ($group == "registered" || $group == "professional" || $group == "administrator") {
			switch ($group) {
				case 'registered':
					$proces = deleteRegistered($id);
				break;

				case 'professional':
					$proces = deleteProfessional($id);
				break;

				case 'administrator':
					$proces = deleteAdministrator($id);
				break;		
			}
			if ($proces == -1) {
				$_SESSION['msg'] = "deleteFail";
				header("Location:../../view/userViews/".$group."ListView.php");
			} else {
				$_SESSION['msg'] = "deleteSuccess";
				header("Location:../../view/userViews/".$group."ListView.php");
			}
		} else {
			$_SESSION['msg'] = "group-error";
			header("Location:../../view/userViews/".$group."ListView.php");
		}
	} else {
		$_SESSION['msg'] = "access";
		header("Location:../../view/userViews/".$group."ListView.php");
	}

	function deleteRegistered($id) {
		$proces = -1;
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->deleteRegistered($id);
		return $proces;
	}

	function deleteProfessional($id) {
		$proces = -1;
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->deleteProfessional($id);
		return $proces;
	}

	function deleteAdministrator($id) {
		$proces = -1;
		$shop = unserialize($_SESSION['shop']);
		$proces = $shop->deleteAdministrator($id);
		return $proces;
	}

?>