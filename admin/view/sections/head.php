<?php

	$file = basename($_SERVER["SCRIPT_FILENAME"], '.php');

	if ($file != "backLoginView") {
		include("../../controller/backAuthControllers/authController.php");
		if (!checkAuth()) {
			header("Location:../mainViews/backLoginView.php");
		}
	}

	if ($file != "userDataEditView") {
		if(isset($_SESSION['selectedID'])) {
			unset($_SESSION['selectedID']);
		}
	}

?>

<head>
	<title>Admin Panel - World Games</title>
	<meta charset="utf-8"/>
	<link rel="icon" type="image/png" href="../resources/images/favicon.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../resources/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../resources/css/font-awesome.min.css">
	<link href="../resources/css/jquery-ui.css" rel="stylesheet">
    <link href="../resources/css/jquery-ui.theme.css" rel="stylesheet">
    <link href="../resources/css/jquery-ui.structure.css" rel="stylesheet">
	<link href="../resources/css/styles.css" rel="stylesheet" type="text/css">
</head>