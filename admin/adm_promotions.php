<script src="../js/bootstrap-filestyle.min.js"> </script>

<h4 class="title_option">Promotions</h4>
<div id="table_pro" class="table-responsive design_tables">
	<table class="table table-hover table_promotions">
		<tr class="active">
			<th>Id</th>
			<th>Day</th>
			<th>Promotion</th>
			<th>Image Id</th>
			<th>Place Id</th>
			<th>Category Id</th>
		</tr>
	</table>
</div>	
<div class="message"></div>
<button id="butt_add_pro" class="btn btn-default" type="submit">Add new</button>
<div id="form_pro" class="form_container">
	<label class="title_form">New</label>
	<form>
	  <div class="form-group label_input_form">
		<label>Day</label>
		<select class="form-control">
		    <option>1</option>
		    <option>2</option>
		    <option>3</option>
		    <option>4</option>
		    <option>5</option>
			<option>6</option>
		    <option>7</option>
		</select>
	  </div>
	  <div class="form-group label_input_form">
		<label>Promotion</label>
		<input type="text" class="form-control" placeholder="Enter promotion" maxlength="150" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Image</label>
		<input type="file" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture">
	  </div>
	  <div class="form-group label_input_form">
		<label>Place Id</label>
		<select class="form-control">
		    <option>1</option>
		    <option>2</option>
		    <option>3</option>
		    <option>4</option>
		    <option>5</option>
		</select>
	  </div>
	  <div class="form-group label_input_form">
		<label>Category Id</label>
		<select class="form-control">
		    <option>1</option>
		    <option>2</option>
		    <option>3</option>
		    <option>4</option>
		    <option>5</option>
		</select>
	  </div>
	  <button type="button" id="butt_can_pro" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add">Add</button>
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
						 +"<td class='id_1'>"+json[i].id+"</td>"
						 +"<td class='editable' data-campo='day'><span>"+json[i].day+"</span></td>"
						 +"<td class='editable' data-campo='promotion'><span>"+json[i].promotion+"</span></td>"
						 +"<td>"+json[i].image+"</td>"
						 +"<td>"+json[i].place_id+"</td>"
						 +"<td>"+json[i].category_id+"</td>"
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
					url: "ajax_promotions.php"					
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
</script>




