<?php
session_start();
require_once("../../model/autoload.php");
$post = $_POST['registered'];
$registered = json_decode($post);
$username = $registered->username;
$passwordregister = $registered->passwordregister;
$email = $registered->email;
$birthdate = $registered->birthdate;
$paypal = $registered->paypal;
$country = $registered->country;
$rObj = new Registered($username, $passwordregister, $email, $birthdate,$country);
$rObj->setPaypalAccount($paypal);
$proces = $rObj->insertRegistered();
//$db = unserialize($_SESSION['dbconnection']);
//$query = "INSERT INTO registered VALUES('', '$username', '$passwordregister', '$email', '$calendar','$paypal', '$country')";
//$result = $db->getLink()->prepare($query);
//$status['status'] = $result->execute();
echo json_encode($proces);
?>