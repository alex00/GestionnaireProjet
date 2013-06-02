<?php
require_once("../app/kernel.php");

// toolbar for development environment
if($conf['environnement'] == 'dev') {
	// Config php.ini
	$ini = ini_get_all(null, false);
	$errorArray = $error->exportArray();
	
	$toolbar = new DevToolbar($ini, $errorArray, $route);
	$toolbarAdress = $toolbar ->toolbar();
	require_once $toolbarAdress; 
}