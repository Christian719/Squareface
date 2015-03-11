<?php
	//conexion
	require_once('login/connection_db.php');
	
	$password=md5($_REQUEST[password]);
	
	//insertamos
	$insert = mysql_query("INSERT INTO user (name, last_name, nickname, email, password) VALUES ('$_REQUEST[name]','$_REQUEST[last_name]','$_REQUEST[nickname]','$_REQUEST[email]','$password')") or die("Error SQL");
	
	//Session variables
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	//We define the session variable and redirect the user page
	$_SESSION['nickname'] = $_REQUEST[nickname];
	
	header("Location: login/user_page.php");
?>