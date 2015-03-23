<?php
	//conexion
	require_once('login/connection_db.php');
	
	$email=$_REQUEST[email];
	$password=md5($_REQUEST[password]);
	
	//insertamos
	$insert = mysql_query("INSERT INTO user (name, last_name, nickname, email, password) VALUES ('$_REQUEST[name]','$_REQUEST[last_name]','$_REQUEST[nickname]','$_REQUEST[email]','$password')") or die("Error SQL");
	
	//Check if the data are stored in the database
	$query= "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'"; 
	$result= mysql_query($query,$conex) or die (mysql_error());
	$row=mysql_fetch_array($result);
	
	//Session variables
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	//We define the session variable and redirect the user page
	$_SESSION['id'] = $row['id'];
	$_SESSION['nickname'] = $row['nickname'];
	
	header("Location: login/home.php");
?>