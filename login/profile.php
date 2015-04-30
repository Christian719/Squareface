<?php  		
	//connection
	include("functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//consulta
	$modif_user = "SELECT * FROM user WHERE id = '$_SESSION[id]'";
	$result = $conex->query($modif_user);
	$row_modif_user = $result->fetch_assoc();
?>

	<div class="container">
		<div class="col-md-12">
            <div class="col-md-1"></div>
            <div class="col-md-10" id="profile_container">
				<h3 class="profile_title">My profile</h3>
				<div class="col-md-2">
					<table class="table">
						<tr><img class="profile_user_image" name="image_user" src="<?php user_avatar(); ?>"></tr>
						<tr><td class='editable' data-campo='image'><span>Avatar</span></td></tr>
					</table>
					
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
							<td><label class="label_table_activity">Nombre:</label></td>
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
					"<tr><td class='tag_table_info'>Nombre:</td><td class='editable' data-campo='name'><span>"+json[i].name+"</span></td></tr><tr><td class='tag_table_info'>Last name:</td><td class='editable' data-campo='last_name'><span>"+json[i].last_name+"</span></td></tr><tr><td class='tag_table_info'>Birthdate:</td><td class='editable' data-campo='birthdate'><span>"+json[i].birthdate+"</span></td></tr><tr><td class='tag_table_info'>City:</td><td class='editable' data-campo='city'><span>"+json[i].city+"</span></td></tr><tr><td class='tag_table_info'>Phone:</td><td class='editable' data-campo='phone'><span>"+json[i].phone+"</span></td></tr><tr><td class='tag_table_info'>Nickname:</td><td class='editable' data-campo='nickname'><span>"+json[i].nickname+"</span></td></tr><tr><td class='tag_table_info'>email:</td><td class='editable' data-campo='email'><span>"+json[i].email+"</span></td></tr><tr><td></td><td></td></tr>");
			}
		});
		/*metoo de edicion*/
		var td,campo,valor,id;
		$(document).on("click","td.editable span",function(e){
			e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td=$(this).closest("td");
			campo=$(this).closest("td").data("campo");
			valor=$(this).text();
			id=$(this).closest("tr").find(".id").text();
			
			if(campo=="birthdate"){
				td.text("").html("<input type='date' data-format='yyyy-mm-dd' class='text_editable' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");				
			}
			else{
				td.text("").html("<input type='text' class='text_editable' name='"+campo+"' value='"+valor+"'><a class='enlace guardar' href='#'>Guardar</a><a class='enlace cancelar' href='#'>Cancelar</a>");
			}	
		});
		/*metodo cancelar*/
		$(document).on("click",".cancelar",function(e){
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
		});
		/*metodo guardar*/
		$(document).on("click",".guardar",function(e){
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
				$(".message").html("<p class='ko'>Debes ingresar un valor</p>");
				setTimeout(function() {$('.ko').fadeOut('fast');}, 3000);
		});
	});	
	</script>