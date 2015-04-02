<?php
	//connection
	include("functions.php");
		conexion();
	
	//session start
	session_start();
	
	//Validate if you are actively involved in successfully
	if (!$_SESSION){
		echo '<script language = javascript>
		alert("You must log in")
		self.location = "../"
		</script>';
	}	
	
	//if (file_exists("new_image_user")) {
	if ($_FILES['new_image_user']['name'] != null){		
		$img_type=$_FILES["new_image_user"]["type"];
		$ext = explode("image/",$img_type);
		$extension = end($ext);
		
		//actualizamos	
		$update_user = mysql_query("UPDATE user SET birthdate='$_REQUEST[birthdate]', phone='$_REQUEST[phone]', city='$_REQUEST[city]' WHERE id = '$_SESSION[id]'");
		
		if ($extension == "jpg" || $extension == "gif" || $extension == "png" || $extension == "jpeg"){
		
			$type = "user";	
			$select_image = mysql_query("SELECT * FROM image WHERE papa_id = '$_SESSION[id]'");
			$row_select_image = mysql_fetch_assoc($select_image);
			
			$update_image = mysql_query("UPDATE image SET img_type='$extension' WHERE papa_id = '$_SESSION[id]' and type = '$type'") or die("Error SQL");
			
			$tipo = $ext[1];
			$destino = "../photos/user/";
			$nombre = $row_select_image['id'];
			$ruta = "".$destino."".$nombre.".".$tipo.""; // CREAMOS LA RUTA
			move_uploaded_file ( $_FILES [ 'new_image_user' ][ 'tmp_name' ], $ruta); // Subimos el archivo
			//$resultado = "Enhorabuena el archivo ha sido subido con éxito";
		
			header("Location: home.php");
		}
		
		else{
			echo '<script language = javascript>
					alert("Formato de imagen no valido, la imagen no sera guardada")
					self.location = "home.php"
				</script>';
		}
	} 
	else {
		$update_user = mysql_query("UPDATE user SET birthdate='$_REQUEST[birthdate]', phone='$_REQUEST[phone]', city='$_REQUEST[city]' WHERE id = '$_SESSION[id]'");
		header("Location: home.php");
	}	
?>