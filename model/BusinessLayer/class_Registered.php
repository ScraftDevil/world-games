<?php

class Registered extends User {

    //attributes
    private $paypalAccount;
    private $avatarUrl;

    //getters and setters
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