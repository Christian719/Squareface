  <div id="footer">  
  	<div class="text_footer">
	  <a href="#">About</a> | <a href="#">Help</a>
	  <h5>SQUAREFACE 2015</h5>
	</div>	
  </div>
  
  <script src="../js/jquery.min.js"></script>  
  <script src="../js/bootstrap.min.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyChEZKZvF-cZPsd-9DXB4jHvxXg1NoV9bo&sensor=true"></script>
  <script src="../js/location.js"></script>
  <script src="../js/functions.js"></script>
  <script src="../js/jquery-ui.js"></script>
  
  <script src="../js/jquery.magnific-popup.js"></script>

  <script src="../js/jquery.panelslider.min.js"></script>
  <script>
    $('#left-panel-link').panelslider();
    $('#right-panel-link').panelslider({side: 'right'});
	
	$(document).ready(function(){	
	   $('.ajax-popup-link').magnificPopup({
		  type: 'ajax',
		  closeOnBgClick:false,
		  closeOnContentClick:false,
		  closeBtnInside:false
		});
		
		$('.ajax-category').magnificPopup({
		  type: 'ajax',
		  closeOnBgClick:false,
		  closeOnContentClick:false,
		  closeBtnInside:false
		});
		
		$('.ajax-promotion').magnificPopup({
		  type: 'ajax',
		  closeOnBgClick:false,
		  closeOnContentClick:false,
		  closeBtnInside:false
		});
		
		$('.continue_user').magnificPopup({
		  type: 'ajax',
		  closeOnBgClick:false,
		  closeOnContentClick:false,
		});
		
		$(".continue_user").click();
	   
	});
	
	//panel friends
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true,
	  		heightStyle: "fill",
			active: false
		});
    });
  </script>
</body>
</html>
















