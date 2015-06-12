<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Get the type of insertion
	$add_type=$_GET['add'];
	

	//category
	if($add_type=="cat"){	
		$name= $_POST['name'];
		$insert = "INSERT INTO category (name, status) VALUES ('$name', '1')";
		$result = $conex->query($insert);
	}
	
	//tag
	if($add_type=="tag"){	
		$name= $_POST['name'];
		$category= $_POST['category'];
		$insert = "INSERT INTO tags (name, category_id, status) VALUES ('$name', '$category', '1')";
		$result = $conex->query($insert);
	}
	
	//promotion
	if($add_type=="pro"){	
		$day= $_POST['day'];
		$promotion= $_POST['promotion'];
		$place_id= $_POST['place_id'];
			
			//select id category
			$query_place_id_cat= "SELECT category_id FROM place WHERE id='$place_id'"; 
			$result_place_id_cat= $conex->query($query_place_id_cat);
			$row_place_id_cat = $result_place_id_cat->fetch_assoc();		
			$category_id=$row_place_id_cat['category_id'];
			
		$insert = "INSERT INTO promotion (day, promotion, place_id, category_id, status) VALUES ('$day', '$promotion', '$place_id', '$category_id', '1')";
		$result = $conex->query($insert);
		
		//select id promo
		$query_id_pro= "SELECT id FROM promotion WHERE promotion='$promotion' AND place_id='$place_id'"; 
		$result_id_pro= $conex->query($query_id_pro);
		$row_id_pro = $result_id_pro->fetch_assoc();		
		$id_promotion=$row_id_pro['id'];
		
		//insert image for the promo
		$path = $_FILES['image']['tmp_name'];
		$img_type="";
		$type="promotion";
		if (is_file($path)) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $path);
			
			if ($mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/gif' || $mime == 'image/jpeg') {
				$ext = explode("image/",$mime);
				$ext_mime = end($ext);
				$img_type=$ext_mime;	
			}
			else{
				echo '<script language = javascript>
					alert("Invalid image format, the image will not be saved")
				</script>';
				$img_type="jpg";
			}
			finfo_close($finfo);
		}
		else{
			$img_type="jpg";			
		}
		
		$insert_ima = "INSERT INTO image (img_type, type, papa_id) VALUES ('$img_type','$type','$id_promotion')";
		$result_ima = $conex->query($insert_ima);
		
		//select id image
		$query_id_ima= "SELECT id FROM image WHERE type='$type' and papa_id='$id_promotion'"; 
		$result_id_ima= $conex->query($query_id_ima);
		$row_id_ima = $result_id_ima->fetch_assoc();		
		$id_image=$row_id_ima['id'];
		
		//update image_id in promo
		$update_up_pro = "UPDATE promotion SET image='$id_image' WHERE id = '$id_promotion'";
		$result_up_pro= $conex->query($update_up_pro);	
		
		//select name of place
		$query_name_pla= "SELECT name FROM place WHERE id='$place_id'"; 
		$result_name_pla= $conex->query($query_name_pla);
		$row_name_pla = $result_name_pla->fetch_assoc();		
		$name_place=$row_name_pla['name'];	
		
		//upload image
		$destination = "../photos/".$type."/".$name_place."/";
		if(!file_exists($destination)){  //create the folder if it does not exist
			mkdir ($destination);
		}	
		$route = "".$destination."".$id_image.".".$img_type.""; // add the route
		move_uploaded_file ($path, $route); // Upload file	
	}
	
	//place
	if($add_type=="pla"){
		$name= $_POST['name'];
		$address= $_POST['address'];
		$city= $_POST['city'];
		$phone= $_POST['phone'];
		$schedule= $_POST['schedule'];
		$rating= $_POST['rating'];
		$lat= $_POST['lat'];
		$lon= $_POST['lon'];
		$category_id= $_POST['category_id'];
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
		
		$insert = "INSERT INTO place (name, address, city, phone, schedule, rating, lat, lon, category_id, tags_id, status) VALUES ('$name', '$address', '$city', '$phone', '$schedule', '$rating', '$lat', '$lon', '$category_id', '$tags_id_all', '1')";
		$result = $conex->query($insert);
		
		//select id place
		$query_id_pla= "SELECT id FROM place WHERE name='$name' AND lat='$lat'"; 
		$result_id_pla= $conex->query($query_id_pla);
		$row_id_pla = $result_id_pla->fetch_assoc();		
		$id_place=$row_id_pla['id'];
		
		//select name of category
		$query_name_cat= "SELECT name FROM category WHERE id='$category_id'"; 
		$result_name_cat= $conex->query($query_name_cat);
		$row_name_cat = $result_name_cat->fetch_assoc();		
		$name_category=$row_name_cat['name'];
		
		//insert image for the place
		$path = $_FILES['image']['tmp_name'];
		$img_type="";
		$type=$name_category;
		if (is_file($path)) {
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mime = finfo_file($finfo, $path);
			
			if ($mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/gif' || $mime == 'image/jpeg') {
				$ext = explode("image/",$mime);
				$ext_mime = end($ext);
				$img_type=$ext_mime;	
			}
			else{
				echo '<script language = javascript>
					alert("Invalid image format, the image will not be saved")
				</script>';
				$img_type="jpg";
			}
			finfo_close($finfo);
		}
		else{
			$img_type="jpg";			
		}
		
		$insert_ima = "INSERT INTO image (img_type, type, papa_id) VALUES ('$img_type','$type','$id_place')";
		$result_ima = $conex->query($insert_ima);
		
		//select id image
		$query_id_ima= "SELECT id FROM image WHERE type='$type' and papa_id='$id_place'"; 
		$result_id_ima= $conex->query($query_id_ima);
		$row_id_ima = $result_id_ima->fetch_assoc();		
		$id_image=$row_id_ima['id'];
		
		//update image_id in place
		$update_up_pla = "UPDATE place SET image='$id_image' WHERE id = '$id_place'";
		$result_up_pla= $conex->query($update_up_pla);	
		
		//upload image
		$destination = "../photos/place/".$type."/";
		if(!file_exists($destination)){  //create the folder if it does not exist
			mkdir ($destination);
		}
		$route = "".$destination."".$id_image.".".$img_type.""; // add the route
		move_uploaded_file ($path, $route); // Upload file	
	}
	
	//gallery
	if($add_type=="gal"){
		//obtain the information of the image
		$path = $_FILES['image']['tmp_name'];		
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $path);
		
		if ($mime == 'image/png' || $mime == 'image/jpg' || $mime == 'image/gif' || $mime == 'image/jpeg') {
			$ext = explode("image/",$mime);
			$ext_mime = end($ext);			
			
			//obtain info form insert
			$comment= $_POST['comment'];
			$place_id= $_POST['place_id'];
			$date=date("Y-m-d");
			$type=$ext_mime;
			
			$insert = "INSERT INTO gallery (comment, date, type, place_id, status) VALUES ('$comment', '$date', '$type', '$place_id', '1')";
			$result = $conex->query($insert);
			
			//select id gallery for the image
			$query_id_gal= "SELECT id FROM gallery WHERE comment='$comment' and place_id='$place_id'"; 
			$result_id_gal= $conex->query($query_id_gal);
			$row_id_gal = $result_id_gal->fetch_assoc();		
			$id_gallery=$row_id_gal['id'];
			
			//select name of place
			$query_name_pla= "SELECT name FROM place WHERE id='$place_id'"; 
			$result_name_pla= $conex->query($query_name_pla);
			$row_name_pla = $result_name_pla->fetch_assoc();		
			$name_place=$row_name_pla['name'];			
			
			//upload image
			$destination = "../gallery/".$name_place."/";			
			if(!file_exists($destination)){  //create the folder if it does not exist
				mkdir ($destination);
			}			
			$route = "".$destination."".$id_gallery.".".$type.""; // add the route
			move_uploaded_file ($path, $route); // Upload file					
		}
		else{
			echo '<script language = javascript>
				alert("Invalid image format, this image does not appear in the gallery")
			</script>';
		}
		finfo_close($finfo);
	}
		
	$conex->close();
	header("Location: ./");
?>