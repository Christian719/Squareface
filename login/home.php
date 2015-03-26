<?php  		
	include("header.php");
?>

<div class="cont-map">
  <div id="map-canvas" class="map_canvas"> <img class="loader_map" src="../images/loader.gif" /></div>
</div>
  
<div class="container-fluid">									
	<div class="row">
		<div
			<button onClick="initialize()" type="button" class="btn btn-danger button_location">Locate me</button>
		</div>
	</div>	
	<div class="row">
		<div>
			<a class="btn btn-primary butt_notifications" role="button" class="butt_notifications" id="left-panel-link" href="#left-panel">Notifications</a>
		</div>
		<div>
			<a class="btn btn-primary butt_friends" role="button" id="right-panel-link" href="#right-panel" >Friends</a>
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
    <p>hi friends!!</p>
  </div>

<?php  	
	include("footer.php");
?>