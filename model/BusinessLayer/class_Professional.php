<?php

class Professional extends User {
    
    private $telephone;
    private $reports = null;
    private $complaints = null;

    function getTelephone() {
        return $this->telephone;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }
    
    function getReports() {
        return $this->reports;
    }

    function getComplaints() {
        return $this->complaints;
    }

    function setReports($reports) {
        $this->reports = $reports;
    }

    function setComplaints($complaints) {
        $this->complaints = $complaints;
    }

    function __construct($username, $password, $email, $birthDate) {
        parent::__construct($username, $password, $email, $birthDate);
        $this->setTelephone(null);
        $this->setReports(array());
        $this->setComplaints(array());
    }

    function insertProfessional() {
        $professionalDAO = new ProfessionalDAO();
        return $professionalDAO->insertProfessional($this);
    } 

}

?>