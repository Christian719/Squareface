<?php
	//connection
	include("login/functions.php");
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
		$sname = serialize($name);
		$slast_name = serialize($last_name);
		$snick = serialize($nickname);
		$semail = serialize($email);
	    file_put_contents('st_name', $sname);
		file_put_contents('st_last', $slast_name);
		file_put_contents('st_nick', $snick);
		file_put_contents('st_email', $semail);
		
		$serr = serialize(1);
		file_put_contents('st_err', $serr);
		
		echo '<script language = javascript>
			alert("This email is already in use... Please check")
			window.location.href="index.php";
		</script>';
	}
	else{	
		//insert
		$insert = "INSERT INTO user (name, last_name, nickname, email, password) VALUES ('$name','$last_name','$nickname','$email','$password')";
		$result = $conex->query($insert);
		
		//Check if the data are stored in the database
		$query= "SELECT * FROM user WHERE email='".$email."' AND password='".$password."'"; 
		$result= $conex->query($query);
		$row = $result->fetch_array(MYSQLI_BOTH);
		
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
		$query= "SELECT * FROM image WHERE papa_id='".$id_user."'"; 
		$result= $conex->query($query);
		$row = $result->fetch_array(MYSQLI_BOTH);
		
		$id_image=$row['id'];
		
		//update the user's image
		$update = "UPDATE user SET image='$id_image' WHERE id = '$id_user'";
		$result= $conex->query($update);
		
		header("Location: login/home.php");
	}	
?>