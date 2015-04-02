<?php  		
	//connection
	include("functions.php");
		conexion();
	
	//session start
	session_start();
	
	//consulta
	$modif_user = mysql_query("SELECT * FROM user WHERE id = '$_SESSION[id]'");
	$row_modif_user = mysql_fetch_assoc($modif_user);
?> <script src="../js/bootstrap-filestyle.min.js"> </script>

	<div class="container">
		<div class="col-md-12">
            <div class="col-md-3"></div>
            <div class="col-md-6" id="login">
				<h4 class="titul_profile">My profile</h4>
				<form class="form-horizontal form_pro" role="form" method="post" name="update_user" action="#" enctype="multipart/form-data">
				<div class="col-md-4">
					<div class="form-group">
						<img name="image_user" src="<?php avatar_user(); ?>" class="image_pro">
					</div>
				</div>	
				<div class="col-md-8">
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Nombre:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static"><?php echo $row_modif_user['name']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Last name:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static"><?php echo $row_modif_user['last_name']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Birthdate:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static"><?php echo $row_modif_user['birthdate']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">City:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static"><?php echo $row_modif_user['city']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Phone:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static"><?php echo $row_modif_user['phone']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">Nickname:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static"><?php echo $row_modif_user['nickname']; ?></p>
					  </div>
					</div>
					<div class="form-group">
					  <label class="col-sm-4 control-label etiquetas_profile">E-mail:</label>
					  <div class="col-sm-8 info_profile">
						<p class="form-control-static"><?php echo $row_modif_user['email']; ?></p>
					  </div>
					</div>
				</div>	
					<button class="btn btn-lg btn-primary but_save" type="submit">Save</button>	
					<!--<a class="btn btn-lg but_skip" role="button" href="home.php" >Skip</a>			-->
					<button type="button" class="btn btn-lg but_skip" id="cancel">Cancel</button>		
				</form>
			</div>
			<div class="col-md-3"></div>
        </div>
	</div>
	
  <script>	
	$(document).ready(function(){	   
	   $("#cancel").click(function(evento){
		  evento.preventDefault();		  
		  $('.mfp-close').click();
	   });
	});
  </script>