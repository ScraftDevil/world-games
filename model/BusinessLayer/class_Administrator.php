<?php

class Administrator extends User {

    function __construct($username, $password, $email, $birthDate) {
        parent::__construct($username, $password, $email, $birthDate);
    }

    function insertAdministrator() {
    	$administratorDAO = new administratorDAO();
    	return $administratorDAO->insertAdministrator($this);
    }

}

?>