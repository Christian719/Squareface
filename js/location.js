var map;
var marker;
var marker_place;
var xmlhttp = new XMLHttpRequest();
var url = "places_json.php";
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

//codigo para agregar los lugares al mapa
xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        myFunction(xmlhttp.responseText);
    }
}
xmlhttp.open("GET", url, true);
xmlhttp.send();

function myFunction(response) {
	var infoWindow = new google.maps.InfoWindow;
	
    var arr = JSON.parse(response);
	//esta variable es para obtener las coordenadas
	var point;
	
    var i;
    var out = "<div>";

    for(i = 0; i < arr.length; i++) {
		//borramos el contenido del div en caso que contenga informacion
		out="";
		
		//llenamos el div		
		out += "</br><div class='place_conten'>"
		+ "<h4 class='place_title'>" + arr[i].Name + "</h4> <br/>"
		+ "<img class='place_image' src=" + arr[i].Image_place + "> <br/>"
		+ "<h5 class='place_raiting'>Raiting</h5> <br/>"
		+ "<h5 class='place_info'>" + arr[i].Address + "</h5> <br/>"
		+ "<h5 class='place_info'>" + arr[i].Schedule + "</h5> <br/>"
		+ "<h5 class='place_info'>" + arr[i].Phone + "</h5> <br/>"
		+ "<a class='btn btn-primary place_more ajax_place' role='button' href='place.php'>More Information</a></div> <a class='btn btn-primary place_here' role='button' href='#'>Take me here</a>";
		+ "</br></div>"
		
		//obtenemos las coordenadas
		point = new google.maps.LatLng(
		parseFloat(arr[i].Latitude),
		parseFloat(arr[i].Longitude));
		
		//obtenemos el icono del lugar
		var category_id = arr[i].Category;
		var icon = customIcons[category_id] || {};
		
		//creamos los marcadores de los lugares
		marker_place = new google.maps.Marker({
			map: map,
			position: point,
			icon: icon.icon,
		});	
		
		//agregamos la informacion al marcador	
		bindInfoWindow(marker_place, map, infoWindow, out);
    }
    out += "</div>"
}

//agregamos la funcion para agregar informacion al marcador
function bindInfoWindow(marker_place, map, infoWindow, out) {
	google.maps.event.addListener(marker_place, 'click', function() {
	  infoWindow.setContent(out);
	  infoWindow.open(map, marker_place);
	});
}

google.maps.event.addDomListener(window, 'load', initialize);

































