<?php
	//connection
	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Update
	if (isset($_POST) && count($_POST)>0){
		$update = "update promotion set ".$_POST["campo"]."='".$_POST["valor"]."' where id='".intval($_POST["id"])."'";
		$result_update = $conex->query($update);
		if ($result_update) echo "<span class='ok'>Updated values</span>";
		else echo "<span class='ko'>".$conex->error."</span>";	
	}
	
	//query
	if (isset($_GET) && count($_GET)==1){
		$query = "select * from promotion order by id asc";
		$result = $conex->query($query);
		$data=array();
		while ($promotion = $result->fetch_array()) {			  
			$data[]=array(	"id"=>$promotion["id"],
							"day"=>$promotion["day"],
							"promotion"=>$promotion["promotion"],
							"image"=>$promotion["image"],
							"place_id"=>$promotion["place_id"],
							"category_id"=>$promotion["category_id"]
			);
		}
		echo json_encode($data);
	}
	
	$conex->close();
?>