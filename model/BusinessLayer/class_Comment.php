<?php

class Shop {

    private $id;
    private $comment;

    function __construct($comment) {
        $this->setComment($comment);
    }

    function getId() {
        return $this->id;
    }

    function getComment() {
        return $this->comment;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setComment($comment) {
        $this->comment = $comment;
    }

}

?>