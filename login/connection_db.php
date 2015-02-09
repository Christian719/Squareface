<?php 
	//connection to the database
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "squareface";
	$conex = mysql_connect($host, $user, $password) or die ("Connection error");
	mysql_select_db ($db, $conex) or die ("Error in the database");
?>			