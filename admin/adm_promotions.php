<script src="../js/bootstrap-filestyle.min.js"> </script>

<h4 class="title_option">Promotions</h4>
<div id="table_pro" class="table-responsive design_tables">
	<table class="table table-hover table_promotions">
		<tr class="active">
			<th>Id</th>
			<th>Day</th>
			<th>Promotion</th>
			<th>Image</th>
			<th>Place</th>
			<th>Category</th>
		</tr>
	</table>
</div>	
<div class="message"></div>
<button id="butt_add_pro" class="btn btn-default" type="submit">Add new</button>
<div id="form_pro" class="form_container">
	<label class="title_form">New</label>
	<form method="post" action="inserts.php?add=pro" enctype="multipart/form-data">
	  <div class="form-group label_input_form">
		<label>Day</label>
		<select name="day" class="form-control">
		    <option value="1">Sunday</option>
		    <option value="2">Monday</option>
		    <option value="3">Tuesday</option>
		    <option value="4">Wednesday</option>
		    <option value="5">Thursday</option>
			<option value="6">Friday</option>
		    <option value="7">Saturday</option>
		</select>
	  </div>
	  <div class="form-group label_input_form">
		<label>Promotion</label>
		<input type="text" name="promotion" class="form-control" placeholder="Enter promotion" maxlength="150" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Image</label>
		<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Place Id</label>
		<select name="place_id" class="form-control">
		   <?php
				//connection
				include("../include/functions.php");
				$conex = connection();
				
				//select id and name of place
				$query_pla= "SELECT id, name FROM place order by name asc"; 
				$result_pla= $conex->query($query_pla);
				while ($row_pla = $result_pla->fetch_assoc()){
					$id_place=$row_pla['id'];
					$name_place=$row_pla['name'];
					
					echo '<option value="'.$id_place.'">'.$name_place.'</option>';
				}	
			?>
		</select>
	  </div>
	  <button type="button" id="butt_can_pro" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add" onclick="return confirm_msg()">Add</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		/* info of table */
		$.ajax({
			type: "GET",
			url: "ajax_promotions.php?indicator=1"
		})
		.done(function(json){
			json = $.parseJSON(json)
			for(var i=0;i<json.length;i++){
				$('.table_promotions').append(				
					"<tr class='rows_table'>"
						 +"<td class='id'>"+json[i].id+"</td>"
						 +"<td class='editable' data-campo='day'><span>"+json[i].day_name+"</span></td>"
						 +"<td class='editable' data-campo='promotion'><span>"+json[i].promotion+"</span></td>"
						 +"<td class='editable' data-campo='image'><span>"+json[i].image_name+"</span></td>"
						 +"<td>"+json[i].place_name+"</td>"
						 +"<td>"+json[i].category_name+"</td>"
					+"</tr>");				
			}
		});
		
		/*edit method*/
		var td,campo,valor,id,name_image;
		$(document).on("click","td.editable span",function(e){
			e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td=$(this).closest("td");
			campo=$(this).closest("td").data("campo");
			valor=$(this).text();
			id=$(this).closest("tr").find(".id").text();
			$("#butt_add_pro").hide();
			name_image=$(this).text();
			
			if(campo=="day"){
				td.text("").html("<select name='"+campo+"'>"
						+"<option value='1'>Sunday</option>"
						+"<option value='2'>Monday</option>"
						+"<option value='3'>Tuesday</option>"
						+"<option value='4'>Wednesday</option>"
						+"<option value='5'>Thursday</option>"
						+"<option value='6'>Friday</option>"
						+"<option value='7'>Saturday</option>"
						+"</select><a class='link_pro save' href='#'>Save</a><a class='link_pro cancel' href='#'>Cancel</a>");
			}
			else{
				if(campo=="image"){
					td.text("").html("<input type='file' class='text_editable' name='"+campo+"'><a class='link_pro save' href='#'>Save</a><a class='link_pro cancel' href='#'>Cancel</a>");
				}
				else{						
					td.text("").html("<input type='text' class='text_editable' name='"+campo+"' value='"+valor+"'><a class='link_pro save' href='#'>Save</a><a class='link_pro cancel' href='#'>Cancel</a>");
				}
			}	
		});
		
		/*cancel method*/
		$(document).on("click",".cancel",function(e){
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
			$("#butt_add_pro").show();
		});
		
		/*save method*/
		$(document).on("click",".save",function(e){
			$(".message").html("<img src='../images/loading.gif'>");
			e.preventDefault();
			nuevovalor=$(this).closest("td").find("input,select").val();
			if(nuevovalor.trim()!=""){			
				$.ajax({
					type: "POST",
					data: { campo: campo, valor: nuevovalor, id:id},
					url: "ajax_promotions.php"					
				})
				.done(function( msg ) {					
					/*name of day*/
					if(campo=="day"){				
						if (nuevovalor == 1){
							nuevovalor="Sunday";
						}
						if (nuevovalor == 2){
							nuevovalor="Monday";
						}
						if (nuevovalor == 3){
							nuevovalor="Tuesday";
						}
						if (nuevovalor == 4){
							nuevovalor="Wednesday";
						}
						if (nuevovalor == 5){
							nuevovalor="Thursday";
						}
						if (nuevovalor == 6){
							nuevovalor="Friday";
						}
						if (nuevovalor == 7){
							nuevovalor="Saturday";
						}	  
					}
					//name of image
					else{
						if(campo=="image"){
							nuevovalor=name_image;
						}
					}
					
					$(".message").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok').fadeOut('fast');}, 3000);
					$("#butt_add_pro").show();
				});
			}
			else
				$(".message").html("<p class='ko'>You must enter a value</p>");
				setTimeout(function() {$('.ko').fadeOut('fast');}, 3000);
		});		
				
	});	
</script>

<!--script for hide and show divs-->
<script>
	$(document).ready(function(){
		$("#form_pro").hide();
				
		/*click button add*/		
	    $("#butt_add_pro").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_pro").show();
		    $("#table_pro").hide();
		    $("#butt_add_pro").hide();
		});
		
		/*click button cancel form*/
		$("#butt_can_pro").click(function(evento){
		  evento.preventDefault();  
		    $("#table_pro").show();
		    $("#butt_add_pro").show();
			$("#form_pro").hide();
		});
	   
	});
	
	function confirm_msg(){ 
		if (confirm('Are you sure to add a promotion?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
</script>




