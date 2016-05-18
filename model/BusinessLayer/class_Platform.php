<?php
class Platform {
    
    private $id = null;
    private $name = null;
    
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
