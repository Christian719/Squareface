<?php
	//conexion
	require_once('login/connection_db.php');
	
	$email= $_POST['email_new'];
	$password=md5($_POST['password1_new']);
		
	//insertamos
	$insert = mysql_query("INSERT INTO user (name, last_name, nickname, email, password) VALUES ('$_POST[name]','$_POST[last_name]','$_POST[nickname]','$email','$password')") or die("Error SQL");
	
	//Check if the data are stored in the database
	$query= "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'"; 
	$result= mysql_query($query,$conex) or die (mysql_error());
	$row=mysql_fetch_array($result);
	
	$id_user=$row['id'];
	
	//Session variables
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	//We define the session variable and redirect the user page
	$_SESSION['id'] = $row['id'];
	$_SESSION['nickname'] = $row['nickname'];
	
	
	//insertamos una imagen default para el usuario
	$insert = mysql_query("INSERT INTO image (img_type, type, papa_id) VALUES ('.png','user','$id_user')") or die("Error SQL");
	
	//Check if the image are stored in the database
	$query= "SELECT * FROM image WHERE papa_id='".$id_user."'"; 
	$result= mysql_query($query,$conex) or die (mysql_error());
	$row2=mysql_fetch_array($result);
	
	$id_image=$row2['id'];
	
	//actualizamos la imagen del usuario
	$update = mysql_query("UPDATE user SET image='$id_image' WHERE id = '$id_user'");
	
	header("Location: login/home.php");
?>