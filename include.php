<?php 
	// This file is for including all project needed files
	include_once('project_settings.php');

	foreach (glob("common/*.php") as $filename) {
		include_once($filename);
	}

	$db = new DB(HOST,USERNAME,PASSWORD,DATABASE);
	$app = new App();
	$app->startSession(); // Start session
	$message = json_encode(array('text' => '','icon' => '')); // Set notification message
 
?>