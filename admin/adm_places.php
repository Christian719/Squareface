<script src="../js/bootstrap-filestyle.min.js"> </script>

<h4 class="title_option">Places</h4>
<div id="table_pla" class="table-responsive design_tables scroll_tables">
<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//query
	$query = "select * from place where status='1' order by id asc";
	$result = $conex->query($query);
	
	if ($result->num_rows > 0) {
		echo '<table class="table table-hover table_places">';	   
			echo '<tr class="active">'; 
				echo '<th>Id</th>'; 
				echo '<th>Name</th>';
				echo '<th>Address</th>'; 
				echo '<th>City</th>';
				echo '<th>Phone</th>'; 
				echo '<th>Schedule</th>';
				echo '<th>Image</th>'; 
				echo '<th>Rating</th>';
				echo '<th>Latitude</th>'; 
				echo '<th>Longitude</th>';
				echo '<th>Category</th>'; 
				echo '<th>Tags Ids</th>';
				echo '<th>Edit</th>';
				echo '<th>Delete</th>';
			echo '</tr>'; 	 
		// output data of each row
		while($place = $result->fetch_assoc()) {
			//obtain values
			$id=$place["id"];
			$name=$place["name"];
			$address=$place["address"];
			$city=$place["city"];
			$phone=$place["phone"];
			$schedule=$place["schedule"];
			$rating=$place["rating"];
			$lat=$place["lat"];
			$lon=$place["lon"];
					
			$cat_id = $place['category_id'];		
			$image = $place['image'];
			$place_tags = $place['tags_id'];
					
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
			
			//tags				
			$tag_list = explode(",", $place_tags);
			$tag_ids = array();					  
			foreach($tag_list as $tag){
				$tag_ids[] = trim($tag, "|");
			}		
			
			echo '<tr class="rows_table">
					<td name="id">'.$id.'</td>
					<td name="name">'.$name.'</td>
					<td name="address">'.$address.'</td>
					<td name="city">'.$city.'</td>
					<td name="phone">'.$phone.'</td>
					<td name="schedule">'.$schedule.'</td>
					<td name="image">'.$image_name.'</td>
					<td name="rating">'.$rating.'</td>
					<td name="latitude">'.$lat.'</td>
					<td name="longitude">'.$lon.'</td>
					<td name="category">'.$cat_name.'</td>
					<td name="tags">'.implode(",", $tag_ids).'</td>
					<td name="edit"><a class="btn btn-default btn_edit" role="button" href="#" onclick="edit_row('.$id.')"><img class="edit" src="../images/edit.png" title="Edit"/></a></td>
					<td name="delete"><a class="btn btn-default btn_delete" role="button" href="deletes.php?del=pla&id='.$id.'" onclick="return confirm_delete()"><img class="delete" src="../images/delete.png" title="Delete"/></a></td>
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
<button id="butt_add_pla" class="btn btn-default btn_add" type="submit">Add new</button>
<!--form for add new-->
<div id="form_pla" class="form_container">
	<label class="title_form">New</label>
	<form class="scroll_form_y"  method="post" action="inserts.php?add=pla" enctype="multipart/form-data">
	  <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" name="name" class="form-control" placeholder="Enter name" maxlength="25" autofocus required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Address</label>
		<input type="text" name="address" class="form-control" placeholder="Enter address" maxlength="120" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>City</label>
		<input type="text" name="city" class="form-control" placeholder="Enter city" maxlength="25" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Phone</label>
		<input type="text" name="phone" class="form-control" placeholder="Enter phone" title="numbers only" pattern="[0-9]{1,10}" maxlength="10" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Schedule</label>
		<input type="text" name="schedule" class="form-control" placeholder="Enter schedule" maxlength="50" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Image</label>
		<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture">
	  </div>
	  <div class="form-group label_input_form">
		<label>Rating</label>
		<select name="rating" class="form-control">
		    <option value="1">1</option>
		    <option value="2">2</option>
		    <option value="3">3</option>
		    <option value="4">4</option>
		    <option value="5">5</option>
		</select>
	  </div>
	  <div class="form-group label_input_form">
		<label>Latitude</label>
		<input type="text" name="lat" class="form-control" placeholder="Enter latitude" title="numbers only" title="Enter a latitude" pattern="[0-9.-]{1,17}" maxlength="17" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Longitude</label>
		<input type="text" name="lon" class="form-control" placeholder="Enter longitude" title="numbers only" title="Enter a longitude" pattern="[0-9.-]{1,17}" maxlength="17" required>
	  </div>
	  <div class="form-group label_input_form">
		<label>Category</label>
		<select name="category_id" class="form-control">
		    <?php				
				//select id and name of category
				$query_cat= "SELECT id, name FROM category order by name asc"; 
				$result_cat= $conex->query($query_cat);
				while ($row_cat = $result_cat->fetch_assoc()){
					$id_category=$row_cat['id'];
					$name_category=$row_cat['name'];
					
					echo '<option value="'.$id_category.'">'.$name_category.'</option>';
				}					
			?>
		</select>
	  </div>
	  <div class="form-group label_input_form">
		<label>Tags</label>
		<select id="add_tags_place" name="tags_id[]" class="form-control" multiple="multiple" tabindex="5">
		    <?php				
				//select id and name of tags
				$query_tag= "SELECT id, name FROM tags order by name asc"; 
				$result_tag= $conex->query($query_tag);
				while ($row_tag = $result_tag->fetch_assoc()){
					$id_tag=$row_tag['id'];
					$name_tag=$row_tag['name'];
					if($id_tag<3){
						echo '<option selected="selected" value="'.$id_tag.'">'.$name_tag.'</option>';
					}
					else{
						echo '<option value="'.$id_tag.'">'.$name_tag.'</option>';
					}	
				}	
				$conex->close();
			?>
		</select>
	  </div>
	  <button type="button" id="butt_can_pla" class="btn btn-default butt_cancel">Cancel</button>
	  <button type="submit" class="btn btn-default butt_add" onclick="return confirm_msg()">Add</button>
	</form>
</div>
<!--form for edit-->
<div id="form_pla_edit" class="form_container"></div>

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
	    $('.scroll_tables').perfectScrollbar();    
		
		/*form---select*/
		$("#add_tags_place").multipleSelect({
            position: 'top',
			selectAll: false
        });
			   
	});
	/*add*/
	function confirm_msg(){ 
		if (confirm('Are you sure to add a place?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*delete*/
	function confirm_delete(){ 
		if (confirm('Are you sure to delete this place?')){ 
			return true;
		} 
		else{
			return false;
		}
	} 
	
	/*edit_row*/
	function edit_row(id){ 
		$("#form_pla").hide();
		$("#table_pla").hide();
		$("#butt_add_pla").hide();
		$("#form_pla_edit").load("edit_pla.php?id="+id+"");
		$("#form_pla_edit").show();
	}
		
</script>




