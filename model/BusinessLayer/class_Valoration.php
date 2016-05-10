<?php

class Valoration {

    private $id;
    private $valoration;

    function __construct($valoration) {
        $this->setValoration($valoration);
    }

    function getId() {
        return $this->id;
    }

    function getValoration() {
        return $this->valoration;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setValoration($valoration) {
        $this->valoration = $valoration;
    }

}

?>