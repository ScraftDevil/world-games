<?php

class Offer {
    private $id = null;
    private $discount = null;
    
    function __construct($discount) {
        $this->setDiscount($discount);
    }
    
    
    function getId() {
        return $this->id;
    }

    function getDiscount() {
        return $this->discount;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDiscount($discount) {
        $this->discount = $discount;
    }


   
}
