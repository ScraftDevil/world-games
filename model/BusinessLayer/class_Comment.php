<?php

class Comment {

    private $id;
    private $comment;
    private $user;

    function __construct($comment, $user) {
        $this->setComment($comment);
        $this->setUser($user);
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

    function getUser() {
        return $this->user;
    }

    function setUser($user) {
        $this->user = $user;
    }

}

?>