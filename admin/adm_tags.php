<h4 class="title_option">Tags</h4>
<div id="table_tag" class="table-responsive design_tables">
	<table class="table table-hover table_tags">
		<tr class="active">
			<th>Id</th>
			<th>Name</th>
			<th>Category</th>
		</tr>
	</table>
</div>	
<div class="message"></div>
<button id="butt_add_tag" class="btn btn-default" type="submit">Add new</button>
<div id="form_tag" class="form_container">
	<label class="title_form">New</label>
	<form method="post" action="inserts.php?add=tag">
	  <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" name="name" class="form-control" placeholder="Enter name" maxlength="25" autofocus required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Category Id</label>
		<select name="category" class="form-control">
			<?php
				//connection
				include("../include/functions.php");
				$conex = connection();
				
				//select id and name of category
				$query_cat= "SELECT id, name FROM category order by name asc"; 
				$result_cat= $conex->query($query_cat);
				while ($row_cat = $result_cat->fetch_assoc()){
					$id_category=$row_cat['id'];
					$name_category=$row_cat['name'];
					
					echo '<option value="'.$id_category.'">'.$name_category.'</option>';
				}					
			?>
		    <option value="0">All categories</option>
		</select>
	  </div>
	  <button type="button" id="butt_can_tag" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add" onclick="return confirm_msg()">Add</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		/* info of table */
		$.ajax({
			type: "GET",
			url: "ajax_tags.php?indicator=1"
		})
		.done(function(json){
			json = $.parseJSON(json)
			for(var i=0;i<json.length;i++){
				$('.table_tags').append(				
					"<tr class='rows_table'>"
						 +"<td class='id'>"+json[i].id+"</td>"
					     +"<td class='editable' data-campo='name'><span>"+json[i].name+"</span></td>"
						 +"<td class='editable' data-campo='category_id'><span>"+json[i].category_name+"</span></td>"
					+"</tr>");				
			}
		});
		
		/*edit method*/
		var td, campo, valor, id;
		$(document).on("click","td.editable span",function(e){
			e.preventDefault();
			$("td:not(.id)").removeClass("editable");
			td=$(this).closest("td");
			campo=$(this).closest("td").data("campo");
			valor=$(this).text();
			id=$(this).closest("tr").find(".id").text();
			$("#butt_add_tag").hide();
			
			if(campo=="category_id"){
				td.text("").html("<select name='"+campo+"'>"
						<?php	
							//select id and name of category
							$query_cat= "SELECT id, name FROM category order by name asc"; 
							$result_cat= $conex->query($query_cat);
							while ($row_cat = $result_cat->fetch_assoc()){
								$id_category=$row_cat['id'];
								$name_category=$row_cat['name'];
								
								echo '+"<option value="+'.$id_category.'+">"+"'.$name_category.'"+"</option>"';
							}	
							$conex->close();
						?>
						+"</select><a class='link_pro save' href='#'>Save</a><a class='link_pro cancel' href='#'>Cancel</a>");
			}
			else{
			td.text("").html("<input type='text' class='text_editable' name='"+campo+"' value='"+valor+"'><a class='link_pro save' href='#'>Save</a><a class='link_pro cancel' href='#'>Cancel</a>");
			}
		});
		
		/*cancel method*/
		$(document).on("click",".cancel",function(e){
			e.preventDefault();
			td.html("<span>"+valor+"</span>");
			$("td:not(.id)").addClass("editable");
			$("#butt_add_tag").show();
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
					url: "ajax_tags.php"					
				})
				.done(function( msg ) {				
					$(".message").html(msg);
					td.html("<span>"+nuevovalor+"</span>");
					$("td:not(.id)").addClass("editable");
					setTimeout(function() {$('.ok').fadeOut('fast');}, 3000);
					$("#butt_add_tag").show();
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
		$("#form_tag").hide();
				
		/*click button add*/		
	    $("#butt_add_tag").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_tag").show();
		    $("#table_tag").hide();
		    $("#butt_add_tag").hide();
		});
		
		/*click button cancel form*/
		$("#butt_can_tag").click(function(evento){
		  evento.preventDefault();  
		    $("#table_tag").show();
		    $("#butt_add_tag").show();
			$("#form_tag").hide();
		});
	   
	});
	
	function confirm_msg(){ 
		if (confirm('Are you sure to add a tag?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
</script>




