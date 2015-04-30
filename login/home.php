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
    <h2>Notifications</h2>
    <p>hi world!!</p>
  </div> 
  
  <!-- Right panel -->
  <div id="right-panel" class="panel">
  	<h2>Friends</h2>
	 <div id="accordion">
  		<?php
		$select_friends = "SELECT * FROM user";
		$result = $conex->query($select_friends);
		while ($row_select_friend = $result->fetch_assoc()) {
			echo "<h3>$row_select_friend[nickname]</h3>";
			echo "<div><p>
				$row_select_friend[name]
				$row_select_friend[last_name]<br>
				$row_select_friend[city]<br>
				$row_select_friend[phone]<br>
				$row_select_friend[email]
				</p></div>";
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


