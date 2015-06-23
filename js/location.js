var map;
var pos;
var marker;
var marker_place;
var myarray;
var id_place;
var xmlhttp = new XMLHttpRequest();
var url = "../places/places_json.php";
var customIcons = {   
	1:{icon: '../maps/icons/1.png'},
    2:{icon: '../maps/icons/2.png'},
    3:{icon: '../maps/icons/3.png'},
    4:{icon: '../maps/icons/4.png'},
	5:{icon: '../maps/icons/5.png'},
    6:{icon: '../maps/icons/6.png'},
    7:{icon: '../maps/icons/7.png'},
    8:{icon: '../maps/icons/8.png'},
	9:{icon: '../maps/icons/9.png'},
    10:{icon: '../maps/icons/10.png'},
	11:{icon: '../maps/icons/11.png'},
    12:{icon: '../maps/icons/12.png'},
    13:{icon: '../maps/icons/13.png'},
    14:{icon: '../maps/icons/14.png'},
	15:{icon: '../maps/icons/15.png'},
    16:{icon: '../maps/icons/16.png'},
    17:{icon: '../maps/icons/17.png'},
    18:{icon: '../maps/icons/18.png'},
	19:{icon: '../maps/icons/19.png'},
    20:{icon: '../maps/icons/20.png'},
	21:{icon: '../maps/icons/21.png'},
    22:{icon: '../maps/icons/22.png'},
    23:{icon: '../maps/icons/23.png'},
    24:{icon: '../maps/icons/24.png'},
	25:{icon: '../maps/icons/25.png'},
    26:{icon: '../maps/icons/26.png'},
    27:{icon: '../maps/icons/27.png'},
    28:{icon: '../maps/icons/28.png'},
	29:{icon: '../maps/icons/29.png'},
    30:{icon: '../maps/icons/30.png'}	
};

var directionsDisplay = new google.maps.DirectionsRenderer({'map-canvas': map }); 
var directionsService = new google.maps.DirectionsService();
var point;
var marker_user_old;
var marker_user;

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

/*function toggle bounce*/
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
		var icon = customIcons[category_id] || {icon: '../maps/icons/default.png'};
		
		var icon_place = new google.maps.MarkerImage(
         icon.icon,
		new google.maps.Size(32,37),
		new google.maps.Point(0, 0),
		new google.maps.Point(16, 37),
		new google.maps.Size(32, 37)
		);
		
		//Create the place markers
		marker_place = new google.maps.Marker({
			map: map,
			position: point,
			icon: icon_place,
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
				if(rating>=0.5){
					star_1="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
				}
			}
			if(cont_rat==1){
				if(rating>=1.5){
					star_2="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
				}
			}
			if(cont_rat==2){
				if(rating>=2.5){
					star_3="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
				}
			}
			if(cont_rat==3){
				if(rating>=3.5){
					star_4="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
				}
			}
			if(cont_rat==4){
				if(rating>=4.5){
					star_5="<span class='glyphicon glyphicon-star place_rating_color' aria-hidden='true'></span>";
				}
			}			
		}
		
		//Fill the div	
		out += "</br><div class='place_conten'>"
		+ "<h4 class='place_title'>" + arr[i].Name + "</h4> </br>"
		+ "<img class='place_image' src=" + arr[i].Image_place + "> </br>"		
		+ "<h5 class='place_raiting' title='"+rating+"'>" + star_1+star_2+star_3+star_4+star_5 + "</h5> </br>"
		+ "<h5 class='place_info'>" + arr[i].Address + "</h5> </br>"
		+ "<h5 class='place_info'>" + arr[i].Schedule + "</h5> </br>"
		+ "<h5 class='place_info'>" + arr[i].Phone + "</h5> </br>"
		+ "<a class='btn btn-link place_more ajax_place' href='../places/place.php?id_place="+id_place+"'>More Information</a> </br>"
		+ "<a class='btn btn-primary place_here' role='button' href='#' onClick='calcRoute("+id_place+")'>Take me here</a>"
		+ "</br></div>";
		
		//Add the information to the marker	
		bindInfoWindow(marker_place, map, infoWindow, out);
		
		//information of places button (more information)
		google.maps.event.addListener(marker_place,'click',function() {
	  		$('.ajax_place').magnificPopup({
			  type: 'ajax',
			  closeOnBgClick:false,
			  closeOnContentClick:false,
			  closeBtnInside:false
			});
			
			/*$('.place_here').click(function() {
			    infoWindow.close();
			});*/
		});
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

//function create check in
function create_check(user_id, lat, lon, date, nickname, image, place_name) {
	var user_id=user_id;
	var latitude=lat;
	var longitude=lon;
	var date=date;
	
	var nickname=nickname;
	var image="../"+image;
	var place_name=place_name;
	
	var avatar = '../images/icons/marker_user.png';
	var marker = "marker";
	var marker_user_new = marker+user_id;
	
	
	if(marker_user_new==marker_user_old){
		marker_user.setMap(null);
	}
	
	marker_user_old=marker_user_new;
	/*marker*/
	marker_user = new google.maps.Marker({
		  position: new google.maps.LatLng(latitude,longitude),
		  map: map,
		  icon: avatar,
		  title: nickname,
		  animation: google.maps.Animation.DROP
	});
	/*infowindow*/
	google.maps.event.addListener(marker_user, 'click', function() {
		var infowindow = new google.maps.InfoWindow({
			content: "<p class='mark_date'>"+date+"</p></br><img class='mark_image' src='"+image+"'/></br><p class='mark_details'>"+nickname+" check in "+place_name+"</p>"
		});
		infowindow.open(map,marker_user);
	});
}

//function for show and hide markers
function select_marker(type_mark){
	var type_mark = type_mark;
	if(type_mark="places"){
		marker_place.setVisible(true);
		marker_user.setVisible(false);
	}
	else{
		if(type_mark="users"){
			marker_place.setVisible(false);
			marker_user.setVisible(true);
		}
		else{
			marker_place.setVisible(true);
			marker_user.setVisible(true);
		}
	}
}

google.maps.event.addDomListener(window, 'load', initialize, xmlhttp.onreadystatechange);



























