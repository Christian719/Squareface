<?php  		
	//connection
	include("functions.php");
	$conex = connection();
	
	//session start
	session_start();
?>

<div class="container">
	<div class="col-md-12">
		<div class="col-md-1"></div>
		<div class="col-md-10" id="promotion_container">
			<h4 class="promotion_title">Promotions</h4>
			<!--categories botons-->
			<div class="btn-group btn-group-justified promotion_botons" role="group" aria-label="...">
			  <div class="btn-group" role="group">
				<button type="button" class="btn btn-primary">Bar</button>
			  </div>
			  <div class="btn-group" role="group">
				<button type="button" class="btn btn-primary">Restaurant</button>
			  </div>
			  <div class="btn-group" role="group">
				<button type="button" class="btn btn-primary">Workoffice</button>
			  </div>
			  <div class="btn-group" role="group">
				<button type="button" class="btn btn-primary">Zoo</button>
			  </div>
			</div>
			</br>
			<!--carrucel-->					
			<div id="owl-demo" class="owl-carousel owl-theme">			
				<?php
					//select the table promotions
					$select_promotion = "SELECT * FROM promotion";
					$result = $conex->query($select_promotion);
					while ($row = $result->fetch_array(MYSQLI_ASSOC)){
					//$row = $result->fetch_array(MYSQLI_ASSOC);
					  $day = $row['day'];
					  $promotion = $row['promotion'];
					  $image = $row['image'];
					  $place = $row['place_id'];
					  $category = $row['category_id'];
					  //place
					  $select_place = "SELECT name, address, city, phone, schedule, rating, tags_id FROM place WHERE id='$place'";
					  $result_place = $conex->query($select_place);
					  $row_place = $result_place->fetch_array(MYSQLI_ASSOC);
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
							$filename = "../photos/$image_type/default.png";
						}
					  //tags	
					  $select_tags = "SELECT name FROM tags WHERE id='$place_tags'";
					  $result_tags = $conex->query($select_tags);
					  $row_tags = $result_tags->fetch_array(MYSQLI_ASSOC);
						$tags_name = $row_tags['name'];		
				?>		
			  <!--pages of carrusel-->
			  <div class="item">
			    <div class="col-md-3 promotion_info_place">
				  <h4 class="promotion_title_cat_place">Place information</h4> </br>
			  	  <p class="promotion_content_place">				  	
					  <?php echo $place_address;?></br>
					  <?php echo $place_city;?></br>
					  <?php echo $place_phone;?></br>
					  <?php echo $place_schedule;?></br>
				  </p>
				</div>
				<div class="col-md-6">
				  <h4 class="promotion_title_name_place"><?php echo $place_name;?></h4></br>
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
				  <h4 class="promotion_title_cat_place">Promotion</h4></br>
				  <p class="promotion_content_promo">				  	  
					  <?php echo $promotion;?></br>
				  </p>
				  <h6 class="promotion_line"></h6>
				  </br>
				  <h4 class="promotion_title_cat_place">Tags</h4></br>
				  <p class="promotion_content_tags">				  	  
					  <?php echo $place_tags;?></br>
				  </p></br>
				</div>  
			  </div>
			  <?php 
			  	  }
				  $conex->close();
			  ?>
			</div>
			<!--end carrucel-->			
		</div>
		<div class="col-md-1"></div>
	</div>
</div>


<!--llamamos el carrusel de las promociones -->
<script>
    $(document).ready(function() {
	/*$("#owl-demo").owlCarousel();*/
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
	});
</script>