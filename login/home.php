<?php  		
	include("header.php");
	$conex = connection();
?>

<div id="map-canvas" class="map_canvas"> <img class="loading_map" src="../images/loader.gif" /></div>

<div class="container-fluid">									
	<div class="row">
		<div
			<button onClick="initialize()" type="button" class="btn btn-danger location_button">Locate me</button>
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
    <h2 class="title_panels">Notifications</h2>
	<button class="btn btn-default button_close_notifications" id="close_notifications" title="Close"><span class="glyphicon glyphicon-arrow-left"></span></button>
    <p>hi world!!</p>
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
					$filename = "../photos/user/$id$ext";
								
					if (file_exists($filename)) {
						$filename = $filename;
					} 
					else {
						$filename = '../photos/user/default.png';
					}
					
				echo "<h3>$row_select_friend[nickname]</h3>";
				echo "<div><p>
					<img class='image_friends' src='$filename'title='Avatar'>
					<span class='name_friends'>$row_select_friend[name]</span><br>
					$row_select_friend[city]<br>
					$row_select_friend[phone]<br>
					$row_select_friend[email]
					</p></div>";
			}		
		}
		?>
	 </div>
  </div>
  
  
<?php  	
	if($_SESSION['user_new'] == 1){
		?>
		<a href="complete_user.php" class="continue_user"></a>
		<?php
		$_SESSION['user_new'] = 2;
	}

	include("footer.php");
?>


