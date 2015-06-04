<h4 class="title_option">Categories</h4>
<div id="table_cat" class="table-responsive design_tables">
	<table class="table table-hover table_categories">
		<tr class="active">
			<th>Id</th>
			<th>Name</th>
		</tr>
	</table>
</div>	
<div class="message"></div>
<button id="butt_add_cat" class="btn btn-default" type="submit">Add new</button>
<div id="form_cat" class="form_container">
	<label class="title_form">New</label>
	<form>
	  <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" class="form-control" placeholder="Enter name" maxlength="20" autofocus required>
	  </div>
	  <button type="button" id="butt_can_cat" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add">Add</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		/* info of table */
		$.ajax({
			type: "GET",
			url: "ajax_categories.php?indicator=1"
		})
		.done(function(json){
			json = $.parseJSON(json)
			for(var i=0;i<json.length;i++){
				$('.table_categories').append(				
					"<tr class='rows_table'>"
						 +"<td class='id_1'>"+json[i].id+"</td>"
					     +"<td class='editable' data-campo='name'><span>"+json[i].name+"</span></td>"
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
			
			td.text("").html("<input type='text' class='text_editable' name='"+campo+"' value='"+valor+"'><a class='link_pro save' href='#'>Save</a><a class='link_pro cancel' href='#'>Cancel</a>");
		
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
					data: { campo: campo, valor: nuevovalor, id:id},
					url: "ajax_categories.php"					
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

<!--script for hide and show divs-->
<script>
	$(document).ready(function(){
		$("#form_cat").hide();
				
		/*click button add*/		
	    $("#butt_add_cat").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_cat").show();
		    $("#table_cat").hide();
		    $("#butt_add_cat").hide();
		});
		
		/*click button cancel form*/
		$("#butt_can_cat").click(function(evento){
		  evento.preventDefault();  
		    $("#table_cat").show();
		    $("#butt_add_cat").show();
			$("#form_cat").hide();
		});
	   
	});
</script>






