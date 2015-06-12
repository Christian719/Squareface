var map;
var marker;

function initialize() {
  var mapOptions = {
    zoom: 15,
	disableDefaultUI: true
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

	  marker = new google.maps.Marker({
		map: map,
		position: pos,
		animation: google.maps.Animation.DROP,
		title:"My Location"
	  });
	
	  google.maps.event.addListener(map, 'center_changed', function() {
		window.setTimeout(function() {
		  map.panTo(marker.getPosition());
		}, 10000);
	  });
			
	  google.maps.event.addListener(marker, 'click', toggleBounce);

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } 
  else {
     handleNoGeolocation(false);
  }
}

function toggleBounce() {

  if (marker.getAnimation() != null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}


function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
     };

  map.setCenter(options.position);
}

google.maps.event.addDomListener(window, 'load', initialize);
