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
		
		//upload image
		$destination = "../photos/".$type."/";
		$route = "".$destination."".$id_image.".".$img_type.""; // add the route
		move_uploaded_file ($path, $route); // Upload file	
		
	}
?>