<script src="../js/bootstrap-filestyle.min.js"> </script>

<h4 class="title_option">Galleries</h4>
<div id="table_gal" class="table-responsive design_tables scroll_tables">
<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//query
	$query = "select * from gallery where status='1' order by id asc";
	$result = $conex->query($query);
	
	if ($result->num_rows > 0) {
		echo '<table class="table table-hover table_galleries">';	   
			echo '<tr class="active">'; 
				echo '<th>Id</th>'; 
				echo '<th>Comment</th>';
				echo '<th>Date</th>'; 
				echo '<th>Image</th>'; 
				echo '<th>Place</th>'; 
				echo '<th>Edit</th>';
				echo '<th>Delete</th>';
			echo '</tr>'; 	 
		// output data of each row
		while($gallery = $result->fetch_assoc()) {
			//obtain values
			$id=$gallery['id'];
			$comment=$gallery['comment'];
			$date=$gallery['date'];
			
			$pla_id = $gallery['place_id'];
				
			//select name of place			
			$query_pla= "SELECT name FROM place WHERE id='$pla_id'"; 
			$result_pla= $conex->query($query_pla);
			$row_pla = $result_pla->fetch_assoc();	
			$pla_name = $row_pla['name'];
			
			//select name image			
			$type = $gallery['type'];
			$image_name=$id.".".$type;
			
			//insert
			echo '<tr class="rows_table">
					<td name="id">'.$id.'</td>
					<td name="comment">'.$comment.'</td>
					<td name="date">'.$date.'</td>
					<td name="image">'.$image_name.'</td>
					<td name="place">'.$pla_name.'</td>
					<td name="edit"><a class="btn btn-default btn_edit" role="button" href="#" onclick="edit_row('.$id.')"><img class="edit" src="../images/edit.png" title="Edit"/></a></td>
					<td name="delete"><a class="btn btn-default btn_delete" role="button" href="deletes.php?del=gal&id='.$id.'" onclick="return confirm_delete()"><img class="delete" src="../images/delete.png" title="Delete"/></a></td>
				  </tr>';		
		}
		echo '</table>';
	} 
	else {
		 echo "<div class='no_results'><span>0 results</span></div>";
	}
?>
</div>	
<!--button for add new-->
<button id="butt_add_gal" class="btn btn-default btn_add" type="submit">Add new</button>
<!--form for add new-->
<div id="form_gal" class="form_container">
	<label class="title_form">New</label>
	<form method="post" action="inserts.php?add=gal" enctype="multipart/form-data">
	  <div class="form-group label_input_form">
		<label>Comment</label>
		<textarea name="comment" class="form-control tam_textarea_admin" rows="5" maxlength="150" placeholder="Enter comment" required></textarea>
	  </div>
	  <div class="form-group label_input_form">
		<label>Image</label>
		<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture" required>		
	  </div>
	  <div class="form-group label_input_form">	  	
		<label>Place</label>
		<select name="place_id" class="form-control">
			<?php				
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
<!--form for edit-->
<div id="form_gal_edit" class="form_container"></div>

<!--script for hide and show divs-->
<script>
	$(document).ready(function(){
		$("#form_gal").hide();
		$("#form_gal_edit").hide();
				
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
		
		/*scrollbar*/
	    $('.scroll_tables').perfectScrollbar();  
	   
	});
	
	/*add*/
	function confirm_msg(){ 
		if (confirm('Are you sure to add a gallery?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*delete*/
	function confirm_delete(){ 
		if (confirm('Are you sure to delete this photo of gallery?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*edit_row*/
	function edit_row(id){ 
		$("#form_gal").hide();
		$("#table_gal").hide();
		$("#butt_add_gal").hide();
		$("#form_gal_edit").load("edit_gal.php?id="+id+"");
		$("#form_gal_edit").show();
	}  
		
</script>




