<h4 class="title_option">Tags</h4>
<div id="table_tag" class="table-responsive design_tables">
<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//query
	$query = "select * from tags where status='1' order by id asc Limit 12";
	$result = $conex->query($query);
	
	if ($result->num_rows > 0) {
		echo '<table class="table table-hover table_tags">';
			echo'<thead>';	   
				echo '<tr class="active head_table">'; 
					echo '<th>Id</th>'; 
					echo '<th>Name</th>';
					echo '<th>Category</th>';
					echo '<th>Edit</th>';
					echo '<th>Delete</th>';
				echo '</tr>'; 
			echo'</thead>';
			echo'<tbody class="scroll_table_tags">';	
		// output data of each row
		while($tags = $result->fetch_assoc()) {	
			//obtain values
			$id=$tags["id"];
			$name=$tags["name"];
			
			$cat_id = $tags['category_id'];
			
			//select name of category			
			if($cat_id==0){
				$cat_name = "All categories";
			}
			else{
				$query_cat= "SELECT name FROM category WHERE id='$cat_id'"; 
				$result_cat= $conex->query($query_cat);
				$row_cat = $result_cat->fetch_assoc();	
				$cat_name = $row_cat['name'];	
			}	
				
			echo '<tr class="rows_table">
					<td name="id">'.$id.'</td>
					<td name="name">'.$name.'</td>
					<td name="category">'.$cat_name.'</td>
					<td name="edit"><a class="btn btn-default btn_edit" role="button" href="#" onclick="edit_row('.$id.')"><img class="edit" src="../images/edit.png" title="Edit"/></a></td>
					<td name="delete"><a class="btn btn-default btn_delete" role="button" href="deletes.php?del=tag&id='.$id.'" onclick="return confirm_delete()"><img class="delete" src="../images/delete.png" title="Delete"/></a></td>
				  </tr>';		
		}
			echo'</tbody>';
		echo '</table>';
	} 
	else {
		 echo "<div class='no_results'><span>0 results</span></div>";
	}
?>
</div>	
<!--button for add new-->
<button id="butt_add_tag" class="btn btn-default btn_add" type="submit">Add new</button>
<!--form for add new-->
<div id="form_tag" class="form_container">
	<label class="title_form">New</label>
	<form method="post" action="inserts.php?add=tag">
	  <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" name="name" class="form-control" placeholder="Enter name" maxlength="25" autofocus required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Category</label>
		<select name="category" class="form-control">
			<?php				
				//select id and name of category
				$query_cat= "SELECT id, name FROM category order by name asc"; 
				$result_cat= $conex->query($query_cat);
				while ($row_cat = $result_cat->fetch_assoc()){
					$id_category=$row_cat['id'];
					$name_category=$row_cat['name'];
					
					echo '<option value="'.$id_category.'">'.$name_category.'</option>';
				}
				$conex->close();					
			?>
		    <option value="0">All categories</option>
		</select>
	  </div>
	  <button type="button" id="butt_can_tag" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add" onclick="return confirm_msg()">Add</button>
	</form>
</div>
<!--form for edit-->
<div id="form_tag_edit" class="form_container"></div>

<!--script for hide and show divs-->
<script>
	$(document).ready(function(){
		$("#form_tag").hide();
		$("#form_tag_edit").hide();
				
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
		
		/*scrollbar*/
	    $('.scroll_table_tags').perfectScrollbar();  
	   
	});
	
	/*add*/	
	function confirm_msg(){ 
		if (confirm('Are you sure to add a tag?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*delete*/
	function confirm_delete(){ 
		if (confirm('Are you sure to delete this tag?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*edit_row*/
	function edit_row(id){ 
		$("#form_tag").hide();
		$("#table_tag").hide();
		$("#butt_add_tag").hide();
		$("#form_tag_edit").load("edit_tag.php?id="+id+"");
		$("#form_tag_edit").show();
	}  
	
</script>




