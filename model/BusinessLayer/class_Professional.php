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

    function __construct($telephone) {
        parent::__construct();
        $this->setTelephone($telephone);
        $this->setReports(array());
        $this->setComplaints(array());
    }

}

?>