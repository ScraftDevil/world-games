<?php

require_once("../model/autoload.php");

session_start();

if (isset($_REQUEST['add'])) {
 
        $shop = unserialize($_SESSION['shop']);
        try {
            $shop->addGame($_REQUEST['title'], $_REQUEST['precio']);
            
        } catch (Exception $exc) {
            printErrorConnectionDb();
        }
        $_SESSION['shop'] = serialize($shop);        
    
}
?>