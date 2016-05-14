<?php

class Registered extends User {

    //attributes
    private $telephone;
    private $direction;
    private $paypalAccount;
    private $avatarUrl;

    //getters and setters
    function getTelephone() {
        return $this->telephone;
    }

    function getDirection() {
        return $this->direction;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setDirection($direction) {
        $this->direction = $direction;
    }

    function getPaypalAccount() {
        return $this->paypalAccount;
    }

    function getAvatarUrl() {
        return $this->avatarUrl;
    }

    function setPaypalAccount($paypalAccount) {
        $this->paypalAccount = $paypalAccount;
    }

    function setAvatarUrl($avatarUrl) {
        $this->avatarUrl = $avatarUrl;
    }

    //constructor
    function __construct($username, $password, $email, $birthDate, $country) {
        parent::__construct($username, $password, $email, $birthDate, $country);
    }    
}

?>