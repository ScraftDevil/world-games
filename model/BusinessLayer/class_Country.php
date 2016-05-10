<?php
    
class Country {
    
    //attributes
    private $id;
    private $name;
    
    //constructor
    function __construct($name) {
        $this->setName($name);
    }
    
    //getters and setters
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
}

?>