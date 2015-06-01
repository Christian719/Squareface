<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Squareface</title>
	<link href="images/icon.jpg" rel="Shortcut Icon" type="image/x-icon">
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/design1.css" rel="stylesheet">
	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyChEZKZvF-cZPsd-9DXB4jHvxXg1NoV9bo&sensor=true"></script>
	<script src="js/location_index.js"></script>
	<script src="js/LiveValidation.js"></script>
	<script>
		$(document).ready(function(){
		   $("#registration_form_ajax").hide();
				
		   $("#registered_user").click(function(evento){
			 evento.preventDefault();		  
			  $("#registration_form_ajax").show();
			  $("#login_form_ajax").hide();
			  $("#new_register_ajax").hide();
		   });
		   
		   $("#cancel").click(function(evento){
			 evento.preventDefault();		  
			  $("#registration_form_ajax").hide();
			  $("#login_form_ajax").show();
			  $("#new_register_ajax").show();
		   });
		   
		   //Validation form to register a new user----------------
			var name = new LiveValidation('name');
			name.add(Validate.Presence);
			name.add(Validate.Format, { pattern: /^([a-z ]+)$/i} );
			
			var last_name = new LiveValidation('last_name');
			last_name.add(Validate.Presence);
			last_name.add(Validate.Format, { pattern: /^([a-z ]+)$/i} );
			
			var nickname = new LiveValidation('nickname');
			nickname.add(Validate.Presence);
			nickname.add(Validate.Format, { pattern: /^([a-z0-9-_]+)$/i} );
			nickname.add(Validate.Length, { minimum: 3 } );
			
			var email_new = new LiveValidation('email_new');
			email_new.add(Validate.Email);
			email_new.add(Validate.Presence);
			
			var password1_new = new LiveValidation('password1_new');
			password1_new.add(Validate.Presence);
			password1_new.add(Validate.Format, { pattern: /^([^@\s]+)$/i} );
			password1_new.add(Validate.Length, { minimum: 6 } );
			
			var password2 = new LiveValidation('password2');
			password2.add( Validate.Confirmation, { match: 'password1_new' } );		
		});
	</script>
</head>

<body>	
	<h2 class="page_title">SQUAREFACE</h2>
	<div class="map_frame">
		<div id="map-canvas" class="map_canvas"><img class="loading_map" src="images/loader.gif"/></div>
	</div>	
	
	<div class="container-fluid">	
		<div class="row">
			<div class ="container_login">							
				<div class="row">
					<div class="col-md-10 col-md-offset-1 login_image">
						<img src="images/login.jpg" class="img-responsive">	
					</div>
				</div>		
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<!--login form------------------------------------>
						<form class="login_form" action="login/verify_home.php" method="post" name="login_form" id="login_form_ajax">
						  <div class="form-group">
							<label class="labels_login">Email address</label>
							<input type="text" name="email" class="form-control" maxlength="50" placeholder="Email address" autofocus>
						  </div>
						  <div class="form-group">
							<label class="labels_login">Password</label>
							<input type="password" name="password" class="form-control" placeholder="Password" maxlength="16">
						  </div>  
						  <div class="form-group">
							<button class="btn btn-primary login_button" type="submit">Sign in</button>
						  </div>
						</form>	
						<!--form to register a new user----------------------->
						<form class="registration_form" method="post" name="registration_form" id="registration_form_ajax" action="user/insert_user_register.php">
						  <div class="form-group">
							<h3 class="register_title">Sign in</h3>
						  </div>
						  <div class="form-group">
							<input type="text" name="name" id="name" class="form-control" maxlength="25" placeholder="Name">							
						  </div>
						  <div class="form-group">
							<input type="text" name="last_name" id="last_name" class="form-control" maxlength="25" placeholder="Last name">
						  </div>
						  <div class="form-group">
							<input type="text" name="nickname" id="nickname" class="form-control" maxlength="20" placeholder="Nickname">
						  </div>
						  <div class="form-group">
							<input type="text" name="email_new" id="email_new" class="form-control" maxlength="50" placeholder="E-mail">
						  </div>
						  <div class="form-group">
							<input type="password" name="password1_new" id="password1_new" class="form-control" maxlength="16" placeholder="Password">
						  </div>
						  <div class="form-group">
							<input type="password" name="password2" id="password2" class="form-control" maxlength="16" placeholder="Confirm password">
						  </div>
							<br>	
						  <div class="form-group register_buttons">
							<button type="button" class="btn cancel_button" id="cancel">Cancel</button>
							<button class="btn btn-primary ok_button" type="submit">Done</button>
						  </div>
						</form>				
					</div>
				</div>			
				<div class="row">
					<div class="col-md-10 col-md-offset-1 new_register" id="new_register_ajax">
						<p class="labels_login">Or maybe you want <a href="#" id="registered_user"><strong><u>Register</u></strong> </a> </p>				
					</div>
				</div>									
			</div>
		</div>
	</div>
		
</body>
</html>
