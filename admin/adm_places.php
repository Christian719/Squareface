<script src="../js/bootstrap-filestyle.min.js"> </script>

<h4 class="title_option">Places</h4>
<div id="table_pla" class="table-responsive design_tables">
	<table class="table table-hover table_places">
		<tr class="active">
			<th>Id</th>
			<th>Name</th>
			<th>Address</th>
			<th>City</th>
			<th>Phone</th>
			<th>Schedule</th>
			<th>Image Id</th>
			<th>Rating</th>
			<th>Latitude</th>
			<th>Longitude</th>
			<th>Category Id</th>
			<th>Tags Id</th>
		</tr>
	</table>
</div>	
<div class="message"></div>
<button id="butt_add_pla" class="btn btn-default" type="submit">Add new</button>
<div id="form_pla" class="form_container">
	<label class="title_form">New</label>
	<form class="scroll_form_y">
	  <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" class="form-control" placeholder="Enter name" maxlength="25" autofocus required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Address</label>
		<input type="text" class="form-control" placeholder="Enter address" maxlength="120" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>City</label>
		<input type="text" class="form-control" placeholder="Enter city" maxlength="25">
	  </div>
	  <div class="form-group label_input_form">
		<label>Phone</label>
		<input type="text" class="form-control" placeholder="Enter phone" maxlength="10">
	  </div>
	  <div class="form-group label_input_form">
		<label>Schedule</label>
		<input type="text" class="form-control" placeholder="Enter schedule" maxlength="50" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Image</label>
		<input type="file" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture">
	  </div>
	  <div class="form-group label_input_form">
		<label>Rating</label>
		<select class="form-control">
		    <option>1</option>
		    <option>2</option>
		    <option>3</option>
		    <option>4</option>
		    <option>5</option>
		</select>
	  </div>
	  <div class="form-group label_input_form">
		<label>Latitude</label>
		<input type="text" class="form-control" placeholder="Enter latitude" maxlength="17" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Longitude</label>
		<input type="text" class="form-control" placeholder="Enter longitude" maxlength="17" required>
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
	  <div class="form-group label_input_form">
		<label>Tags Id</label>
		<select class="form-control">
		    <option>1</option>
		    <option>2</option>
		    <option>3</option>
		    <option>4</option>
		    <option>5</option>
			<option>6</option>
		    <option>7</option>
		    <option>8</option>
		    <option>9</option>
		    <option>10</option>
		</select>
	  </div>
	  <button type="button" id="butt_can_pla" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add">Add</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		/* info of table */
		$.ajax({
			type: "GET",
			url: "ajax_places.php?indicator=1"
		})
		.done(function(json){
			json = $.parseJSON(json)
			for(var i=0;i<json.length;i++){
				$('.table_places').append(				
					"<tr class='rows_table'>"
						 +"<td class='id'>"+json[i].id+"</td>"
					     +"<td class='editable' data-campo='name'><span>"+json[i].name+"</span></td>"
						 +"<td class='editable' data-campo='address'><span>"+json[i].address+"</span></td>"
						 +"<td class='editable' data-campo='city'><span>"+json[i].city+"</span></td>"
						 +"<td class='editable' data-campo='phone'><span>"+json[i].phone+"</span></td>"
						 +"<td class='editable' data-campo='schedule'><span>"+json[i].schedule+"</span></td>"
						 +"<td>"+json[i].image+"</td>"
						 +"<td>"+json[i].rating+"</td>"
						 +"<td class='editable' data-campo='lat'><span>"+json[i].lat+"</span></td>"
						 +"<td class='editable' data-campo='lon'><span>"+json[i].lon+"</span></td>"
						 +"<td>"+json[i].category_id+"</td>"
						 +"<td>"+json[i].tags_id+"</td>"
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
					url: "ajax_places.php"					
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
		$("#form_pla").hide();
				
		/*click button add*/		
	    $("#butt_add_pla").click(function(evento){
		  evento.preventDefault();		  
		    $("#form_pla").show();
		    $("#table_pla").hide();
		    $("#butt_add_pla").hide();
		});
		
		/*click button cancel form*/
		$("#butt_can_pla").click(function(evento){
		  evento.preventDefault();  
		    $("#table_pla").show();
		    $("#butt_add_pla").show();
			$("#form_pla").hide();
		});
		
		/*scrollbar*/
	    $('.scroll_form_y').perfectScrollbar();  
	   
	});
</script>




