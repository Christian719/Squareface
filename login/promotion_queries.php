<?php
	//connection
	error_reporting(5);
	include("functions.php");
	$conex = connection();
	
?>
	<div id="owl-demo" class="owl-carousel owl-theme scroll_y">	
<?php	
	//check if date is of today of caendar
	$caldate = $_GET["caldate"];
	$d;
	$m;	
	$num_day;
	if($caldate == -1){
		$today = getdate();
		$d = $today[mday];
		$m = $today[month];
		$num_day = $today[weekday];
		if ($num_day == "Sunday"){
	  		$num_day=1;
	    }
	    if ($num_day == "Monday"){
	  		$num_day=2;
	    }
	    if ($num_day == "Tuesday"){
	  		$num_day=3;
	    }
	    if ($num_day == "Wednesday"){
	  		$num_day=4;
	    }
	    if ($num_day == "Thursday"){
	  		$num_day=5;
	    }
	    if ($num_day == "Friday"){
	  		$num_day=6;
	    }
	    if ($num_day == "Saturday"){
	  		$num_day=7;
	    }	
	}
	else{
		$num_day=$caldate;
		$d = $_GET["day"];	
		$m = $_GET["month"];
	}
	//select * promos  
	$select_promotion;	
	if(!$_GET["id"]){
		$select_promotion = "SELECT * FROM promotion WHERE day = '$num_day' limit 10";
	}
	else{
		$id=$_GET["id"];
		$select_promotion = "SELECT * FROM promotion WHERE category_id = '$id' and day = '$num_day' limit 10";
	}
	//select the table promotions
	$result = $conex->query($select_promotion);
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
	//$row = $result->fetch_array(MYSQLI_ASSOC);
	  $day = $row['day'];
	  $promotion = $row['promotion'];
	  $image = $row['image'];
	  $place = $row['place_id'];
	  $category = $row['category_id'];
	  //name of day	  
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
	  //place
	  $select_place = "SELECT id, name, address, city, phone, schedule, rating, tags_id FROM place WHERE id='$place'";
	  $result_place = $conex->query($select_place);
	  $row_place = $result_place->fetch_array(MYSQLI_ASSOC);
	  	$place_id = $row_place['id'];
		$place_name = $row_place['name'];
		$place_address = $row_place['address'];
		$place_city = $row_place['city'];
		$place_phone = $row_place['phone'];
		$place_schedule = $row_place['schedule'];
		$place_rating = $row_place['rating'];
		$place_tags = $row_place['tags_id'];
	  //category	
	  $select_category = "SELECT name FROM category WHERE id='$category'";
	  $result_category = $conex->query($select_category);
	  $row_category = $result_category->fetch_array(MYSQLI_ASSOC);
		$category_name = $row_category['name'];	
	  //image
	  $select_image = "SELECT * FROM image WHERE id='$image'";
	  $result_image = $conex->query($select_image);
	  $row_image = $result_image->fetch_array(MYSQLI_ASSOC);
		$ext = $row_image['img_type'];
		$image_type = $row_image['type'];	
		$filename = "../photos/$image_type/$image$ext";
					
		if (file_exists($filename)) {
			$filename = $filename;
		} 
		else {
			$filename = "../photos/$image_type/default.jpg";
		}			  	  		
	?>		
	<!--pages of carrusel-->
	<div class="item">
		<div class="col-md-3 promotion_info_place">
			<h4 class="promotion_title_cat_place_info">Place information</h4> </br>
			<p class="promotion_content_place">				  	
			  <strong>Address: </strong><?php echo $place_address;?></br>
			  <strong>City: </strong><?php echo $place_city;?></br>
			  <strong>Phone: </strong><?php echo $place_phone;?></br>
			  <strong>Shedule: </strong><?php echo $place_schedule;?></br>
			</p>
		</div>
		<div class="col-md-6 promotion_info_placeandpromo">
			<a href="#" onClick="calcRoute(<?php echo $place_id;?>)"><h4 class="promotion_title_name_place" title="Take me here"><?php echo $category_name." ".$place_name;?></h4></a></br>
			<h5 class='promotion_place_raiting'>
			  <?php
				$cont = 0;
				for($cont; $cont<$place_rating; $cont ++){
					if($cont==0){
						echo"<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
					}
					if($cont==1){
						echo"<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
					}
					if($cont==2){
						echo"<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
					}
					if($cont==3){
						echo"<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
					}
					if($cont==4){
						echo"<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
					}
				}
				for($cont; $cont<5; $cont ++){
					echo"<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
				}						
			  ?>
			</h5> </br>
			<img class="promotion_image" src="<?php echo $filename; ?>" title="<?php echo $promotion;?>">	
		</div>
		<div class="col-md-3 promotion_info_promo">  
			<h4 class="promotion_title_cat_place_promo">Promotion</h4></br>
			<p class="promotion_content_promo">	
			  <strong>Date: </strong><?php echo $day_name." ".$d.", ".$m.".";?></br>			  	  
			  <strong>Promo: </strong><?php echo $promotion;?></br>
			</p></br>
			<h4 class="promotion_title_cat_place_tags">Tags</h4></br>
			<p class="promotion_content_tags">				  	  
			  <?php
				  //tags
				  $place_tags;	
				  $tag_list = explode(",", $place_tags);
				  $tag_ids = array();					  
				  foreach($tag_list as $tag){
					  $tag_ids[] = trim($tag, "|");
				  }		  					  
				  $select_tags = "SELECT name FROM tags WHERE id in (".implode(",", $tag_ids).") or category_id = 0 limit 10";
				  $result_tags = $conex->query($select_tags);	
			   
				  $cont = 0;
				  while ($row_tags = $result_tags->fetch_array(MYSQLI_ASSOC)){
					$cont ++;
					if ($cont == 10){
						$tags_name = $row_tags['name'];
						echo $tags_name.".";
					}
					else{
						$tags_name = $row_tags['name'];
						echo $tags_name.", ";
					}						    
				  }
			  ?>	
			</p>
		</div>  
	</div>
<?php 
	}
	$conex->close();
?>
</div>

<script>
	var owl = $("#owl-demo");	 
	owl.owlCarousel({		 
	  itemsCustom : [
		[0, 1],
		[450, 1],
		[600, 1],
		[700, 1],
		[1000, 1],
		[1200, 1],
		[1400, 1],
		[1600, 1]
	  ],
	  navigation : true	 
	});	
	
	//close popup
	$(document).ready(function(){	   
	   /*close de magnific popup*/ 
	   $(".promotion_title_name_place").click(function(evento){
		  evento.preventDefault();		  
		  $('.mfp-close').click();
	   });  
	   
	   /*scrollbar*/
	   $('.scroll_y').perfectScrollbar(); 	   	   
	});
			
</script>












