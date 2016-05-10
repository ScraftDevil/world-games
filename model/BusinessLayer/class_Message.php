<?php

class Message {
    
    //attributes
    private $id;
    private $content;
    private $date;
    private $senderUser;
    private $receptorUser;
    
    //constructor
    function __construct($content, $date, $senderUser, $receptorUser) {
        $this->setContent($content);
        $this->setDate($date);
        $this->setSenderUser($senderUser);
        $this->setReceptorUser($receptorUser);
    }
    
    //getters and setters
    function getId() {
        return $this->id;
    }

    function getContent() {
        return $this->content;
    }

    function getDate() {
        return $this->date;
    }

    function getSenderUser() {
        return $this->senderUser;
    }

    function getReceptorUser() {
        return $this->receptorUser;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setSenderUser($senderUser) {
        $this->senderUser = $senderUser;
    }

    function setReceptorUser($receptorUser) {
        $this->receptorUser = $receptorUser;
    }
}

?>