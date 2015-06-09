<script src="../js/bootstrap-filestyle.min.js"> </script>

<h4 class="title_option">Galleries</h4>
<div id="table_gal" class="table-responsive design_tables">
	<table class="table table-hover table_galleries">
		<tr class="active">
			<th>Id</th>
			<th>Comment</th>
			<th>Date</th>
			<th>Image</th>
			<th>Place</th>
		</tr>
	</table>
</div>	
<div class="message"></div>
<button id="butt_add_gal" class="btn btn-default" type="submit">Add new</button>
<div id="form_gal" class="form_container">
	<label class="title_form">New</label>
	<form method="post" action="inserts.php?add=gal" enctype="multipart/form-data">
	  <div class="form-group label_input_form">
		<label>Comment</label>
		<input type="text" name="comment" class="form-control" placeholder="Enter comment" maxlength="150" autofocus required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Image</label>
		<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture" required>		
	  </div>
	  <div class="form-group label_input_form">	  	
		<label>Place</label>
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
				$conex->close();
			?>
		</select>
	  </div>
	  <button type="button" id="butt_can_gal" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add" onclick="return confirm_msg()">Add</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		/* info of table */
		$.ajax({
			type: "GET",
			url: "ajax_galleries.php?indicator=1"
		})
		.done(function(json){
			json = $.parseJSON(json)
			for(var i=0;i<json.length;i++){
				$('.table_galleries').append(				
					"<tr class='rows_table'>"
						 +"<td class='id'>"+json[i].id+"</td>"
					     +"<td class='editable' data-campo='comment'><span>"+json[i].comment+"</span></td>"
						 +"<td>"+json[i].date+"</td>"
						 +"<td>"+json[i].image_name+"</td>"
						 +"<td>"+json[i].place_name+"</td>"
					+"</tr>");				
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
			$("#butt_add_gal").hide();
			
			td.text("").html("<input type='text' class='text_editable' name='"+campo+"' value='"+valor+"'><a class='link_pro save' href='#'>Save</a><a class='link_pro cancel' href='#'>Cancel</a>");
		
		});
		
		/*cancel method*/
		$(document).on("click",".cancel",function(e){
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
			$("#butt_add_gal").show();
		});
		
		/*save method*/
		$(document).on("click",".save",function(e){
			$(".message").html("<img src='../images/loading.gif'>");
			e.preventDefault();
			nuevovalor=$(this).closest("td").find("input").val();
			if(nuevovalor.trim()!=""){
				$.ajax({
					type: "POST",
					data: { campo: campo, valor: nuevovalor, id:id},
					url: "ajax_galleries.php"					
				})
				.done(function( msg ) {
					$(".message").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok').fadeOut('fast');}, 3000);
					$("#butt_add_gal").show();
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
		$("#form_gal").hide();
				
		/*click button add*/		
	    $("#butt_add_gal").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_gal").show();
		    $("#table_gal").hide();
		    $("#butt_add_gal").hide();
		});
		
		/*click button cancel form*/
		$("#butt_can_gal").click(function(evento){
		  evento.preventDefault();  
		    $("#table_gal").show();
		    $("#butt_add_gal").show();
			$("#form_gal").hide();
		});
	   
	});
	
	function confirm_msg(){ 
		if (confirm('Are you sure to add a gallery?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
		
</script>




