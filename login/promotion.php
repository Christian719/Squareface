	<?php  		
	//connection
	include("functions.php");
	$conex = connection();
	//session start
	session_start();

	//shows the categories in the combo box
	$category = "SELECT * FROM category";
	$catResult = $conex->query($category);
	if ($catResult->num_rows > 0)
	{
		$combo="";
		while ($row = $catResult->fetch_array(MYSQLI_ASSOC)) {
		$combo .=" <option value='".$row['id']."'>".$row['name']."</option>";
		}
	}
	else{
		echo "no hay resultados";
	}
								
	//select image
	$image = "SELECT * FROM promotion";
	$imag_promo = $conex->query($image);
	
		$photo="";
		while ($imag_row = $imag_promo->fetch_array(MYSQLI_ASSOC)) {
			//$type = $imag_row ['name'];
			$id_promo = $imag_row['id'];
			$img_place = $imag_row['image'];
			$select_image = "SELECT * FROM image WHERE papa_id = '$id_promo'";
			$result_image = $conex->query($select_image);
			$row_select_image = $result_image->fetch_assoc();
			$ext = $row_select_image['img_type'];
			$filename = "../photos/promotion/$img_place$ext";
			$photo .="<div class='item' id='promo-images><img src='$filename'></div>";
			if (file_exists($filename)){
				$filename = $filename;
			}
			else {
				$filename = "../photos/promotion/default.png";
			}
		}
	
	
	

	?>
		<script>//Slider
			 $(document).ready(function() {
 			 var owl = $("#owl-demo");
 			 owl.owlCarousel({
     			itemsCustom : [
        			[0  , 1],
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
 


  		    $(function() {//Calendar date picker
				$( "#datepicker" ).datepicker({ // for the datepicker	  	
			 		showOn: "button",
			 		buttonImage: "../images/calendar.png",
			 		buttonImageOnly: true,
			 		buttonText: "Select Date",
			 		dateFormat:"dd MM yy", //format date
			  		minDate: '-0d', maxDate: '+4w', // the days that can be selected
			  	  		onSelect: function(dateText){
			 	  			var seldate = $(this).datepicker('getDate');
			  	  			var n = seldate.getUTCDay();
			  	  			alert(n);
				  	  		}
						});  
			  		});
						</script>  
									  
					<div class="container">
						<div class="col-md-12">
							<div class="col-md-1"></div>
								<div class="col-md-10" id="promotion_container">
									<h4 class="promotion_title">Promotions</h4>
										<div id="owl-demo" class="owl-carousel owl-theme">
										
													<!-- <div class="item" id="promo-images"><img src="<?php echo $filename; ?>"></h1></div>-->
													<?php echo $photo; ?>

													 



													 </div>
										

										

										

										<div class="date-picker">
											<p style="color: white;">Looking for another day?: </p>	
											<input name="date" type="text" id="datepicker" class="form-control">
										</div>
										<div class="combo-box">
											<p style="color: white;">Looking for a different category?: </p>
			 							<select name="category" class="form-control">
			 								<?php echo $combo; ?>
			 							</select>
										 </div>
										 <div class="col-md-1">

										 </div>

										 </div>
									
										