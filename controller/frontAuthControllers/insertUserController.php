<?php
session_start();
require_once("../../model/autoload.php");
$post = $_POST['registered'];
$registered = json_decode($post);
$username = $registered->username;
$passwordregister = $registered->passwordregister;
$email = $registered->email;
$birthdate = date("Y-m-d",strtotime($registered->birthdate));
$paypal = $registered->paypal;
$country = $registered->country;
$rObj = new Registered($username, $passwordregister, $email, $birthdate,$country);
$rObj->setPaypalAccount($paypal);
$proces = $rObj->insertRegistered();
echo json_encode($proces);
?>