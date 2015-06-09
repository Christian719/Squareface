<?php
	//connection
	include("../include/functions.php");
	$conex = connection();
			
	$email= $_POST['email_new'];
	$password=md5($_POST['password1_new']);
	
	$name = $_POST['name'];
	$last_name = $_POST['last_name'];
	$nickname = $_POST['nickname'];
	//verify that the email exists
	$newemail="SELECT email from user WHERE email='$email'";
	$result = $conex->query($newemail);
	if(mysqli_num_rows($result)>0){		
		$conex->close();
		echo '<script language = javascript>
			alert("This email is already in use... Please check")
			window.location.href="../";
		</script>';
		//header("Location: ../");
	}
	else{	
		//insert
		$insert = "INSERT INTO user (name, last_name, nickname, email, password) VALUES ('$name','$last_name','$nickname','$email','$password')";
		$result = $conex->query($insert);
		
		//Check if the data are stored in the database
		$query= "SELECT id FROM user WHERE email='".$email."' AND password='".$password."'"; 
		$result= $conex->query($query);
		$row = $result->fetch_assoc();
		
		$id_user=$row['id'];
		
		//Session variables
		if (!isset($_SESSION)) {
		  session_start();
		}
		
		//We define the session variable and redirect the user page
		$_SESSION['id'] = $row['id'];
		$_SESSION['nickname'] = $row['nickname'];
		$_SESSION['user_new'] = 1;
		
		//insert a default image for the user
		$insert = "INSERT INTO image (img_type, type, papa_id) VALUES ('.png','user','$id_user')";
		$result = $conex->query($insert);
		
		//Check if the image are stored in the database
		$query= "SELECT * FROM image WHERE type='user' and papa_id='".$id_user."'"; 
		$result= $conex->query($query);
		$row = $result->fetch_array(MYSQLI_BOTH);
		
		$id_image=$row['id'];
		
		//update the user's image
		$update = "UPDATE user SET image='$id_image' WHERE id = '$id_user'";
		$result= $conex->query($update);
		
		$conex->close();
		header("Location: ../login/home.php");
	}	
?>