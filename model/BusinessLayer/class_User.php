<?php

abstract class User {

    private $id;
    private $username;
    private $password;
    private $email;
    private $bannedTime;
    private $birthDate;
    private $messages = null;
    private $country;

    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function getBannedTime() {
        return $this->bannedTime;
    }

    function getBirthDate() {
        return $this->birthDate;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setBannedTime($bannedTime) {
        $this->bannedTime = $bannedTime;
    }

    function setBirthDate($birthDate) {
        $this->birthDate = $birthDate;
    }

    function getMessages() {
        return $this->messages;
    }

    function getCountry() {
        return $this->country;
    }

    function setMessages($messages) {
        $this->messages = $messages;
    }

    function setCountry($country) {
        $this->country = $country;
    }

    function __construct($username, $password, $email, $birthDate) {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setEmail($email);
        $this->setBannedTime(null);
        $this->setBirthDate($birthDate);
        $this->setMessages(array());
    }

}

?>