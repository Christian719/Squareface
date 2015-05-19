<?php
	function connection(){
		//$host = "localhost";
		$host = "127.0.0.1";
		$user = "root";
		//$password = "Drogas";
		$password = "root123";
		$db = "squareface";
       
        $conex = new mysqli($host,$user,$password,$db);
        
        if($conex->connect_error){
            die("Connection error: ".$conex->connect_errno.
                                      "-".$conex->connect_error);
        } 
		
		/*Change the character set to utf8*/
		if (!$conex->set_charset("utf8")) {
			printf("Error loading the character set utf8");
		} else {
			$conex->character_set_name();
		}
		       
        return $conex;
	}
	
	function user_avatar(){
		$conex = connection();
		$select_image = "SELECT * FROM image WHERE papa_id = '$_SESSION[id]'";
		$result = $conex->query($select_image);
		$row_select_image = $result->fetch_assoc();
			$id = $row_select_image['id'];
			$ext = $row_select_image['img_type'];
			$filename = "../photos/user/$id$ext";
					
		if (file_exists($filename)) {
			$filename = $filename;
		} 
		else {
			$filename = '../photos/user/default.png';
		}
		$conex->close();
		echo $filename;
	}	
?>