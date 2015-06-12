<h4 class="title_option">Categories</h4>
<div id="table_cat" class="table-responsive design_tables">
<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//query
	$query = "select * from category where status='1' order by id asc";
	$result = $conex->query($query);
	
	if ($result->num_rows > 0) {
		echo '<table class="table table-hover table_categories">';	   
			echo '<tr class="active">'; 
				echo '<th>Id</th>'; 
				echo '<th>Name</th>';
				echo '<th>Edit</th>';
				echo '<th>Delete</th>';
			echo '</tr>'; 	 			
		// output data of each row		
		while($category = $result->fetch_assoc()) {	
			//obtain values
			$id=$category['id'];
			$name=$category['name'];
			
			//insert		
			echo '<tr class="rows_table">
					<td name="id">'.$id.'</td>
					<td name="name">'.$name.'</td>
					<td name="edit"><a class="btn btn-default btn_edit" role="button" href="#" onclick="edit_row('.$id.')"><img class="edit" src="../images/edit.png" title="Edit"/></a></td>
					<td name="delete"><a class="btn btn-default btn_delete" role="button" href="deletes.php?del=cat&id='.$id.'" onclick="return confirm_delete()"><img class="delete" src="../images/delete.png" title="Delete"/></a></td>
				  </tr>';	
		}
		echo '</table>';
	} 
	else {
		 echo "<div class='no_results'><span>0 results</span></div>";
	}	
	$conex->close();
?>
</div>	
<!--button for add new-->
<button id="butt_add_cat" class="btn btn-default btn_add" type="submit">Add new</button>
<!--form for add new-->
<div id="form_cat" class="form_container">
	<label class="title_form">New</label>
	<form method="post" action="inserts.php?add=cat">
	  <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" name="name" class="form-control" placeholder="Enter name" title="Only letters" pattern="[A-z,ñ,Ñ ]{1,20}" maxlength="20" autofocus required>
	  </div>
	  <button type="button" id="butt_can_cat" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add" onclick="return confirm_msg()">Add</button>
	</form>
</div>
<!--form for edit-->
<div id="form_cat_edit" class="form_container"></div>

<!--script for hide and show divs-->
<script>
	$(document).ready(function(){
		$("#form_cat").hide();
		$("#form_cat_edit").hide();
				
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
	
	/*add*/
	function confirm_msg(){ 
		if (confirm('Are you sure to add a category?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*delete*/
	function confirm_delete(){ 
		if (confirm('Are you sure to delete this category?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*edit_row*/
	function edit_row(id){ 
		$("#form_cat").hide();
		$("#table_cat").hide();
		$("#butt_add_cat").hide();
		$("#form_cat_edit").load("edit_cat.php?id="+id+"");
		$("#form_cat_edit").show();
	}  
	
</script>




