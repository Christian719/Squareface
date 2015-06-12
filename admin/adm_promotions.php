<script src="../js/bootstrap-filestyle.min.js"> </script>

<h4 class="title_option">Promotions</h4>
<div id="table_pro" class="table-responsive design_tables">
<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//query
	$query = "select * from promotion where status='1' order by id asc";
	$result = $conex->query($query);
	
	if ($result->num_rows > 0) {
		echo '<table class="table table-hover table_promotions">';	   
			echo '<tr class="active">'; 
				echo '<th>Id</th>'; 
				echo '<th>Day</th>';
				echo '<th>Promotion</th>';
				echo '<th>Image</th>';
				echo '<th>Place</th>';
				echo '<th>Category</th>';
				echo '<th>Edit</th>';
				echo '<th>Delete</th>';
			echo '</tr>'; 	 
		// output data of each row
		while($promotion = $result->fetch_assoc()) {
			//obtain values
			$id=$promotion["id"];
			$promo=$promotion["promotion"];
			
			$day = $promotion['day'];
			$pla_id = $promotion['place_id'];
			$cat_id = $promotion['category_id'];
			$image = $promotion['image'];
			
			//select name of day
			$day_name;
			  if ($day == 1){
				$day_name="Sunday";
			  }
			  if ($day == 2){
				$day_name="Monday";
			  }
			  if ($day == 3){
				$day_name="Tuesday";
			  }
			  if ($day == 4){
				$day_name="Wednesday";
			  }
			  if ($day == 5){
				$day_name="Thursday";
			  }
			  if ($day == 6){
				$day_name="Friday";
			  }
			  if ($day == 7){
				$day_name="Saturday";
			  }	  
				
			//select name of place			
			$query_pla= "SELECT name FROM place WHERE id='$pla_id'"; 
			$result_pla= $conex->query($query_pla);
			$row_pla = $result_pla->fetch_assoc();	
			$pla_name = $row_pla['name'];
			
			//select name of category			
			$query_cat= "SELECT name FROM category WHERE id='$cat_id'"; 
			$result_cat= $conex->query($query_cat);
			$row_cat = $result_cat->fetch_assoc();	
			$cat_name = $row_cat['name'];
			
			//select name image			
			$query_img= "SELECT img_type FROM image WHERE id='$image'"; 
			$result_img= $conex->query($query_img);
			$row_img = $result_img->fetch_assoc();	
			$img_type = $row_img['img_type'];
			$image_name=$image.".".$img_type;
					
			echo '<tr class="rows_table">
					<td name="id">'.$id.'</td>
					<td name="day">'.$day_name.'</td>
					<td name="promotion">'.$promo.'</td>
					<td name="image">'.$image_name.'</td>
					<td name="place">'.$pla_name.'</td>
					<td name="category">'.$cat_name.'</td>
					<td name="edit"><a class="btn btn-default btn_edit" role="button" href="#" onclick="edit_row('.$id.')"><img class="edit" src="../images/edit.png" title="Edit"/></a></td>
					<td name="delete"><a class="btn btn-default btn_delete" role="button" href="deletes.php?del=pro&id='.$id.'" onclick="return confirm_delete()"><img class="delete" src="../images/delete.png" title="Delete"/></a></td>
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
<button id="butt_add_pro" class="btn btn-default btn_add" type="submit">Add new</button>
<!--form for add new-->
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
		<textarea name="promotion" class="form-control tam_textarea_admin" rows="5" maxlength="150" placeholder="Enter promotion" required></textarea>
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
	  <button type="button" id="butt_can_pro" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add" onclick="return confirm_msg()">Add</button>
	</form>
</div>
<!--form for edit-->
<div id="form_pro_edit" class="form_container"></div>

<!--script for hide and show divs-->
<script>
	$(document).ready(function(){
		$("#form_pro").hide();
		$("#form_pro_edit").hide();
				
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
	
	/*add*/
	function confirm_msg(){ 
		if (confirm('Are you sure to add a promotion?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*delete*/
	function confirm_delete(){ 
		if (confirm('Are you sure to delete this promotion?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*edit_row*/
	function edit_row(id){ 
		$("#form_pro").hide();
		$("#table_pro").hide();
		$("#butt_add_pro").hide();
		$("#form_pro_edit").load("edit_pro.php?id="+id+"");
		$("#form_pro_edit").show();
	}  
	
</script>




