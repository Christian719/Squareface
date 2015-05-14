<?php  		
	//connection
	include("functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//query
	$modif_user = "SELECT * FROM user WHERE id = '$_SESSION[id]'";
	$result = $conex->query($modif_user);
	$row_modif_user = $result->fetch_assoc();
?>

<script src="../js/bootstrap-filestyle.min.js"> </script>

	<div class="container">
		<div class="col-md-12">
            <div class="col-md-1"></div>
            <div class="col-md-10" id="profile_container">
				<h3 class="profile_title">My profile</h3>
				<div class="col-md-2">
					<div class="form-group">
						<img class="profile_user_image" name="image_user" src="<?php user_avatar(); ?>">
					</div>
					<div class="form-group">
						<input type="file" name="new_image_user" class="filestyle" data-buttonText="Change" data-size="sm" data-iconName="glyphicon glyphicon-user">
					</div>					
				</div>	
				<div class="col-md-5">		
					<div class="message"></div>
					<table class="table profile_information design_table_information">
						<tr><h4 class="table_title">Information</h4></tr>
					</table>	
				</div>
				<div class="col-md-5">
					<div class="message"></div>
					<table class="table design_table_activity">
						<tr><h4 class="table_title">Activity</h4></tr>	
						<tr>
							<td><label class="label_table_activity">Name:</label></td>
							<td><span class="info_table_activity"><?php echo $row_modif_user['name']; ?></span></td>
						</tr>	
						<tr>
							<td><label class="label_table_activity">Last name:</label></td>
							<td><span class="info_table_activity"><?php echo $row_modif_user['last_name']; ?></span></td>
						</tr>
						<tr>
							<td><label class="label_table_activity">Birthdate:</label></td>
							<td><span class="info_table_activity"><?php echo $row_modif_user['birthdate']; ?></span></td>
						</tr>
					</table>
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
		/* OBTENEMOS TABLA */
		$.ajax({
			type: "GET",
			url: "update_profile.php?tabla=1"
		})
		.done(function(json){
			json = $.parseJSON(json)
			for(var i=0;i<json.length;i++){
				$('.profile_information').append(
					"<tr><td class='tag_table_info'>Name:</td><td class='editable' data-campo='name'><span>"+json[i].name+"</span></td></tr><tr><td class='tag_table_info'>Last name:</td><td class='editable' data-campo='last_name'><span>"+json[i].last_name+"</span></td></tr><tr><td class='tag_table_info'>Birthdate:</td><td class='editable' data-campo='birthdate'><span>"+json[i].birthdate+"</span></td></tr><tr><td class='tag_table_info'>City:</td><td class='editable' data-campo='city'><span>"+json[i].city+"</span></td></tr><tr><td class='tag_table_info'>Phone:</td><td class='editable' data-campo='phone'><span>"+json[i].phone+"</span></td></tr><tr><td class='tag_table_info'>Nickname:</td><td class='editable' data-campo='nickname'><span>"+json[i].nickname+"</span></td></tr><tr><td class='tag_table_info'>email:</td><td class='editable' data-campo='email'><span>"+json[i].email+"</span></td></tr><tr><td></td><td></td></tr>");
			}
		});
		/*edit method*/
		var td,campo,valor,id;
		$(document).on("click","td.editable span",function(e){
			e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td=$(this).closest("td");
			campo=$(this).closest("td").data("campo");
			valor=$(this).text();
			id=$(this).closest("tr").find(".id").text();
			
			if(campo=="birthdate"){
				td.text("").html("<input type='date' data-format='yyyy-mm-dd' class='text_editable' name='"+campo+"' value='"+valor+"'><a class='enlace save' href='#'>Save</a><a class='enlace cancel' href='#'>Cancel</a>");				
			}
			else{
				td.text("").html("<input type='text' class='text_editable' name='"+campo+"' value='"+valor+"'><a class='enlace save' href='#'>Save</a><a class='enlace cancel' href='#'>Cancel</a>");
			}	
		});
		/*cancel method*/
		$(document).on("click",".cancel",function(e){
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
		});
		/*save method*/
		$(document).on("click",".save",function(e){
			$(".message").html("<img src='../images/loading.gif'>");
			e.preventDefault();
			nuevovalor=$(this).closest("td").find("input").val();
			if(nuevovalor.trim()!=""){
				$.ajax({
					type: "POST",
					data: { campo: campo, valor: nuevovalor},
					url: "update_profile.php"					
				})
				.done(function( msg ) {
					$(".message").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok').fadeOut('fast');}, 3000);
				});
			}
			else
				$(".message").html("<p class='ko'>You must enter a value</p>");
				setTimeout(function() {$('.ko').fadeOut('fast');}, 3000);
		});
	});	
	</script>