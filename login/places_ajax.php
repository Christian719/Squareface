<?php
	//require("phpsqlajax_dbinfo.php");
    include("functions.php");
	$conex = connection();
	
	function parseToXML($htmlStr){
	    $xmlStr=str_replace('<','&lt;',$htmlStr);
	    $xmlStr=str_replace('>','&gt;',$xmlStr);
	    $xmlStr=str_replace('"','&quot;',$xmlStr);
	    $xmlStr=str_replace("'",'&#39;',$xmlStr);
	    $xmlStr=str_replace("&",'&amp;',$xmlStr);
	    return $xmlStr;
	}

	// Select all the rows in the markers table
    $query = "SELECT * FROM place";
	$result = $conex->query($query);
    if (!$result) {
        die('Invalid query: ' . mysql_error());
    }

    header("Content-type: text/xml");

    // Start XML file, echo parent node
    echo '<place>';

    // Iterate through the rows, printing XML nodes for each
	while ($row = $result->fetch_assoc()) {
		//select image
		$id_place = $row['id'];
		$type = $row['category'];
		$image_place = $row['image'];
		$select_image = "SELECT * FROM image WHERE papa_id = '$id_place' and type = '$type'";
		$result_image = $conex->query($select_image);
		$row_select_image = $result_image->fetch_assoc();
			$ext = $row_select_image['img_type'];
			$filename = "../photos/place/$type/$image_place$ext";
					
		if (file_exists($filename)) {
			$filename = $filename;
		} 
		else {
			$filename = "../photos/place/$type/default.png";
		}
		
		// ADD TO XML DOCUMENT NODE
		echo '<place ';
		echo 'name="' . parseToXML($row['name']) . '" ';
		echo 'address="' . parseToXML($row['address']) . '" ';
		echo 'lat="' . $row['lat'] . '" ';
		echo 'lon="' . $row['lon'] . '" ';
		echo 'schedule="' . parseToXML($row['schedule']) . '" ';
		echo 'phone="' . parseToXML($row['phone']) . '" ';
		echo 'category_id="' . parseToXML($row['category']) . '" ';
		echo 'image="' . parseToXML($filename) . '" ';
		echo '/>';
    }

    // End XML file
    echo '</place>';	

?>
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  