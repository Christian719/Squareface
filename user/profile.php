<?php  		
	//connection
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//select information
	$select = "SELECT * FROM user WHERE id = '$_SESSION[id]'";
	$result = $conex->query($select);
	$row = $result->fetch_assoc();
		$name = $row['name'];
		$last_name = $row['last_name'];
		$birthdate = $row['birthdate'];
		$city = $row['city'];
		$phone = $row['phone'];
		$email = $row['email'];
		$nickname = $row['nickname'];
		$password = $row['password'];
		$image = $row['image'];
		
		//select image
		$select_img = "SELECT img_type FROM image WHERE id = 'image'";
		$result_img = $conex->query($select_img);
		$row_img = $result_img->fetch_assoc();
			$img_type = $row_img['img_type'];
?>

<script src="../js/bootstrap-filestyle.min.js"> </script>

<div class="container">
	<div class="col-md-12">
		<div class="col-md-1"></div>
		<div class="col-md-10" id="profile_container">
			<h4 class="profile_title">My profile</h4>
			<!--container info-->			
			<div class="col-md-6 pro_info">		
				<p class="profile_subtitle"><strong>Information</strong></p>
				<div class="cont_info">
					<div id="img_nick">
						<img class="pro_img_user" src="<?php user_avatar(); ?>"><br />
						<strong class="nickname_details"><?php echo $nickname; ?></strong><br />
					</div>	
					<!--form information-->
					<div id="form_info" class="info_details">
						<form class="form-horizontal">
							<div>
								<label class="col-md-3 labels_info">Name:</label>
								<div class="col-md-9">
								    <p class="form-control-static"><?php echo $name; ?></p>
								</div>
							</div>
							<div>
								<label class="col-md-3 labels_info">Last name:</label>
								<div class="col-md-9">
								    <p class="form-control-static"><?php echo $last_name; ?></p>
								</div>
							</div>
							<div>
								<label class="col-md-3 labels_info">Birthdate:</label>
								<div class="col-md-9">
								    <p class="form-control-static"><?php echo $birthdate; ?></p>
								</div>
							</div>
							<div>
								<label class="col-md-3 labels_info">City:</label>
								<div class="col-md-9">
								    <p class="form-control-static"><?php echo $city; ?></p>
								</div>
							</div>
							<div>
								<label class="col-md-3 labels_info">Phone:</label>
								<div class="col-md-9">
								    <p class="form-control-static"><?php echo $phone; ?></p>
								</div>
							</div>
							<div>
								<label class="col-md-3 labels_info">E-mail:</label>
								<div class="col-md-9">
								    <p class="form-control-static"><?php echo $email; ?></p>
								</div>
							</div>
						</form>
					</div>
					<!--buttons edit-->
					<button id="pass" class="btn btn-primary profile_btns" type="submit">Change password</button>
					<button id="date" class="btn btn-primary profile_btns" type="submit">Change Information</button>
				</div>
				<!--form password-->
				<div id="form_pass" class="form_edit_pass">
					<form method="post" action="#">
					    <div class="form-group">
							<label>Old password</label>
							<input type="password" name="old_pass" class="form-control" placeholder="Enter old password" maxlength="16" autofocus required>
					    </div>
					    <div class="form-group">
							<label>New password</label>
							<input type="password" name="new_pass" class="form-control" placeholder="New password" maxlength="16" required>
					    </div>
						<div class="form-group">
							<label>Confirm new password</label>
							<input type="password" name="new_pass_2" class="form-control" placeholder="Confirm new password" maxlength="16" required>
					    </div>
						<button id="cancel_pass" class="btn btn-primary pass_btns" type="submit">Cancel</button>
						<button class="btn btn-primary pass_btns" type="submit">Accept</button>
					</form>  
				</div>
				<!--form information-->
				<div id="form_profile_edit" class="form_edit_profile">
					<form class="form-horizontal" method="post" action="#" enctype="multipart/form-data">
					    <div class="form-group">
							<label class="col-md-3 labels_info">Name:</label>
							<div class="col-md-9">
							    <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" maxlength="25" placeholder="Name" autofocus>	
							</div>
						</div>
					    <div class="form-group">
							<label class="col-md-3 labels_info">Last name:</label>
							<div class="col-md-9">
							    <input type="text" name="last_name" class="form-control" value="<?php echo $last_name; ?>" maxlength="25" placeholder="Last name">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 labels_info">Birthdate:</label>
							<div class="col-md-9">
							    <input type="date" name="birthdate" class="form-control" value="<?php echo $birthdate; ?>" data-format="yyyy-mm-dd" placeholder="12/05/1995">	
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 labels_info">City:</label>
							<div class="col-md-9">
							    <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" maxlength="20" placeholder="Morelia">	
							</div>
						</div>
					    <div class="form-group">
							<label class="col-md-3 labels_info">Phone:</label>
							<div class="col-md-9">
							    <input type="number" name="phone" class="form-control" value="<?php echo $phone; ?>" maxlength="10" placeholder="4521168810">	
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 labels_info">E-mail:</label>
							<div class="col-md-9">
							    <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" maxlength="50" placeholder="E-mail">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 labels_info">Nickname:</label>
							<div class="col-md-9">
							    <input type="text" name="nickname" class="form-control" value="<?php echo $nickname; ?>" maxlength="20" placeholder="Nickname">	
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 labels_info">Image:</label>
							<div class="col-md-9">
							    <input type="hidden" name="id_image" value="<?php echo $image; ?>">
								<input type="file" name="new_image_user" class="filestyle" data-buttonText="Change image" data-size="sm" data-iconName="glyphicon glyphicon-user">
							</div>
						</div>
						<button id="cancel_edit_info" class="btn btn-primary edit_info_btns" type="submit">Cancel</button>
						<button class="btn btn-primary edit_info_btns" type="submit">Accept</button>
					</form>  
				</div>
			</div>
			<!--container activity-->
			<div class="col-md-6 pro_acti">		
				<p class="profile_subtitle"><strong>Activity</strong></p>
				<div class="cont_acty">
					in repair
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
	
<?php
	$conex->close();
?>

<script>
	$(document).ready(function(){
		$("#form_pass").hide();
		$("#form_profile_edit").hide();
		
		/*click button edit pass*/		
	    $("#pass").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_pass").show();
			$("#form_info").hide();
		    $("#pass").hide();
		    $("#date").hide();
		});
		
		/*click button edit pass*/		
	    $("#cancel_pass").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_pass").hide();
			$("#form_info").show();
		    $("#pass").show();
		    $("#date").show();
		});
		
		/*click button edit info*/		
	    $("#date").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_profile_edit").show();
			$("#img_nick").hide();
			$("#form_info").hide();
		    $("#pass").hide();
		    $("#date").hide();
		});
		
		/*click button edit info*/		
	    $("#cancel_edit_info").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_profile_edit").hide();
			$("#img_nick").show();
			$("#form_info").show();
		    $("#pass").show();
		    $("#date").show();
		});
		
	});
	
</script>	