	<?php  		
	//connection
	include("functions.php");
	$conex = connection();
	//session start
	session_start();

	
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
								
	

	?>
		<script>
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
										<div id="owl-demo" class="owl-carousel owl-theme">
										
													 <div class="item" id="promo-images"><img src="../photos/user/1.jpg"></h1></div>
													  <div class="item" id="promo-images"><img src="../photos/user/1.jpg"></h1></div>
													  <div class="item" id="promo-images"><img src="../photos/user/1.jpg"></h1></div>
													  <div class="item" id="promo-images"><img src="../photos/user/1.jpg"></h1></div>
													  <div class="item" id="promo-images"><img src="../photos/user/1.jpg"></h1></div>
													  <div class="item" id="promo-images"><img src="../photos/user/1.jpg"></h1></div>



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
									
										