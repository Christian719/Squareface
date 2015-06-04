<?php
	//connection
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//With this code update user information
	if (isset($_POST) && count($_POST)>0){
		$query = "update user set ".$_POST["campo"]."='".$_POST["valor"]."' where id='$_SESSION[id]'";
		$result = $conex->query($query);
		if ($result) echo "<span class='ok'>Updated values</span>";
		else echo "<span class='ko'>".$conex->error."</span>";	
	}
	
	//With this code we query the database
	if (isset($_GET) && count($_GET)==1){
		$query = "select * from user WHERE id = '$_SESSION[id]'";
		$result = $conex->query($query);
		$data=array();
		while ($users=$result->fetch_array()){
			$data[]=array(	"id"=>$users["id"],
							"name"=>$users["name"],
							"last_name"=>$users["last_name"],
							"birthdate"=>$users["birthdate"],
							"city"=>$users["city"],
							"phone"=>$users["phone"],
							"email"=>$users["email"],
							"nickname"=>$users["nickname"],
							"password"=>$users["password"]
			);
		}
		echo json_encode($data);
	}
	$conex->close();
?>