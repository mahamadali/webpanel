<?php 
	// This file is used for settings the project
	
	/* Project related settings */
	define("BASE_PATH", dirname(__FILE__));
	define("SITE_URL", 'http://localhost/webpanel/');
	define("SITE_TITLE", "WEB PANEL");

	/* Database related settings */
	define("HOST", 'localhost');
	define("USERNAME", 'root');
	define("PASSWORD", '');
	define("DATABASE", 'webpanel');

	/* Security level settings */
	define('APP_SECRET_HASH','webpanel');

	/* Backend table listing settings */
	define('RECORDS_PER_PAGE','2');

	header('Access-Control-Allow-Origin: *');

?>