<?php
	//connection
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();	
	
	$birthdate= $_POST['birthdate'];
	$phone= $_POST['phone'];
	$city= $_POST['city'];
	$id_image = $_POST['id_image'];
	
	$path = $_FILES['new_image_user']['tmp_name'];
	
	if (is_file($path)) {		
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $path);
		
		//update	
		$update_user = "UPDATE user SET birthdate='$birthdate', phone='$phone', city='$city' WHERE id = '$_SESSION[id]'";
		$result= $conex->query($update_user);
		
		if ($mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/gif' || $mime == 'image/jpeg') {
			$ext = explode("image/",$mime);
			$ext_mime = end($ext);			
			$type=$ext_mime;
			
			$update_img = "update image set img_type='$type' where id='$id_image'";
			$result_update_img = $conex->query($update_img);
			
			$destination = "../photos/user/";
			$route = "".$destination."".$id_image.".".$type.""; // add the route
			move_uploaded_file ($path, $route); // Upload file
			
			$conex->close();
			header("Location: ../login/home.php");				
		}
		else{
			echo '<script language = javascript>
				alert("Invalid image format, the image will not be saved");
				window.location.href="../login/home.php";
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