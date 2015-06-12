<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Get the table of delete
	$edit_table=$_GET['edit'];
	
	//category
	if($edit_table=="cat"){
		$id = $_POST['id']; 	
		$name = $_POST['name']; 	
		$update = "update category set name='$name' where id='$id'";
		$result_update = $conex->query($update);	
	}
	
	//tags
	if($edit_table=="tag"){
		$id = $_POST['id']; 	
		$name = $_POST['name'];
		$category_id = $_POST['category']; 	 	
		$update = "update tags set name='$name', category_id='$category_id' where id='$id'";
		$result_update = $conex->query($update);	
	}
	
	//galery
	if($edit_table=="gal"){
		$id_gallery = $_POST['id']; 	
		$comment = $_POST['comment'];
		$type = $_POST['type'];	
		
		$path = $_FILES['image']['tmp_name'];
		if (is_file($path)) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $path);
			
			if ($mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/gif' || $mime == 'image/jpeg') {
				$ext = explode("image/",$mime);
				$ext_mime = end($ext);			
				
				//obtain info form insert
				$name_place= $_POST['place_name'];
				$date=date("Y-m-d");
				$type=$ext_mime;
				
				//obtain id of place
				$query_id_pla= "SELECT id FROM place WHERE name='$name_place'"; 
				$result_id_pla= $conex->query($query_id_pla);
				$row_id_pla = $result_id_pla->fetch_assoc();		
				$place_id=$row_id_pla['id'];
				
				$update = "update gallery set comment='$comment', type='$type' where id='$id_gallery'";
			    $result_update = $conex->query($update);
				
				//upload image
				$destination = "../gallery/".$name_place."/";		
				$route = "".$destination."".$id_gallery.".".$type.""; // add the route
				move_uploaded_file ($path, $route); // Upload file					
			}
			else{
				echo '<script language = javascript>
					alert("Invalid image format, this image does not update in the gallery")
				</script>';
			}	
		}
		else{
			$update = "update gallery set comment='$comment', type='$type' where id='$id_gallery'";
			$result_update = $conex->query($update);			
		}
	}
	
	//promotion
	if($edit_table=="pro"){
		$id_promotion = $_POST['id']; 	
		$day = $_POST['day'];
		$promo = $_POST['promotion'];	
		$id_image = $_POST['id_image'];	
		$name_place = $_POST['place'];	
		
		$path = $_FILES['image']['tmp_name'];
		if (is_file($path)) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $path);
			
			if ($mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/gif' || $mime == 'image/jpeg') {
				$ext = explode("image/",$mime);
				$ext_mime = end($ext);			
				$type=$ext_mime;
				
				//update promotion
				$update = "update promotion set day='$day', promotion='$promo', image='$id_image' where id='$id_promotion'";
				$result_update = $conex->query($update);	
				
				//update image
				$update_img = "update image set img_type='$type' where id='$id_image'";
				$result_update_img = $conex->query($update_img);		
				
				//upload image
				$destination = "../photos/promotion/".$name_place."/";
				$route = "".$destination."".$id_image.".".$type.""; // add the route
				move_uploaded_file ($path, $route); // Upload file					
			}
			else{
				echo '<script language = javascript>
					alert("Invalid image format, this image does not update in the gallery")
				</script>';
			}	
		}
		else{		
			$update = "update promotion set day='$day', promotion='$promo', image='$id_image' where id='$id_promotion'";
			$result_update = $conex->query($update);			
		}
	}
	
	//place
	if($edit_table=="pla"){
		$id_place = $_POST['id']; 	
		$name = $_POST['name'];
		$address = $_POST['address'];
		$city = $_POST['city'];
		$phone = $_POST['phone'];
		$schedule = $_POST['schedule'];
		$id_image = $_POST['id_image'];
		$lat = $_POST['lat'];
		$lon = $_POST['lon'];
		$category_id = $_POST['category_id'];
		//tags
		$tags_id=$_POST["tags_id"]; 
		$size_tags = count($tags_id);
		$tags_id_all = "";
		for ($i = 0; $i<$size_tags; $i ++){ 
			if($i>4){
			}
			else{   
				if($i>0){
					$tags_id_all=$tags_id_all.",";
				}
				$tags_id_all=$tags_id_all."|".$tags_id[$i]."|";					
			}	
		}  			
		
		$path = $_FILES['image']['tmp_name'];
		if (is_file($path)) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $path);
			
			if ($mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/gif' || $mime == 'image/jpeg') {
				$ext = explode("image/",$mime);
				$ext_mime = end($ext);			
				$type=$ext_mime;
				
				//update promotion
				$update = "update place set name='$name', address='$address', city='$city', phone='$phone', schedule='$schedule', image='$id_image', lat='$lat', lon='$lon', category_id='$category_id', tags_id='$tags_id_all' where id='$id_place'";
			$result_update = $conex->query($update);	
				
				//update image
				$update_img = "update image set img_type='$type' where id='$id_image'";
				$result_update_img = $conex->query($update_img);	
				
				//select name of category
				$query_cat= "SELECT name FROM category where id='$category_id'"; 
				$result_cat= $conex->query($query_cat);
				$row_cat = $result_cat->fetch_assoc();
				$name_category=$row_cat['name'];
				
				//upload image
				$destination = "../photos/place/".$name_category."/";
				$route = "".$destination."".$id_image.".".$type.""; // add the route
				move_uploaded_file ($path, $route); // Upload file					
			}
			else{
				echo '<script language = javascript>
					alert("Invalid image format, this information does not update in the place")
				</script>';
			}	
		}
		else{		
			$update = "update place set name='$name', address='$address', city='$city', phone='$phone', schedule='$schedule', image='$id_image', lat='$lat', lon='$lon', category_id='$category_id', tags_id='$tags_id_all' where id='$id_place'";
			$result_update = $conex->query($update);			
		}
	}
	
	$conex->close();
	header("Location: ./");
?>