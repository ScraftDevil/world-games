<?php

class Shop {

    private $id;
    private $totalprice;
    private $tax;
    private $quantity;
    private $date;
    private $user;
    private $games;

    function __construct($totalprice, $tax, $quantity, $date, $user, $games) {
        $this->setTotalPrice($totalprice);
        $this->setTax($tax);
        $this->setQuantity($quantity);
        $this->setDate($date);
        $this->setUser($user);
        $this->setGames($games);
    }

    function getId() {
        return $this->id;
    }

    function getTotalprice() {
        return $this->totalprice;
    }

    function getTax() {
        return $this->tax;
    }

    function getQuantity() {
        return $this->quantity;
    }

    function getDate() {
        return $this->date;
    }

    function getUser() {
        return $this->user;
    }

    function getGames() {
        return $this->games;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTotalprice($totalprice) {
        $this->totalprice = $totalprice;
    }

    function setTax($tax) {
        $this->tax = $tax;
    }

    function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setGames($games) {
        $this->games = $games;
    }

}

?>