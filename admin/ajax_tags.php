<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Update
	if (isset($_POST) && count($_POST)>0){
		$update = "update tags set ".$_POST['campo']."='".$_POST['valor']."' where id='".intval($_POST['id'])."'";
		$result_update = $conex->query($update);
		if ($result_update) echo "<span class='ok'>Updated values</span>";
		else echo "<span class='ko'>".$conex->error."</span>";	
	}
	
	//query
	if (isset($_GET) && count($_GET)==1){
		$query = "select * from tags order by id asc limit 12";
		$result = $conex->query($query);
		$data=array();
		while ($tags = $result->fetch_array()) {	
			//select name of category
			$cat_id = $tags['category_id'];
			if($cat_id==0){
				$cat_name = "All categories";
			}
			else{
				$query_cat= "SELECT name FROM category WHERE id='$cat_id'"; 
				$result_cat= $conex->query($query_cat);
				$row_cat = $result_cat->fetch_assoc();	
				$cat_name = $row_cat['name'];	
			}	
			  
			$data[]=array(	"id"=>$tags["id"],
							"name"=>$tags["name"],
							"category_id"=>$tags["category_id"],
							"category_name"=>$cat_name
			);
		}
		echo json_encode($data);
	}
	
	$conex->close();
?>