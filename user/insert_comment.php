<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Get the type of insertion
	$add_type=$_GET['add'];
	
	//insert---------------------------------------------------
	//comment
	if($add_type=="com"){	
		$comment = $_POST['comment'];
		$time = time();
		$date = date("Y-m-d H:i:s", $time);	
		$place_id = $_POST['place_id'];
		$user_id = $_POST['user_id'];
			
		$insert = "INSERT INTO comment (comment, date, place_id, user_id) VALUES ('$comment', '$date', '$place_id', '$user_id')";
		$result = $conex->query($insert);
		
		//select id comment
		$query_id_com= "SELECT id FROM comment WHERE comment='$comment' AND date='$date'"; 
		$result_id_com= $conex->query($query_id_com);
		$row_id_com = $result_id_com->fetch_assoc();		
		$id_comment=$row_id_com['id'];
		
		//insert activity
		$insert_activity = "INSERT INTO activity (date, papa_id, data, type, user_id, place_id) VALUES ('$date', '$id_comment', '$comment', 'Comment', '$user_id', 'place_id')";
		$result_activity = $conex->query($insert_activity);
		
		//insert image for the comment
		$path = $_FILES['image']['tmp_name'];
		$img_type="";
		$type="comment";
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
		
		$insert_ima = "INSERT INTO image (img_type, type, papa_id) VALUES ('$img_type','$type','$id_comment')";
		$result_ima = $conex->query($insert_ima);
		
		//select id image
		$query_id_ima= "SELECT id FROM image WHERE type='$type' and papa_id='$id_comment'"; 
		$result_id_ima= $conex->query($query_id_ima);
		$row_id_ima = $result_id_ima->fetch_assoc();		
		$id_image=$row_id_ima['id'];
		
		//update image_id in promo
		$update_up_pro = "UPDATE comment SET image='$id_image' WHERE id = '$id_comment'";
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
	
	$conex->close();
	header("Location: ./");
?>