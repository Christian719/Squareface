var map;
var pos;
var marker;
var marker_place;
var myarray;
var id_place;
var xmlhttp = new XMLHttpRequest();
var url = "places_json.php";
var customIcons = {   
	1:{icon: '../images/icons/bar.png'},
    2:{icon: '../images/icons/restaurant.png'},
    3:{icon: '../images/icons/zoo.png'},
    4:{icon: '../images/icons/workoffice.png'}
};
var directionsDisplay = new google.maps.DirectionsRenderer({'map-canvas': map }); 
var directionsService = new google.maps.DirectionsService();
var point;

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
      pos = new google.maps.LatLng(position.coords.latitude,
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
  directionsDisplay.setMap(map);
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

//code that generates the places in the map
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
	
    var i;
    var out = "<div>";
	myarray = new Array(arr.length);

    for(i = 0; i < arr.length; i++) {
		//The content in the div will be deleted if there is any information on it
		out="";
		
		//Get the coordenates
		point = new google.maps.LatLng(
		parseFloat(arr[i].Latitude),
		parseFloat(arr[i].Longitude));
				
		//Create an array to save the place coordenates and their id
		id_place = arr[i].Id;
		myarray[i] = point;
		
		//Get the place icon
		var category_id = arr[i].Category;
		var icon = customIcons[category_id] || {};
		
		//Create the place markers
		marker_place = new google.maps.Marker({
			map: map,
			position: point,
			icon: icon.icon,
			title: arr[i].Name
		});	
		
		//Calculate the rating
		var star_1 = "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
		var star_2 = "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
		var star_3 = "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
		var star_4 = "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
		var star_5 = "<span class='glyphicon glyphicon-star' aria-hidden='true'></span>";
		var rating = arr[i].Rating;
		for (var cont_rat = 0; cont_rat<rating; cont_rat ++){
			if(cont_rat==0){
				star_1="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
			}
			if(cont_rat==1){
				star_2="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
			}
			if(cont_rat==2){
				star_3="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
			}
			if(cont_rat==3){
				star_4="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
			}
			if(cont_rat==4){
				star_5="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
			}			
		}
		
		//Fill the div	
		out += "</br><div class='place_conten'>"
		+ "<h4 class='place_title'>" + arr[i].Name + "</h4> </br>"
		+ "<img class='place_image' src=" + arr[i].Image_place + "> </br>"		
		+ "<h5 class='place_raiting'>" + star_1+star_2+star_3+star_4+star_5 + "</h5> </br>"
		+ "<h5 class='place_info'>" + arr[i].Address + "</h5> </br>"
		+ "<h5 class='place_info'>" + arr[i].Schedule + "</h5> </br>"
		+ "<h5 class='place_info'>" + arr[i].Phone + "</h5> </br>"
		+ "<a class='btn btn-link place_more ajax_place' href='place.php'>More Information</a> </br>"
		+ "<a class='btn btn-primary place_here' role='button' href='#' onClick='calcRoute("+id_place+")'>Take me here</a>"
		+ "</br></div>"
		
		//Add the information to the marker	
		bindInfoWindow(marker_place, map, infoWindow, out);
    }
    out += "</div>"
}

//Add the function to fill the marker info
function bindInfoWindow(marker_place, map, infoWindow, out) {
	google.maps.event.addListener(marker_place, 'click', function() {
	  infoWindow.setContent(out);
	  infoWindow.open(map, marker_place);
	});
}

//create the function "calcRoute"
function calcRoute(id_place) {
  var cont=id_place-1;
  var desti = myarray[cont];
  var request = {
      origin:pos,
      destination:desti,
      travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);	
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

































