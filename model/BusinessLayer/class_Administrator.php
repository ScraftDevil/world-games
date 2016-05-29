<?php
/**
 * Class for Administrator
 */
class Administrator extends User {

	/**
	 * Constructor for Administrator Class
	 * @param username
	 * @param password
	 * @param email
	 * @param birthdate
	 * @return none
	 */
    function __construct($username, $password, $email, $birthDate) {
        parent::__construct($username, $password, $email, $birthDate);
    }

    /**
     * Insert Administrator user to database
     * @return status of query sql
     */
    function insertAdministrator() {
    	$administratorDAO = new administratorDAO();
    	return $administratorDAO->insertAdministrator($this);
    }

}

?>