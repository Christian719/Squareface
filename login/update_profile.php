<?php
	//connection
	include("functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//con este codigo actualizamos la informacion del usuario
	if (isset($_POST) && count($_POST)>0){
		$query = "update user set ".$_POST["campo"]."='".$_POST["valor"]."' where id='$_SESSION[id]'";
		$result = $conex->query($query);
		if ($result) echo "<span class='ok'>Valores modificados correctamente.</span>";
		else echo "<span class='ko'>".$conex->error."</span>";	
	}
	
	//con este codigo hacemos una consulta de la base de datos
	if (isset($_GET) && count($_GET)==1){
		$query = "select * from user WHERE id = '$_SESSION[id]'";
		$result = $conex->query($query);
		$datos=array();
		while ($usuarios=$result->fetch_array()){
			$datos[]=array(	"id"=>$usuarios["id"],
							"name"=>$usuarios["name"],
							"last_name"=>$usuarios["last_name"],
							"birthdate"=>$usuarios["birthdate"],
							"city"=>$usuarios["city"],
							"phone"=>$usuarios["phone"],
							"email"=>$usuarios["email"],
							"nickname"=>$usuarios["nickname"],
							"password"=>$usuarios["password"]
			);
		}
		echo json_encode($datos);
	}
?>