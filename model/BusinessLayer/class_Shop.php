<?php

class Shop {

    private $id;
    private $name;
    private $users = null;

    function __construct($name) {
        $this->setName($name);
        $this->setUsers(array());
    }

    function populateShop() {
        //db querys here
    }

    function getName() {
        return $this->name;
    }

    function getUsers() {
        return $this->users;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUsers($users) {
        $this->users = $users;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

}

?>