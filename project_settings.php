<?php 
	// This file is used for settings the project
	
	/* Project related settings */
	define("BASE_PATH", dirname(__FILE__));
	define("SITE_URL", 'index.php');
	define("SITE_TITLE", "WEB PANEL");

	/* Database related settings */
	define("HOST", 'linebot.ctmgpmqs8fh1.us-west-2.rds.amazonaws.com');
	define("USERNAME", 'root');
	define("PASSWORD", 'passwordlinebot');
	define("DATABASE", 'webpanel');

	/* Security level settings */
	define('APP_SECRET_HASH','webpanel');

	/* Backend table listing ssettings */
	define('RECORDS_PER_PAGE','2');

	header('Access-Control-Allow-Origin: *');
?>