	<?php  		
	//connection
	include("functions.php");
	$conex = connection();
	//session start
	session_start();

	$promotion = "SELECT * FROM promotion, place, image";
	$imag = "SELECT * FROM image WHERE type = 'place'";
								
	$imagResult = $conex->query($imag);
	$showImage = $imagResult->fetch_assoc();

	$result = $conex->query($promotion);
	$promo_result = $result->fetch_assoc();

	?>
		<script>
			$( document ).ready(function( $ ) {
				$( '#example3' ).sliderPro({
					width: 960,
					height: 500,
					fade: true,
					arrows: true,
					buttons: false,
					fullScreen: true,
					shuffle: false,
					smallSize: 500,
					mediumSize: 1000,
					largeSize: 3000,
					thumbnailArrows: true,
					autoplay: false
				});
			});


  		    $(function() {
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

										<div id="example3" class="slider-pro">
											<div class="sp-slides">
												<div class="sp-slide">
				
												<?php
													
												while ($array=mysqli_fetch_array($result, MYSQLI_ASSOC)){
												$id = $showImage ['id'];
												$ext = $showImage ['img_type'];
												$filename = "../photos/place/$id.$ext";
												?>	
													<!--<div class="item"><h1><img class="urvenue_image" src="../images/uv.png"></h1></div>
													<a class="item link"><img class="promo-images" src="<?php echo $filename;?>"> </a>-->
										<img class="sp-image" src="<?php echo $filename?>">
													
										<p class="sp-layer sp-white sp-padding"
										data-horizontal="50" data-vertical="50"
										data-show-transition="left" data-show-delay="400">
										<?php echo $promo_result['name']; 
										echo"</br>";
										echo $array['name']. "-" .$array['promotion'];
										echo"</br>";
										echo $array['name'];
										echo "</br>";
										echo $array['schedule']; ?>
										</p>

										<p class="sp-layer sp-black sp-padding"
										data-horizontal="180" data-vertical="50"
										data-show-transition="left" data-show-delay="600">
										<?php echo $array['category_id'];?>
										</p>

										 <p class="sp-layer sp-white sp-padding"
										 data-horizontal="315" data-vertical="50"
										 data-show-transition="left" data-show-delay="800">
										 <?php echo $array['schedule'];?>
										 </p>

										 <p class="sp-layer sp-black sp-padding"
										 data-horizontal="515" data-vertical="50"
										 data-show-transition="left" data-show-delay="1000">
										 <?php echo $array['promotion'];?>
										 </p>
											<?php
												}
											?>
										</div>

										<div class="sp-slides">
										<div class="sp-slide">
										<img class="sp-image" src="../photos/place/89.jpeg">
										<p class="sp-layer sp-white sp-padding"
										data-horizontal="50" data-vertical="50"
										data-show-transition="left" data-show-delay="400">
										<?php echo $promo_result['name']; ?>
										</p>

										<p class="sp-layer sp-black sp-padding"
										data-horizontal="180" data-vertical="50"
										data-show-transition="left" data-show-delay="600">
										<?php echo $promo_result['category_id'];?>
										</p>

										 <p class="sp-layer sp-white sp-padding"
										 data-horizontal="315" data-vertical="50"
										 data-show-transition="left" data-show-delay="800">
										  <?php echo $promo_result['schedule'];?>
										 </p>

										 <p class="sp-layer sp-black sp-padding"
										 data-horizontal="515" data-vertical="50"
										 data-show-transition="left" data-show-delay="1000">
										 <?php echo $promo_result['promotion'];?>
										 </p>
												</div>
												</div>
			 
										 </div>
										 <div class="col-md-1">
										 </div>
										 </div>
									
										<div class="date-picker">
											Looking for another day?: 
											<input style="color:black;" name="date" type="text" id="datepicker">
										</div>