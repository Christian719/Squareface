<?php
	//connection
	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Update
	if (isset($_POST) && count($_POST)>0){
		$update = "update place set ".$_POST["campo"]."='".$_POST["valor"]."' where id='".intval($_POST["id"])."'";
		$result_update = $conex->query($update);
		if ($result_update) echo "<span class='ok'>Updated values</span>";
		else echo "<span class='ko'>".$conex->error."</span>";	
	}
	
	//query
	if (isset($_GET) && count($_GET)==1){
		$query = "select * from place order by id asc";
		$result = $conex->query($query);
		$data=array();
		while ($place = $result->fetch_array()) {
			//tags
			  $place_tags = $place['tags_id'];	
			  $tag_list = explode(",", $place_tags);
			  $tag_ids = array();					  
			  foreach($tag_list as $tag){
				  $tag_ids[] = trim($tag, "|");
			  }					  
				  
			$data[]=array(	"id"=>$place["id"],
							"name"=>$place["name"],
							"address"=>$place["address"],
							"city"=>$place["city"],
							"phone"=>$place["phone"],
							"schedule"=>$place["schedule"],
							"image"=>$place["image"],
							"rating"=>$place["rating"],
							"lat"=>$place["lat"],
							"lon"=>$place["lon"],
							"category_id"=>$place["category_id"],							
							"tags_id"=>$tag_ids
			);
		}
		echo json_encode($data);
	}
	
	$conex->close();
?>