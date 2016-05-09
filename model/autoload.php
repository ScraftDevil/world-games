<?php
function __autoload($classname) {
	$fileBusinessLayer = __DIR__."\BusinessLayer\class_" . $classname . ".php";
	$filePersistanceLayer = __DIR__."\PersistanceLayer\class_" . $classname . ".php";
    if(file_exists($fileBusinessLayer)){
    	require_once($fileBusinessLayer);
    } else if(file_exists($filePersistanceLayer)) {
    	require_once($filePersistanceLayer);
    }
}
?>