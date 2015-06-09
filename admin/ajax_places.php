<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Update
	if (isset($_POST) && count($_POST)>0){
		$update = "update place set ".$_POST['campo']."='".$_POST['valor']."' where id='".intval($_POST['id'])."'";
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
			//select name of category
			$cat_id = $place['category_id'];
			$query_cat= "SELECT name FROM category WHERE id='$cat_id'"; 
			$result_cat= $conex->query($query_cat);
			$row_cat = $result_cat->fetch_assoc();	
			$cat_name = $row_cat['name'];
			
			//select name image
			$image = $place['image'];
			$query_img= "SELECT img_type FROM image WHERE id='$image'"; 
			$result_img= $conex->query($query_img);
			$row_img = $result_img->fetch_assoc();	
			$img_type = $row_img['img_type'];
			$image_name=$image.".".$img_type;
			
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
							"category_name"=>$cat_name,	
							"image_name"=>$image_name,						
							"tags_id"=>$tag_ids
			);
		}
		echo json_encode($data);
	}
	
	$conex->close();
?>