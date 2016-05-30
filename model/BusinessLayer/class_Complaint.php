<?php
/**
 * Class for Complaint
 */
class Complaint {
    private $id;
    private $reason;
    private $contentcomplain;
    private $date;
    private $status;
    private $userRegistered;
    private $professionalUser;
    private $game;

    /**
     * Constructor for complaint
     * @param reason 
     * @param date 
     * @param status 
     * @param userRegistered 
     * @param professionalUser 
     * @param game 
     * @return none
     */
    function __construct($reason,$contentcomplain, $date, $status) {
        $this->setReason($reason);
         $this->setContentcomplain($contentcomplain);
        $this->setDate($date);
        $this->setStatus($status);
       // $this->setUserRegistered($userRegistered);
       // $this->setProfessionalUser($professionalUser);
        //$this->setGame($game);
    }

    function getId() {
        return $this->id;
    }

    function getReason() {
        return $this->reason;
    }

     function getContentcomplain() {
        return $this->contentcomplain;
    }

    function getDate() {
        return $this->date;
    }

    function getStatus() {
        return $this->status;
    }

    /* function getUserRegistered() {
        return $this->userRegistered;
    }

   function getProfessionalUser() {
        return $this->professionalUser;
    }

    function getGame() {
        return $this->game;
    }*/

    function setId($id) {
        $this->id = $id;
    }

    function setReason($reason) {
        $this->reason = $reason;
    }

      function setContentcomplain($contentcomplain) {
        $this->contentcomplain = $contentcomplain;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    /*function setUserRegistered($userRegistered) {
        $this->userRegistered = $userRegistered;
    }

    function setProfessionalUser($professionalUser) {
        $this->professionalUser = $professionalUser;
    }

    function setGame($game) {
        $this->game = $game;
    } */   
}

?>