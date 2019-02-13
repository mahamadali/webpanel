<?php 
	
	function dd($collection) {
		echo "<div style='background-color:#000;color:#18EF8A;padding-left:5px;padding-right:5px;'>";
		printCollection($collection);
		exit;
	}

	function dump($collection) {
		echo "<div style='background-color:#000;color:#18EFD5;padding-left:5px;padding-right:5px;'>";
		printCollection($collection);
	}
	function printCollection($collection) {
		echo "<pre>";
		print_r($collection);
		echo "</pre>";
		echo "</div>";	
	}
	function encrypt($string) {
		return md5(APP_SECRET_HASH.$string);
	}

?>