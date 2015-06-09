<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Update
	if (isset($_POST) && count($_POST)>0){
		if($_POST['campo']=="image"){			
			$path = $_POST['valor'];
			$punto =".";
			$type = strpos ($path, $punto); 
			$ext = substr ($path, ($type+1)); 
			
			//id image
			$id_promo = $_POST['id'];
			$query_id_img= "SELECT image FROM promotion WHERE id='$id_promo'"; 
			$result_id_img= $conex->query($query_id_img);
			$row_id_img = $result_id_img->fetch_assoc();	
			$id_image = $row_id_img['image'];
			
			//update ext table images
			$update = "update image set img_type='$ext' where type='promotion' and papa_id='$id_promo'";
			$result_update = $conex->query($update);
			
			//upload image
			$hola = $_FILES[$path]['tmp_name'];
			$destination = "../photos/promotion/";
			$route = "".$destination."".$id_image.".".$ext.""; // add the route
			move_uploaded_file ($hola, $route); // Upload file	
			
			echo "<span class='ok'>soy bueno ".$id_image.".".$ext."</span>";	
		}
		else{
			$update = "update promotion set ".$_POST['campo']."='".$_POST['valor']."' where id='".intval($_POST['id'])."'";
			$result_update = $conex->query($update);
			if ($result_update) echo "<span class='ok'>Updated values</span>";
			else echo "<span class='ko'>".$conex->error."</span>";	
		}	
	}
	
	//query
	if (isset($_GET) && count($_GET)==1){
		$query = "select * from promotion order by id asc";
		$result = $conex->query($query);
		$data=array();
		while ($promotion = $result->fetch_array()) {
			//select name of day
			$day = $promotion['day'];
			$day_name;
			  if ($day == 1){
				$day_name="Sunday";
			  }
			  if ($day == 2){
				$day_name="Monday";
			  }
			  if ($day == 3){
				$day_name="Tuesday";
			  }
			  if ($day == 4){
				$day_name="Wednesday";
			  }
			  if ($day == 5){
				$day_name="Thursday";
			  }
			  if ($day == 6){
				$day_name="Friday";
			  }
			  if ($day == 7){
				$day_name="Saturday";
			  }	  
				
			//select name of place
			$pla_id = $promotion['place_id'];
			$query_pla= "SELECT name FROM place WHERE id='$pla_id'"; 
			$result_pla= $conex->query($query_pla);
			$row_pla = $result_pla->fetch_assoc();	
			$pla_name = $row_pla['name'];
			
			//select name of category
			$cat_id = $promotion['category_id'];
			$query_cat= "SELECT name FROM category WHERE id='$cat_id'"; 
			$result_cat= $conex->query($query_cat);
			$row_cat = $result_cat->fetch_assoc();	
			$cat_name = $row_cat['name'];
			
			//select name image
			$image = $promotion['image'];
			$query_img= "SELECT img_type FROM image WHERE id='$image'"; 
			$result_img= $conex->query($query_img);
			$row_img = $result_img->fetch_assoc();	
			$img_type = $row_img['img_type'];
			$image_name=$image.".".$img_type;
					  
			$data[]=array(	"id"=>$promotion["id"],
							"day"=>$promotion["day"],
							"promotion"=>$promotion["promotion"],
							"image"=>$promotion["image"],
							"place_name"=>$pla_name,
							"category_name"=>$cat_name,
							"day_name"=>$day_name,
							"image_name"=>$image_name
			);
		}
		echo json_encode($data);
	}
	
	$conex->close();
?>