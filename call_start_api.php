<?php 
	header("content-type:application/json");
	extract($_REQUEST);
	echo file_get_contents("http://34.220.142.157:5000/start?account_id=".$account_id."&email=".$email."&password=".$password."");
?>