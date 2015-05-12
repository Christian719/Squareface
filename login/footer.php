  <div id="footer">  
  	<div class="text_footer">
	  <a href="#">About</a> | <a href="#">Help</a>
	  <h5>SQUAREFACE 2015</h5>
	</div>	
  </div>
  
  <script src="../js/jquery.min.js"></script>  
  <script src="../js/bootstrap.min.js"></script>  
  <script src="../js/jquery-ui.js"></script>
  <script src="../js/LiveValidation.js"></script> 
  <script src="../js/functions.js"></script>
  <script src="../js/jquery.panelslider.min.js"></script>
  <script src="../js/jquery.magnific-popup.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyChEZKZvF-cZPsd-9DXB4jHvxXg1NoV9bo&sensor=true"></script>
  <script src="../js/location.js"></script>
  
  <script> 
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
		
		//information of places
		$('.ajax_place').magnificPopup({
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
		
		//label of search----------------
		var tags = new LiveValidation('tags');
		tags.add(Validate.Presence);
		
		var tags_mobile = new LiveValidation('tags_mobile');
		tags_mobile.add(Validate.Presence);
	   
	});
	
	//panel notifications--------------------------
	$('#left-panel-link').panelslider();
	
	$('#close_notifications').click(function() {
      $.panelslider.close();
    });
	
	//panel friends--------------------------------
	$('#right-panel-link').panelslider({side: 'right'});
	
	$('#close_friends').click(function() {
      $.panelslider.close();
    });
	
	$(function() {
		$( "#accordion" ).accordion({
			collapsible: true,
	  		heightStyle: "fill",
			active: false
		});
    });
	
	//option search--------------------------------------
	$(function() {
	   var data = [
		  { label: "Promos", category: "Tags" },
		  { label: "Night", category: "Tags" },
		  { label: "Food", category: "Tags" },
		  { label: "The cabin", category: "Places" },
		  { label: "the ark", category: "Places" },
		  { label: "Zoo", category: "Places" }
		];
    $( "#tags" ).catcomplete({
      delay: 0,
      source: data
    });
	$( "#tags_mobile" ).catcomplete({
      delay: 0,
      source: data
    });
  });
  </script>
    
  <script>
  //option search--------------------------------------------
  $.widget( "custom.catcomplete", $.ui.autocomplete, {
    _create: function() {
      this._super();
      this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
    },
    _renderMenu: function( ul, items ) {
      var that = this,
        currentCategory = "";
      $.each( items, function( index, item ) {
        var li;
        if ( item.category != currentCategory ) {
          ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
          currentCategory = item.category;
        }
        li = that._renderItemData( ul, item );
        if ( item.category ) {
          li.attr( "aria-label", item.category + " : " + item.label );
        }
      });
    }
  });
  </script>
</body>
</html>
















