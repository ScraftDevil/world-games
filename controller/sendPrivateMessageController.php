<?php

session_start();

//require_once("../model/autoload.php");

$myId = $_SESSION['user_id'];

$infoMessage = json_decode($_REQUEST['infoMessage']);

$emailReceiver = $infoMessage->emailReceiver;
$message = $infoMessage->message;

$myMessage = new Message($message, "", $myId, "");

$shopDb = unserialize($_SESSION['dbconnection']);
$shopDb->sendPrivateMessage($myMessage, $emailReceiver);



?>