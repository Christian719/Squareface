<?php  		
	//con:nection
	include("../include/functions.php");
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
			<div id="owl_buttons" class="btn-group btn-group-justified owl-carousel promotion_botons" role="group" aria-label="...">
			<?php
				$category = "SELECT id, name FROM category";
				$category_result = $conex->query($category);
				$cont = 0;
				while ($category_row = $category_result->fetch_assoc()){
				  $category_row_name = $category_row['name'];
				  $category_row_id = $category_row['id'];
			?>				
			  <div class="btn-group" role="group">
				<a class="btn btn-primary owl-item cat_places" id_category="<?php echo $category_row_id;?>" href="#" role="button"><?php echo $category_row_name;?></a>
			  </div>
			<?php
				  $cont = $cont + 1;	
				}
			?>
			</div>
			</br>
			<!--carrucel-->					
			<div id="test_cat_pro">			
				<script>
					var caldate = $("#datepicker").attr('caldate');
					$("#test_cat_pro").load("../places/promotion_queries.php?caldate="+caldate);		  	
				</script>
			</div>
			<!--end carrucel-->	
			<!--calendar-->
			<p class="promotion_calendar">Select date: <input class="promo_calendar" caldate="-1" type="text" id="datepicker" disabled></p>		
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

<script>
	//carrucel_buttons
	var owl_b = $("#owl_buttons");	 
	owl_b.owlCarousel({		 
	  itemsCustom : [
		[0, 2],
		[450, 2],
		[527, 3],
		[650, 4],
		[768, <?php echo $cont; ?>]
	  ],
	  navigation : true	 
	});	

	$(document).ready(function(){		
		//calendar	
		var n;	
		var caldate = $("#datepicker").attr('caldate');
		var day;
		var month;
		$(function() {
		  $( "#datepicker" ).datepicker({
		  	    showOn: "button",
				buttonImage: "../images/calendar.png",
				buttonImageOnly: true,
				showAnim: "drop",
				dateFormat:"dd MM yy",
				minDate: '-0d', maxDate: '+4m',
				onSelect: function(dateText){
					var seldate = $(this).datepicker('getDate');
					var n = seldate.getUTCDay() + 1;
					day  = seldate.getDate();
					month = $.datepicker.formatDate('MM', seldate);
					//alert(n+", "+day+", "+month);					
					caldate = n;
					$("#test_cat_pro").load("../places/promotion_queries.php?caldate="+caldate+"&day="+day+"&month="+month);
				}
		  });		 		
		});
		
		//We call the carousel of promotions by category filter
		$('.cat_places').click(function(){
			var id_cat = $(this).attr('id_category');
			$("#test_cat_pro").load("../places/promotion_queries.php?id="+id_cat+"&caldate="+caldate+"&day="+day+"&month="+month);
		});	
				
	});
</script>






















