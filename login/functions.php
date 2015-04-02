<?php
	function conexion(){
		$host = "localhost";
		$user = "root";
		$password = "";
		$db = "squareface";
		$conex = mysql_connect($host, $user, $password) or die ("Connection error");
		mysql_select_db ($db, $conex) or die ("Error in the database");
	}
	
	function avatar_user(){
		$select_image = mysql_query("SELECT * FROM image WHERE papa_id = '$_SESSION[id]'");
		$row_select_image = mysql_fetch_assoc($select_image);
		
		$id = $row_select_image['id'];
		$ext = $row_select_image['img_type'];
		$nombre_fichero = "../photos/user/$id.$ext";
		
		if (file_exists($nombre_fichero)) {
			$nombre_fichero = $nombre_fichero;
		} else {
			$nombre_fichero = '../photos/user/default.png';
		}
		echo $nombre_fichero;
	}
?>