<?php
$BASE_PATH = $_SERVER['DOCUMENT_ROOT']."/world-games/";
if (!isset($_SESSION['BASE_PATH'])) {
	$_SESSION['BASE_PATH'] = $BASE_PATH;
}
?>