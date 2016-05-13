<?php

class Registered extends User {

    private $paypalAccount;
    private $avatarUrl;

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

    function __construct($username, $password, $email, $birthDate, $country) {
        parent::__construct($username, $password, $email, $birthDate, $country);
    }    
}

?>