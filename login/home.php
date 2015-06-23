<?php  		
	include("../include/header.php");
	$conex = connection();
?>

<div id="map-canvas" class="map_canvas"> <img class="loading_map" src="../images/loader.gif" /></div>

<div class="container-fluid">									
	<div class="row">
		<div>
			<button onClick="initialize(); xmlhttp.onreadystatechange()" type="button" class="btn btn-danger location_button">Locate me</button>
		</div>
	</div>	
	<div class="row">
		<div>
			<a class="btn btn-primary button_notifications" role="button" id="left-panel-link" href="#left-panel">Notifications</a>
		</div>
		<div>
			<a class="btn btn-primary button_friends" role="button" id="right-panel-link" href="#right-panel" >Friends</a>
		</div>
	</div>		
</div> 

<!-- Left panel -->
<div id="left-panel" class="panel">
    <p class="title_panels">Notifications</p>
	<button class="btn btn-primary button_close_notifications" id="close_notifications" title="Close"><img class="arrow_ago" src="../images/ago.png" /></button>
    <!--notifications---messages-->
	<div id="messages" class="scroll_activity">
		<?php	
			$select_activity = "SELECT * FROM activity ORDER BY id DESC limit 20";
			$result_activity = $conex->query($select_activity);
			if ($result_activity->num_rows > 0) {
				while ($activity_row = $result_activity->fetch_assoc()){
					$papa_id = $activity_row['papa_id'];
					$data = $activity_row['data'];
					$type = $activity_row['type'];
					$date = $activity_row['date'];
					$user_id = $activity_row['user_id'];
					$place_id = $activity_row['place_id'];
					
					//obtain info user
					$sel_user_nickname = "SELECT nickname FROM user WHERE id='$user_id'";
					$res_user_nickname = $conex->query($sel_user_nickname);
					$row_user_nickname = $res_user_nickname->fetch_assoc();								
						$user_nickname = $row_user_nickname['nickname'];
						
					$sel_user_img = "SELECT * FROM image WHERE type='user' AND papa_id='$user_id'";
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
											
					//obtain info place
					$query_name_pla= "SELECT name, category_id FROM place WHERE id='$place_id'"; 
					$result_name_pla= $conex->query($query_name_pla);
					$row_name_pla = $result_name_pla->fetch_assoc();		
						$name_place=$row_name_pla['name'];
						$category_id=$row_name_pla['category_id'];
						
						$query_name_cat= "SELECT name FROM category WHERE id='$category_id'"; 
						$result_name_cat= $conex->query($query_name_cat);
						$row_name_cat = $result_name_cat->fetch_assoc();
						$name_category=$row_name_cat['name'];
						
					$sel_place_img = "SELECT * FROM image WHERE type='$name_category' AND papa_id='$place_id'";
					$res_place_img = $conex->query($sel_place_img);
					$row_place_img = $res_place_img->fetch_assoc();	
					
					$p_id = $row_place_img['id'];
					$p_ext = $row_place_img['img_type'];
					$p_image_type = $row_place_img['type'];	
					$p_filename = "../photos/place/$p_image_type/$p_id.$p_ext";
								
					if (file_exists($p_filename)) {
						$p_filename = $p_filename;
					} 
					else {
						$p_filename = "../photos/place/$p_image_type/default.png";
					}
					
					//option comment
					if($type=="Comment"){												
						$sel_comment_img = "SELECT * FROM image WHERE type='comment' AND papa_id='$papa_id'";
						$res_comment_img = $conex->query($sel_comment_img);
						$row_comment_img = $res_comment_img->fetch_assoc();
						
						$c_id = $row_comment_img['id'];
						$c_ext = $row_comment_img['img_type'];
						$c_filename = "../photos/comment/$name_place/$c_id.$c_ext";
									
						if (file_exists($c_filename)) {
							$c_filename = $c_filename;
						} 
						else {
							$c_filename = "../photos/comment/default.png";
						}
					}
					
					//option check in
					if($type=="Check in"){
						$c_filename = "../images/check.png";
					}
					
					//option rating		
					if($type=="Rating"){
						$c_filename = "../images/rating/".$data.".png";
					}		
		?>
		<!--Show information -->
		<div class="col-md-12 container_one_activity">	
			<div class="col-md-3 activity_user">		
				<img class="activity_user_image activity_img_tam" src="<?php echo $u_filename; ?>"></br>
				<p class="activity_user_nickname"><?php echo $user_nickname;?></p>
			</div>
			<?php
				if($type=="Comment"){
			?>	
					<div class="col-md-6 activity_activity">	
						<p class="activity_activity_date"><?php echo $date;?></p>
						<p class="activity_activity_details"><?php echo $data;?></p>
						<img class="activity_img_tam activity_comment_image" src="<?php echo $c_filename; ?>">
					</div>
			<?php
				}
				if($type=="Rating"){
			?>
					<div class="col-md-6 activity_activity">	
						<p class="activity_activity_date"><?php echo $date;?></p>
						<p class="activity_activity_details"><?php echo $type;?></p>
						<img class="activity_img_tam activity_rating_image" src="<?php echo $c_filename; ?>">
					</div>
			<?php
				}
				if($type=="Check in"){
			?>
					<div class="col-md-6 activity_activity">	
						<p class="activity_activity_date"><?php echo $date;?></p>
						<p class="activity_activity_details"><?php echo $data;?></p>
						<img class="activity_img_tam activity_checkin_image" src="<?php echo $c_filename; ?>">
					</div>
			<?php
				}
			?>		
			<div class="col-md-3 activity_place">		
				<img class="activity_place_image activity_img_tam" src="<?php echo $p_filename; ?>"></br>
				<p class="activity_place_name"><?php echo $name_place;?></p>
			</div>
		</div>
		<?php	
				}	
			} 
			else {
				echo "<p class='not_info_db'>Not exist notifications</p>";
			}		 
		?>		
	</div>
</div> 
  
<!-- Right panel -->
<div id="right-panel" class="panel">
  	<h2 class="title_panels">Friends</h2>
	<button class="btn btn-default button_close_friends" id="close_friends" title="Close"><span class="glyphicon glyphicon-arrow-right"></span></button>
	<div id="accordion">
  		<?php
		$select_friends = "SELECT * FROM user ORDER BY nickname";
		$result = $conex->query($select_friends);
				
		while ($row_select_friend = $result->fetch_assoc()) {	
			if($row_select_friend['id'] == $_SESSION['id']){
			}
			else{	
				$select_image = "SELECT * FROM image WHERE papa_id = '$row_select_friend[id]'";
				$result2 = $conex->query($select_image);
				$row_select_image = $result2->fetch_assoc();
					$id = $row_select_image['id'];
					$ext = $row_select_image['img_type'];
					$filename = "../photos/user/$id.$ext";
								
					if (file_exists($filename)) {
						$filename = $filename;
					} 
					else {
						$filename = '../photos/user/default.png';
					}
					
				echo "<h3>$row_select_friend[nickname]</h3>";
				echo "<div><p class='conten_friend_info'>
					<img class='image_friends' src='$filename'title='Avatar'>
					<span class='name_friends'>$row_select_friend[name]</span><br>
					$row_select_friend[city]<br>
					$row_select_friend[phone]<br>
					$row_select_friend[email]<br>
					</p></div>";
			}		
		}
		$conex->close();
		?>
	</div>
</div>
  
<?php  	
	if($_SESSION['user_new'] == 1){
		?>
		<a href="../user/complete_user.php" class="continue_user"></a>
		<?php
		$_SESSION['user_new'] = 2;
	}

	include("../include/footer.php");
?>

