<?php
session_start();
require_once("../../model/autoload.php");

$post = $_POST['registered'];

	$registered = json_decode($post);
$username = $registered->username;
$passwordregister = $registered->passwordregister;
$email = $registered->email;
$calendar = $registered->calendar;
$paypal = $registered->paypal;
$country = $registered->country;

$registered = new Registered($username, $passwordregister, $email, $calendar, $paypal,$country);
$proces = $registered->insertRegistered();


	
	
	//$db = unserialize($_SESSION['dbconnection']);
	//$query = "INSERT INTO registered VALUES('', '$username', '$passwordregister', '$email', '$calendar','$paypal', '$country')";
	//$result = $db->getLink()->prepare($query);
	//$status['status'] = $result->execute();
		echo json_encode($proces);

	

?>