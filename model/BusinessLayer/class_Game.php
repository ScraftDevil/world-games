<?php

class Game {

    private $id ;
    private $title;
    private $price;
    private $stock;
    private $offer;
    private $plataform;
    private $genres = null;

    
    function __construct( $title, $price) {
        $this->setTitle($title);
        $this->setPrice($price);
        $this->setStock(0);
        $this->setGenres(array());
    }

    function getId() {
        return $this->id;
    }

    function getCode() {
        return $this->code;
    }

    function getTitle() {
        return $this->title;
    }

    function getPrice() {
        return $this->price;
    }

    function getStock() {
        return $this->stock;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCode($code) {
        $this->code = $code;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setStock($stock) {
        $this->stock = $stock;
    }
    function getOffer() {
        return $this->offer;
    }

    function getPlataform() {
        return $this->plataform;
    }

    function getGenres() {
        return $this->genres;
    }

    function setOffer($offer) {
        $this->offer = $offer;
    }

    function setPlataform($plataform) {
        $this->plataform = $plataform;
    }

    function setGenres($genres) {
        $this->genres = $genres;
    }

public function addGameDb($title,$price) {
        $GameDao = new GameDao();
        $GameDao->addGame($title,$price);
    }
}
