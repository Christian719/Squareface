<?php  		
	include("header.php");
?>

<div class="cont-map">
  <div id="map-canvas" class="map_canvas"> <img class="loader_map" src="../images/loader.gif" /></div>
</div>
  
<div class="container-fluid">									
	<div class="row">
		<div class="col-md-1 col-md-offset-10 button_location">
			<button onClick="initialize()" type="button" class="btn btn-danger">Locate me</button>
		</div>
	</div>
</div>  

<?php  		
	include("footer.php");
?>