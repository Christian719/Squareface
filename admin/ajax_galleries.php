<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Update
	if (isset($_POST) && count($_POST)>0){
		$update = "update gallery set ".$_POST['campo']."='".$_POST['valor']."' where id='".intval($_POST['id'])."'";
		$result_update = $conex->query($update);
		if ($result_update) echo "<span class='ok'>Updated values</span>";
		else echo "<span class='ko'>".$conex->error."</span>";	
	}
	
	//query
	if (isset($_GET) && count($_GET)==1){
		$query = "select * from gallery order by id asc";
		$result = $conex->query($query);
		$data=array();
		while ($gallery = $result->fetch_array()) {	
			//select name of place
			$pla_id = $gallery['place_id'];
			$query_pla= "SELECT name FROM place WHERE id='$pla_id'"; 
			$result_pla= $conex->query($query_pla);
			$row_pla = $result_pla->fetch_assoc();	
			$pla_name = $row_pla['name'];
			
			//select name image
			$id = $gallery['id'];
			$type = $gallery['type'];
			$image_name=$id.".".$type;
					  
			$data[]=array(	"id"=>$gallery["id"],
							"comment"=>$gallery["comment"],
							"date"=>$gallery["date"],
							"place_name"=>$pla_name,
							"image_name"=>$image_name
			);
		}
		echo json_encode($data);
	}
	
	$conex->close();
?>