<?php
    
class Country {
    
    private $id;
    private $name;
    
    function __construct($name) {
        $this->setName($name);
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
}

?>