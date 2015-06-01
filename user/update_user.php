<?php
	//connection
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();	
	
	$birthdate= $_POST['birthdate'];
	$phone= $_POST['phone'];
	$city= $_POST['city'];
	//if (file_exists("new_image_user")) {
	if ($_FILES['new_image_user']['name'] != null){		
		$img_type=$_FILES["new_image_user"]["type"];
		$ext = explode("image/",$img_type);
		$extension = end($ext);
		
		//update	
		$update_user = "UPDATE user SET birthdate='$birthdate', phone='$phone', city='$city' WHERE id = '$_SESSION[id]'";
		$result= $conex->query($update_user);
		
		if ($extension == "jpg" || $extension == "gif" || $extension == "png" || $extension == "jpeg"){
		
			$type = "user";	
			$select_image = "SELECT * FROM image WHERE papa_id = '$_SESSION[id]'";
			$result= $conex->query($select_image);
			$row_select_image = $result->fetch_assoc();
			
			$update_image = "UPDATE image SET img_type='$extension' WHERE papa_id = '$_SESSION[id]' and type = '$type'";
			$result= $conex->query($update_image);
			
			$type_ext = $ext[1];
			$destination = "../photos/user/";
			$name = $row_select_image['id'];
			$route = "".$destination."".$name.".".$type_ext.""; // add the route
			move_uploaded_file ( $_FILES [ 'new_image_user' ][ 'tmp_name' ], $route); // Upload file
			//$resultado = "Congratulations the file has been uploaded successfully";
		
			$conex->close();
			header("Location: ../login/home.php");
		}
		
		else{
			$conex->close();
			echo '<script language = javascript>
					alert("Invalid image format, the image will not be saved")
					self.location = "../login/home.php"
				</script>';
		}
	} 
	else {
		$update_user = "UPDATE user SET birthdate='$birthdate', phone='$phone', city='$city' WHERE id = '$_SESSION[id]'";
		$result= $conex->query($update_user);
		$conex->close();
		header("Location: ../login/home.php");
	}	
?>