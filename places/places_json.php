<?php
	//include the connection
    include("../include/functions.php");
	$conex = connection();
	
	$query = "SELECT * FROM place";
	$result = $conex->query($query);

	$outp = "[";
	while($rs = $result->fetch_assoc()) {
		$place_category = $rs['category_id'];
		//select category
		$select_category = "SELECT name FROM category Where id ='$place_category'";
		$result_category = $conex->query($select_category);
		while ($row_select_category = $result_category->fetch_assoc())
			$type = $row_select_category['name'];
		//select image
		$id_place = $rs['id'];
		$image_place = $rs['image'];
		$select_image = "SELECT * FROM image WHERE papa_id = '$id_place' and type = '$type'";
		$result_image = $conex->query($select_image);
		$row_select_image = $result_image->fetch_assoc();
			$ext = $row_select_image['img_type'];
			$filename = "../photos/place/$type/$image_place.$ext";
					
		if (file_exists($filename)) {
			$filename = $filename;
		} 
		else {
			$filename = "../photos/place/$type/default.png";
		}
	
	
		if ($outp != "[") {$outp .= ",";}
		$outp .= '{"Id":"'  . $rs["id"] . '",';
		$outp .= '"Name":"'  . $rs["name"] . '",';
		$outp .= '"Address":"'   . $rs["address"] . '",';
		$outp .= '"Schedule":"'   . $rs["schedule"] . '",';
		$outp .= '"Phone":"'   . $rs["phone"] . '",';
		$outp .= '"Rating":"'   . $rs["rating"] . '",';
		$outp .= '"Category":"'   . $rs["category_id"] . '",';
		$outp .= '"Image_place":"'   .$filename . '",';
		$outp .= '"Latitude":"'   . $rs["lat"] . '",';
		$outp .= '"Longitude":"'. $rs["lon"] . '"}'; 
		
	}
	$outp .="]";
	
	$conex->close();
	
	echo($outp);
?>	