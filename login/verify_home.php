<?php 
	//connection to the database
	require_once('connection_db.php');
	
	//Session variables
	if (!isset($_SESSION)) {
	  session_start();
	}
	
	//Receive data entered in the form
	$email= $_POST['email'];
	$password=md5($_POST['password']);
	
	//Check if the data are stored in the database
	$query= "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'"; 
	$result= mysql_query($query,$conex) or die (mysql_error());
	$row=mysql_fetch_array($result);
	
	
	if (!$row[0]) //Option 1: If the user does not exist or data are incorrect
	{
		echo '<script language = javascript>
		alert("User or password invalid. Please check.")
		self.location = "../"
		</script>';
	}
	else //Option 2: User log in correctly
	{
		//We define the session variable and redirect the user page
		$_SESSION['id'] = $row['id'];
		$_SESSION['nickname'] = $row['nickname'];
	
		header("Location: home.php");
	}
?>