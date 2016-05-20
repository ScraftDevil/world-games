<?php

class Game implements JsonSerializable {

    private $id ;
    private $title;
    private $price;
    private $stock;
    private $offer;
    private $platform;
    private $genres = null;

    
    function __construct($title, $price) {
        $this->setTitle($title);
        $this->setPrice($price);
        $this->setStock(0);
        $this->setGenres(array());
    }

    function getId() {
        return $this->id;
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

    function getPlatform() {
        return $this->platform;
    }

    function getGenres() {
        return $this->genres;
    }

    function setOffer($offer) {
        $this->offer = $offer;
    }

    function setPlatform($platform) {
        $this->platform = $platform;
    }

    function setGenres($genres) {
        $this->genres = $genres;
    }

    /*function addGameDb($title,$price) {
        $GameDao = new GameDao();
        $GameDao->addGame($title,$price);
    }*/

    public function insertGame() {
        $GameDao = new gameDAO();
        return  $GameDao->insertGame($this); 
    }


    /*public function addGenre($title,$price) {

        $games = new Game($title,$price);
        $games->addGameDb($games);
        array_push($this->games, $games);

        return $games;
    }*/

    function jsonSerialize() {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'stock' => $this->stock,
            'discount' => $this->offer->getDiscount(),
            'platform' => $this->platform->getName(),
        ];
    }
}
