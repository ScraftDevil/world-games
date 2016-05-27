<?php
class Genre {
    private $id = null;
    private $name = null;
    
    function __construct($name) {
        $this->name = ($name);
    }

    
    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
        $this->name = $name;
    }
    function insertGenre() {
        $GenreDAO = new genreDAO();
        return  $GenreDAO->insertGenre($this); 
    }
}
