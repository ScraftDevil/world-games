<?php

class Offer {
    private $id;
    private $discount = null;
    private $game;
    
    function __construct($discount) {
        $this->setDiscount($discount);
    }
    
    
    function getId() {
        return $this->id;
    }

    function getDiscount() {
        return $this->discount;
    }

    function getGame() {
        return $this->game;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDiscount($discount) {
        $this->discount = $discount;
    }

    function setGame($game) {
        $this->game = $game;
    }

    public function insertOffer() {
        $offerDAO = new offerDAO();
        return  $offerDAO->insertOffer($this); 
    }
   
}
