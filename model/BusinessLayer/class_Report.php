<?php

class Report {
    
    //attributes
    private $id;
    private $reason;
    private $date;
    private $status;
    private $contentreport;
    private $userRegistered;
    private $professionalUser;
    private $administratorUser;
    
    //constructor
    function __construct($reason,$contentreport, $date, $status, $userRegistered) {
        $this->setReason($reason);
        $this->setContentreport($contentreport);
        $this->setDate($date);
        $this->setState($status);
        $this->setUserRegistered($userRegistered);
        $this->setProfessionalUser(null);
        $this->setAdministratorUser(null);
    }
    
    //getters i setters
    function getId() {
        return $this->id;
    }

    function getReason() {
        return $this->reason;
    }

    function getDate() {
        return $this->date;
    }

    function getStatus() {
        return $this->status;
    }

    function getContentreport() {
        return $this->contentreport;
    }

    function getUserRegistered() {
        return $this->userRegistered;
    }

    function getProfessionalUser() {
        return $this->professionalUser;
    }

    function getAdministratorUser() {
        return $this->administratorUser;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setReason($reason) {
        $this->reason = $reason;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setContentreport($contentreport) {
        $this->contentreport = $contentreport;
    }

     function setUserRegistered($userRegistered) {
        $this->userRegistered = $userRegistered;
    }

    /*function setProfessionalUser($professionalUser) {
        $this->professionalUser = $professionalUser;
    }

    function setAdministratorUser($administratorUser) {
        $this->administratorUser = $administratorUser;
    }*/
}

?>