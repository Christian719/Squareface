var map;
var marker;
var customIcons = {   
	1:{icon: '../images/icons/bar.png'},
    2:{icon: '../images/icons/restaurant.png'},
    3:{icon: '../images/icons/zoo.png'},
    4:{icon: '../images/icons/workoffice.png'}
};

function initialize() {
  var mapOptions = {
    zoom: 16,
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
	google.maps.event.addListener(marker, 'click', toggleBounce);

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
       handleNoGeolocation(false);
  }  
  //jona's code
  var infoWindow = new google.maps.InfoWindow;
  
  downloadUrl("places_ajax.php", function(data){
  	var xml = data.responseXML;
  	var markers = xml.documentElement.getElementsByTagName("place");
      
  	for (var i = 0; i < markers.length; i++) {
	  var name = markers[i].getAttribute("name");
	  var address = markers[i].getAttribute("address");
	  var schedule = markers[i].getAttribute("schedule");
	  var phone = markers[i].getAttribute("phone");
	  var category_id = markers[i].getAttribute("category_id");
	  var image = markers[i].getAttribute("image");

	  var point = new google.maps.LatLng(
		parseFloat(markers[i].getAttribute("lat")),
		parseFloat(markers[i].getAttribute("lon")));

	  var html = document.createElement('div');
	  html.innerHTML = "<div class='place_conten'><h4 class='place_title'>" + name + "</h4> <br/>"
	  		+ "<img class='place_image' src=" + image + "> <br/>"
			+ "<h5 class='place_raiting'>Raiting</h5> <br/>"
	  		+ "<h5 class='place_info'>" + address + "</h5> <br/>"
			+ "<h5 class='place_info'>" + schedule + "</h5> <br/>"
			+ "<h5 class='place_info'>" + phone + "</h5> <br/>"			
			+ "<a class='btn btn-primary place_butt ajax_place' role='button' href='place.php'>More Information</a></div>";
	  
	  var icon = customIcons[category_id] || {};
      var marker = new google.maps.Marker({
      	map: map,
        position: point,
        icon: icon.icon
      });
	  
	  bindInfoWindow(marker, map, infoWindow, html);
	}
	
  });
  
  google.maps.event.addListener(marker, 'click', function(){
  	if (!infoWindow.isOpen()) {
      infoWindow.open(map, marker);
    }
  }); 
  //end of jona's code
}

//jona's code
function bindInfoWindow(marker, map, infoWindow, html) {
	google.maps.event.addListener(marker, 'click', function() {
	  infoWindow.setContent(html);
	  infoWindow.open(map, marker);
	});
}

function downloadUrl(url, callback) {
	var request = window.ActiveXObject ?
		new ActiveXObject('Microsoft.XMLHTTP') :
		new XMLHttpRequest;

	request.onreadystatechange = function() {
	  if (request.readyState == 4) {
		request.onreadystatechange = doNothing;
		callback(request, request.status);
	  }
	};

	request.open('GET', url, true);
	request.send(null);
}

function doNothing() {}
//edn of jona's code

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


