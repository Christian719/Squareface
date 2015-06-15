<script src="../js/bootstrap-filestyle.min.js"> </script>

<?php  		
	//connection
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//select place's id
	$time = time();
	$date = date("Y-m-d H:i:s", $time);
	
	$id_place = $_GET["id_place"];
	
	//select all from the table 'place' whit the id
	$query = "SELECT * FROM place WHERE id='$id_place'";
	$result = $conex->query($query);
	$row = $result->fetch_assoc();
		$place_id = $row['id'];
		$place_name = $row['name'];
		$place_address = $row['address'];
		$place_city = $row['city'];
		$place_phone = $row['phone'];
		$place_schedule = $row['schedule'];
		$place_rating = $row['rating'];
		$place_lat = $row['lat'];
		$place_lon = $row['lon'];
		
		$place_id_cat = $row['category_id'];
		$place_tags = $row['tags_id'];
		$place_image = $row['image'];
		//select category's name
		$query_category = "SELECT name FROM category WHERE id='$place_id_cat'";
		$result_category = $conex->query($query_category);
		$row_category = $result_category->fetch_assoc();
			$category_name = $row_category['name'];
		//select place's image
		$select_image = "SELECT * FROM image WHERE id='$place_image'";
		$result_image = $conex->query($select_image);
		$row_image = $result_image->fetch_assoc();
		  $ext = $row_image['img_type'];
		  $image_type = $row_image['type'];	
		  $filename = "../photos/place/$image_type/$place_image.$ext";			
			if (file_exists($filename)) {
				$filename = $filename;
			} 
			else {
				$filename = "../photos/place/$image_type/default.png";
			}		
	?>

<div class="container">
	<div class="col-md-12">
		<div class="col-md-1"></div>
		<div class="col-md-10" id="popup_place_container">
			<h4 class="popup_place_title">Place Info</h4>
			<!--categories botons-->
			<div id="owl_buttons_place" class="btn-group btn-group-justified owl-carousel popup_place_content_botons" role="group" aria-label="...">
			    <div class="btn-group" role="group">
					<a class="btn btn-primary owl-item active popup_place_botons" id="button_place" href="#" role="button">Place</a>
			    </div>			
			    <div class="btn-group" role="group">
					<a class="btn btn-primary owl-item popup_place_botons" id="button_comments" href="#" role="button">Comments</a>
			  	</div>
			  	<div class="btn-group" role="group">
					<a class="btn btn-primary owl-item popup_place_botons" id="button_gallery" href="#" role="button">Gallery</a>
			 	</div>
			  	<div class="btn-group" role="group">
					<a class="btn btn-primary owl-item popup_place_botons" id="button_promotions" href="#" role="button">Promotions</a>
			    </div>
			</div>
			</br>			
			<!--content place's buttons------------------------------------>
			<div class="popup_place_content_info">
				<!--title of place----------------------------------------->
				<div class="name_rating">
					<h4 class="popup_place_name_place"><?php echo $category_name." ".$place_name;?></h4></br>
					<h5 class='popup_place_place_raiting'>
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
							echo"<span class='glyphicon glyphicon-star rating_popup_default' aria-hidden='true'></span>";
						}						
					  ?>
					</h5> </br>
				</div>	
				<!--button place----------------------------------------------------------->
				<div class="button_place" id="ajax_button_place">
					<div class="col-md-3 button_place_info">
						<h4 class="button_place_title_info">Place information</h4> </br>
						<p class="button_place_info_details">				  	
						  <strong>Address: </strong><?php echo $place_address;?></br>
						  <strong>City: </strong><?php echo $place_city;?></br>
						  <strong>Phone: </strong><?php echo $place_phone;?></br>
						  <strong>Shedule: </strong><?php echo $place_schedule;?></br>
						</p>
					</div>
					<div class="col-md-6 button_place_image">
						<img class="button_place_image_details" src="<?php echo $filename; ?>">
					</div>
					<div class="col-md-3 button_place_tags">
						<h4 class="button_place_title_tags">Tags</h4></br>
						<p class="button_place_tags_details">				  	  
						  <?php
							  //tags
							  $place_tags;	
							  $tag_list = explode(",", $place_tags);
							  $tag_ids = array();					  
							  foreach($tag_list as $tag){
								  $tag_ids[] = trim($tag, "|");
							  }		  					  
							  $select_tags = "SELECT name FROM tags WHERE id in (".implode(",", $tag_ids).") OR category_id = 0 limit 10";
							  $result_tags = $conex->query($select_tags);	
						   
							  $cont = 0;
							  while ($row_tags = $result_tags->fetch_assoc()){
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
				<!--button coments------------------------------------------------------->
				<div class="button_comments" id="ajax_button_comments">
					<!--show comments-------->
					<p class="button_comments_title_comms"><strong>Comments</strong></p>
					<div class="col-md-6 scroll_comments_y cont_show_comments">						
					<?php	
						$select_comments = "SELECT * FROM comment WHERE place_id = '$place_id' ORDER BY id DESC limit 7";
						$result_comments = $conex->query($select_comments);
						if ($result_comments->num_rows > 0) {
							while ($comment_row = $result_comments->fetch_assoc()){
								$com_comment = $comment_row['comment'];
								$com_date = $comment_row['date'];
								$com_image = $comment_row['image'];
								$com_place_id = $comment_row['place_id'];
								$com_user_id = $comment_row['user_id'];
								
								//select comment's image
								$sel_comm_img = "SELECT * FROM image WHERE id='$com_image'";
								$res_comm_img = $conex->query($sel_comm_img);
								$row_comm_img = $res_comm_img->fetch_assoc();
								
								//select name of place
								$query_name_pla= "SELECT name FROM place WHERE id='$com_place_id'"; 
								$result_name_pla= $conex->query($query_name_pla);
								$row_name_pla = $result_name_pla->fetch_assoc();		
								$name_place=$row_name_pla['name'];	
								
								$c_ext = $row_comm_img['img_type'];
								$c_image_type = $row_comm_img['type'];	
								$c_filename = "../photos/$c_image_type/$name_place/$com_image.$c_ext";
											
								if (file_exists($c_filename)) {
									$c_filename = $c_filename;
								} 
								else {
									$c_filename = "../photos/$c_image_type/default.png";
								}	
								
								//select user's image
								$sel_user_img = "SELECT * FROM image WHERE type='user' AND papa_id='$com_user_id'";
								$res_user_img = $conex->query($sel_user_img);
								$row_user_img = $res_user_img->fetch_assoc();
								
								$u_id = $row_user_img['id'];
								$u_ext = $row_user_img['img_type'];
								$u_image_type = $row_user_img['type'];	
								$u_filename = "../photos/$u_image_type/$u_id.$u_ext";
											
								if (file_exists($u_filename)) {
									$u_filename = $u_filename;
								} 
								else {
									$u_filename = "../photos/$u_image_type/default.png";
								}	
								
								//select user's nickname			
								$sel_user_nickname = "SELECT nickname FROM user WHERE id='$com_user_id'";
								$res_user_nickname = $conex->query($sel_user_nickname);
								$row_user_nickname = $res_user_nickname->fetch_assoc();								
									$user_nickname = $row_user_nickname['nickname'];
									
					?>								
							<!--Show information -->
							<div class="col-md-12 container_one_comment">	
								<div class="col-md-3 cont_one_user">		
									<img class="comment_user_image com_img_tam" src="<?php echo $u_filename; ?>"></br>
									<p class="comment_user_nickname"><?php echo $user_nickname;?></p>
								</div>
								<div class="col-md-6 cont_one_comment">	
									<p class="comment_comment_date"><?php echo $com_date;?></p>
									<p class="comment_comment_details"><?php echo $com_comment;?></p>
								</div>
								<div class="col-md-3 cont_one_comment_image">	
									<img class="comment_comment_image com_img_tam" src="<?php echo $c_filename; ?>">
								</div>
							</div>							
					<?php	
							}											
						} 
						else {
							echo "<p class='not_info_db'>This place has not comments</p>";
						}		 
					?>
					</div>
					<!--add comment-------->
					<p class="button_comments_title_addcomms"><strong>Add Comment</strong></p>
					<div class="col-md-6 cont_add_comments">
						<?php
							//select user whit open session
							$select_sesion = "SELECT id, nickname, image FROM user WHERE id = '$_SESSION[id]'";
							$result_sesion = $conex->query($select_sesion);
							$sesion_row = $result_sesion->fetch_assoc();
								$sesion_user_id = $sesion_row['id'];							
								$sesion_nickname = $sesion_row['nickname'];
								$sesion_image = $sesion_row['image'];
							
							//select image user whit open sesion
							$sel_sesion_img = "SELECT * FROM image WHERE type='user' AND papa_id='$_SESSION[id]'";
							$res_sesion_img = $conex->query($sel_sesion_img);
							$row_sesion_img = $res_sesion_img->fetch_assoc();
							
							$sesion_id = $row_sesion_img['id'];
							$sesion_ext = $row_sesion_img['img_type'];
							$sesion_image_type = $row_sesion_img['type'];	
							$sesion_filename = "../photos/$sesion_image_type/$sesion_id.$sesion_ext";
										
							if (file_exists($sesion_filename)) {
								$sesion_filename = $sesion_filename;
							} 
							else {
								$sesion_filename = "../photos/$sesion_image_type/default.png";
							}
						?>
					    <div class="col-md-12 container_add_comment">	
							<div class="col-md-3 cont_add_user">		
								<img class="add_user_image com_img_tam" src="<?php echo $sesion_filename; ?>"></br>
								<p class="add_user_nickname"><?php echo $sesion_nickname;?></p>
							</div>
							<div class="col-md-9 cont_add_comment">	
								<form method="post" action="../user/insert_comment.php?add=com" enctype="multipart/form-data">
								  <div class="form-group">
									<label>Comment</label>
									<textarea name="comment" class="form-control tam_textarea" rows="5" maxlength="150" placeholder="Write a comment" autofocus required></textarea>
								  </div>								 
								  <div class="form-group">
									<label for="exampleInputFile">Choose an image for the comment</label>
									<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture">
								  </div>
								  <input type="hidden" name="place_id" value="<?php echo $id_place;?>">
								  <input type="hidden" name="user_id" value="<?php echo $sesion_user_id;?>">							  
								  <button type="submit" class="btn btn-primary tam_but_ok do_comment">Ok</button>
								</form>
							</div>
						</div>	
					</div>
				</div>
				<!--button gallery-------------------------------------------------------->
				<div class="button_gallery" id="ajax_button_gallery">
					<?php	
						$select_gallery = "SELECT * FROM gallery WHERE place_id = '$place_id' limit 10";
						$result_gallery = $conex->query($select_gallery);
						if ($result_gallery->num_rows > 0) {
						
						//create carrucel for promos
						echo "<div id='button_gallery_gallery' class='owl-carousel'>";
						
							//select place's gallery
							while ($gallery_row = $result_gallery->fetch_assoc()){
								$gal_id = $gallery_row['id'];
								$gal_comment = $gallery_row['comment'];
						        $gal_date = $gallery_row['date'];								
								$gal_type = $gallery_row['type'];
								$gal_place_id = $gallery_row['place_id'];								
																
								$gal_filename = "../gallery/$place_name/$gal_id.$gal_type";		
								
								if (file_exists($gal_filename)) {
									$gal_filename = $gal_filename;
								} 
								else {
									//$gal_filename = "../gallery/default.png";
									$gal_filename = $gal_filename;
								}	
					?>			
								<!--Show information -->
								<div>	
									<p class="button_gallery_date"><?php echo $gal_date;?></p> </br>						
									<img class="button_gallery_image" src="<?php echo $gal_filename;?>" title="<?php echo $gal_comment;?>">	
									<p class="button_gallery_comment"><?php echo $gal_comment;?></p> </br>																
								</div>
					<?php			
							}
						echo "</div>";									
						} 
						else {
							echo "<p class='not_info_db'>This place has not a photo gallery</p>";
						} 
					?>
				</div>
				<!--button promotions----------------------------------------------------->
				<div class="button_promotions" id="ajax_button_promotions">
					<?php	
						$select_promotion = "SELECT * FROM promotion WHERE place_id = '$place_id' order by day asc limit 10";
						$result_promotion = $conex->query($select_promotion);
						if ($result_promotion->num_rows > 0) {
						
						//create carrucel for promos
						echo "<div id='button_promotions_promos' class='owl-carousel'>";
						
							//select promo's info
							while ($promo_row = $result_promotion->fetch_assoc()){
								$promo_day = $promo_row['day'];
						        $promo_promotion = $promo_row['promotion'];
							    $promo_image = $promo_row['image'];
								
								//select day name
								$day_name;
								  if ($promo_day == 1){
									$day_name="Sunday";
								  }
								  if ($promo_day == 2){
									$day_name="Monday";
								  }
								  if ($promo_day == 3){
									$day_name="Tuesday";
								  }
								  if ($promo_day == 4){
									$day_name="Wednesday";
								  }
								  if ($promo_day == 5){
									$day_name="Thursday";
								  }
								  if ($promo_day == 6){
									$day_name="Friday";
								  }
								  if ($promo_day == 7){
									$day_name="Saturday";
								  }	  
								
								//select promos's image
								$pro_select_image = "SELECT * FROM image WHERE id='$promo_image'";
								$pro_result_image = $conex->query($pro_select_image);
								$pro_row_image = $pro_result_image->fetch_assoc();
								
								$pro_ext = $pro_row_image['img_type'];
								$pro_image_type = $pro_row_image['type'];	
								$pro_filename = "../photos/$pro_image_type/$place_name/$promo_image.$pro_ext";		
								
								if (file_exists($pro_filename)) {
									$pro_filename = $pro_filename;
								} 
								else {
									$pro_filename = "../photos/$pro_image_type/default.jpg";
								}	
					?>			
								<!--Show information -->
								<div>	
									<p class="button_promotion_date"><strong><?php echo $day_name;?></strong></p> </br>						
									<img class="button_promotion_image" src="<?php echo $pro_filename;?>" title="<?php echo $promo_promotion;?>">	
									<p class="button_promotion_comment"><?php echo $promo_promotion;?></p> </br>																
								</div>
					<?php			
							}
						echo "</div>";									
						} 
						else {
							echo "<p class='not_info_db'>This place has not promotions</p>";
						}
						//$conex->close();	 
					?>
				</div>
				<!--end button promotions----------------------------------------------------->
			</div>
			<!--options_place----------------------------------------------------->
			<div class="popup_place_options_place">
				<div class="cont_options_place">
					<p class="txt_checkin">Check in</p>
					<a class="btn btn-primary check_in_button" role="button" href="#"><img class="check_in" src="../images/check.png" title="Check in" /></a>				
					<p class="txt_rating">Rating</p>
					<input id="rating" type="number" class="rating">
					<p class="txt_take">Take me here</p>
					<a class="btn btn-primary route_button" role="button"  href="#" onclick="calcRoute(<?php echo $place_id;?>)"><img class="route" src="../images/route.png" title="Take me here" /></a>	
				</div>	
				<span class="btn btn-primary com">Comentario</span>	
				<span class="btn btn-primary che">Check in</span>
				<span class="btn btn-primary rat">Rating</span>		
			</div>	
		</div>
		<div class="col-md-1"></div>
	</div>
</div>

<script>
	//carrucel_buttons
	var owl_but_place = $("#owl_buttons_place");	 
	owl_but_place.owlCarousel({		 
	  itemsCustom : [
		[0, 2],
		[450, 2],
		[527, 3],
		[650, 4]
	  ],
	  navigation : true
	});
	
	//carrucel_promos
	var owl_pro_promos = $("#button_promotions_promos");	 
	owl_pro_promos.owlCarousel({		 
	  itemsCustom : [
		[0, 1],
		[450, 1],
		[527, 1],
		[650, 1]
	  ],
	  navigation : true,
	  hola : true
	});	
	
	//carrucel_gallery
	var owl_pro_gallery = $("#button_gallery_gallery");	 
	owl_pro_gallery.owlCarousel({		 
	  itemsCustom : [
		[0, 1],
		[450, 1],
		[527, 1],
		[650, 1]
	  ],
	  navigation : true,
	  hola : true
	});		
	
	function confirm_check(){ 
		if (confirm('Are you sure to check in?')){ 	
			create_check("<?php echo $sesion_user_id;?>", "<?php echo $place_lat;?>", "<?php echo $place_lon;?>", "<?php echo $date;?>", "<?php echo $sesion_nickname;?>", "<?php echo $sesion_filename;?>", "<?php echo $place_name;?>");
			$('.mfp-close').click();			
			return true;
		} 
		else{
			return false;
		}
	}
	
	//document ready
	$(document).ready(function(){
	   //buttons of place	
	   $("#ajax_button_place").show();
	   $("#ajax_button_comments").hide();
	   $("#ajax_button_gallery").hide();
	   $("#ajax_button_promotions").hide();
	   
	   $("#button_place").click(function(evento){
		   evento.preventDefault();		  
		   $("#ajax_button_place").show();
	   	   $("#ajax_button_comments").hide();
	       $("#ajax_button_gallery").hide();
	       $("#ajax_button_promotions").hide();
	   });
	   
	   $("#button_comments").click(function(evento){
		   evento.preventDefault();		  
		   $("#ajax_button_place").hide();
	   	   $("#ajax_button_comments").show();
	       $("#ajax_button_gallery").hide();
	       $("#ajax_button_promotions").hide();
	   });
	   
	   $("#button_gallery").click(function(evento){
		   evento.preventDefault();		  
		   $("#ajax_button_place").hide();
	   	   $("#ajax_button_comments").hide();
	       $("#ajax_button_gallery").show();
	       $("#ajax_button_promotions").hide();		    
	   });
			
	   $("#button_promotions").click(function(evento){
		   evento.preventDefault();		  
		   $("#ajax_button_place").hide();
	   	   $("#ajax_button_comments").hide();
	       $("#ajax_button_gallery").hide();
	       $("#ajax_button_promotions").show();
	   });  
	   
	   /*close de magnific popup*/ 
	   $(".route").click(function(evento){
		   evento.preventDefault();		  
		   $('.mfp-close').click();
	   });   
	   
	   /*scrollbar*/
	   $('.scroll_comments_y').perfectScrollbar();
	   
	   //socket------------
		var socket = io.connect('http://localhost:8090'); //This variable is a new instance of socket , this var is individualy instanced for each user in the app
        socket.on('connect',function(data){
        });
		
		var comment = "comentario"; // get the username
		var uno = "uno";
	    var dos = "dos";
	    var tres = "tres";
	    var cuatro = "cuatro";
		
        // Events for the option buttons
        $('.com').click(function(){
			var comment = "comentario"
            console.log("Emit a petition for the server");
            socket.emit('showme',{ //emit a message to the server 
               username:comment
            });
        });	
		
		$('.che').click(function(){
			var comment = "check in";
            console.log("Emit a petition for the server");
            socket.emit('showme',{ //emit a message to the server 
               username:comment  //send a data information
            });
        });	
		
		$('.rat').click(function(){
			var comment = "rating";
            console.log("Emit a petition for the server");
            socket.emit('showme',{ //emit a message to the server 
               username:comment  //send a data information
            });
        });	
		
		
		
		
		 
		
	   //comment
	   $('.do_comment').click(function(){
            
       });
	   
	   //check in
	   $('.check_in_button').click(function(){
            create_check("<?php echo $sesion_user_id;?>", "<?php echo $place_lat;?>", "<?php echo $place_lon;?>", "<?php echo $date;?>", "<?php echo $sesion_nickname;?>", "<?php echo $sesion_filename;?>", "<?php echo $place_name;?>");
			$('.mfp-close').click();
       });	
	   
	   /*rating*/
	   $("#rating").rating({
	        'min':0,
			'max':5,
			'step':1,
			'showClear':false,
			'showCaption':false
	   });
	   
	   $("#rating").on("rating.change", function(event, value, caption) {
			$("#rating").rating("refresh", {disabled: true, showClear: false});
			/*insert database*/
			var val_rating=value;	
			/*alert (val_rating);*/
			<?php 
				/*$val_rat = 1;
				$date;
				$sesion_user_id;
				$place_id;
				
				add_rating($val_rat, $date, $sesion_user_id, $place_id);*/
			?>
	   });
	      		  
	});
	
</script>
<?php
	$conex->close();
?>


<!--$val_rat = '<script>document.val_rating.value</script>'; -->
<!--$val_rat = '<script> document.write(val_rating) </script>';		 -->