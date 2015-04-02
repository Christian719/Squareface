<?php  		
	//connection
	include("functions.php");
		conexion();
	
	//session start
	session_start();
		
	//consulta
	$modif_user = mysql_query("SELECT * FROM user WHERE id = '$_SESSION[id]'");
	$row_modif_user = mysql_fetch_assoc($modif_user);
?> 

<script src="../js/bootstrap-filestyle.min.js"> </script>

	<div class="container">
		<div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="login">
				<h4 class="titul_profile">Complete your information</h4>
				<form class="form-horizontal form_pro" role="form" method="post" name="update_user" action="update_user.php" enctype="multipart/form-data">
				<div class="col-md-4 primero">
					<div class="form-group">
						<img name="image_user" src="<?php avatar_user(); ?>" class="image_pro">
					</div>
					<div class="form-group">
						<input type="file" name="new_image_user" class="filestyle" data-buttonText="Change image" data-size="sm" data-iconName="glyphicon glyphicon-user">
					</div>
					<div class="form-group error_men">
						<img name="error" src="../images/error.png" class="error_image">
						<p class="error_text">Imagen no permitida</p>
					</div>
				</div>	
				<div class="col-md-8 segundo">
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Nombre:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static tablet_2"><?php echo $row_modif_user['name']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Last name:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static tablet_2"><?php echo $row_modif_user['last_name']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Birthdate:</label>
					  <div class="col-sm-8">
						<input type="date" name="birthdate" class="form-control movil" data-format="yyyy-mm-dd" placeholder="12/05/1995" required autofocus>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">City:</label>
					  <div class="col-sm-8">
						<input type="text" name="city" onkeypress="javascript: return letter()" class="form-control movil" pattern="[a-z A-Z]*" placeholder="Ej: Morelia" maxlength="20" required>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Phone:</label>
					  <div class="col-sm-8">
						<input type="tel" name="phone" onkeypress="javascript: return number()" pattern="[0-9]*" class="form-control movil" maxlength="10" placeholder="Ej: 4345542134" required>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Nickname:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static tablet_2"><?php echo $row_modif_user['nickname']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile email_etiq_user">E-mail:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static email_info_user"><?php echo $row_modif_user['email']; ?></p>
					  </div>
					</div>
				</div>	
					<button class="btn btn-lg btn-primary but_save" type="submit">Save</button>	
					<!--<a class="btn btn-lg but_skip" role="button" href="home.php" >Skip</a>			-->
					<button type="button" class="btn btn-lg but_skip" id="skip">Skip</button>		
				</form>
			</div>
			<div class="col-md-3"></div>
        </div>
	</div>
	
  <script>	
	$(document).ready(function(){	   
	   $("#skip").click(function(evento){
		  evento.preventDefault();		  
		  $('.mfp-close').click();
	   });   	   
	});
  </script>