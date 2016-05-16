<?php

	require_once("../../model/autoload.php");

	if (session_id() == '') {
	    session_start();
	}
	$group = $_GET['group'];

	if ($group == "registered" || $group == "professional" || $group == "administrator") {
		switch ($group) {
			case 'registered':
				$proces = addRegistered();
				if ($proces == 0) {
					header("Location:../view/newUserView.php?group=".$group."&msg=fail");
				} else if ($proces == 1) {
					header("Location:../view/userListView.php?group=".$group."&msg=errusername");
				} else {
					header("Location:../view/userListView.php?group=".$group."&msg=success");
				}
			break;			
		}
	} else {
		header("Location:../index.php");
	}


	function addRegistered() {
		$proces = 0;
		if (isset($_POST['username']) AND isset($_POST['password']) AND isset($_POST['email']) AND isset($_POST['birthdate']) AND isset($_POST['country'])) {
			if (!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['email']) AND !empty($_POST['birthdate']) AND !empty($_POST['country'])) {
				$username = $_POST['username'];
				$password = $_POST['password'];
				$email = $_POST['email'];
				$birthdate = $_POST['birthdate'];
				$country = $_POST['country'];
				$birthdate = date('Y-m-d', strtotime($birthdate));
				$registered = new Registered($username, $password, $email, $birthdate, $country);
				$proces = $registered->insertRegistered();
			}
		}
		return $proces;
	}

?>