<?php
	//connection
	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Update
	if (isset($_POST) && count($_POST)>0){
		$update = "update category set ".$_POST["campo"]."='".$_POST["valor"]."' where id='".intval($_POST["id"])."'";
		$result_update = $conex->query($update);
		if ($result_update) echo "<span class='ok'>Updated values</span>";
		else echo "<span class='ko'>".$conex->error."</span>";	
	}
	
	//query
	if (isset($_GET) && count($_GET)==1){
		$query = "select * from category order by id asc";
		$result = $conex->query($query);
		$data=array();
		while ($category = $result->fetch_array()) {  
			$data[]=array(	"id"=>$category["id"],
							"name"=>$category["name"]
			);
		}
		echo json_encode($data);
	}
	
	$conex->close();
?>