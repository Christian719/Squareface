<?php
	//connection
	include("functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Validate if you are actively involved in successfully
	if (!$_SESSION){
		echo '<script language = javascript>
		alert("You must log in")
		self.location = "../"
		</script>';
	}	
	
	$birthdate= $_POST['birthdate'];
	$phone= $_POST['phone'];
	$city= $_POST['city'];
	//if (file_exists("new_image_user")) {
	if ($_FILES['new_image_user']['name'] != null){		
		$img_type=$_FILES["new_image_user"]["type"];
		$ext = explode("image/",$img_type);
		$extension = end($ext);
		
		//actualizamos	
		$update_user = "UPDATE user SET birthdate='$birthdate', phone='$phone', city='$city' WHERE id = '$_SESSION[id]'";
		$result= $conex->query($update_user);
		
		if ($extension == "jpg" || $extension == "gif" || $extension == "png" || $extension == "jpeg"){
		
			$type = "user";	
			$select_image = "SELECT * FROM image WHERE papa_id = '$_SESSION[id]'";
			$result= $conex->query($select_image);
			$row_select_image = $result->fetch_assoc();
			
			$update_image = "UPDATE image SET img_type='$extension' WHERE papa_id = '$_SESSION[id]' and type = '$type'";
			$result= $conex->query($update_image);
			
			$tipo = $ext[1];
			$destino = "../photos/user/";
			$nombre = $row_select_image['id'];
			$ruta = "".$destino."".$nombre.".".$tipo.""; // CREAMOS LA RUTA
			move_uploaded_file ( $_FILES [ 'new_image_user' ][ 'tmp_name' ], $ruta); // Subimos el archivo
			//$resultado = "Enhorabuena el archivo ha sido subido con éxito";
		
			$conex->close();
			header("Location: home.php");
		}
		
		else{
			$conex->close();
			echo '<script language = javascript>
					alert("Invalid image format, the image will not be saved")
					self.location = "home.php"
				</script>';
		}
	} 
	else {
		$update_user = "UPDATE user SET birthdate='$birthdate', phone='$phone', city='$city' WHERE id = '$_SESSION[id]'";
		$result= $conex->query($update_user);
		$conex->close();
		header("Location: home.php");
	}	
?>