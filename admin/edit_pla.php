<script src="../js/bootstrap-filestyle.min.js"> </script>

<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//obtain id
	$id=$_GET['id'];
	
	//query
	$query = "select * from place where id='$id'";
	$result = $conex->query($query);
	$place = $result->fetch_assoc();
	$name=$place["name"];
	$address=$place["address"];
	$city=$place["city"];
	$phone=$place["phone"];
	$schedule=$place["schedule"];
	$image = $place['image'];
	$rating=$place["rating"];
	$lat=$place["lat"];
	$lon=$place["lon"];			
	$cat_id = $place['category_id'];			
	$place_tags = $place['tags_id'];
?>

<label class="title_form">Edit</label>
<form class="scroll_form_y" name="form_edit_pla" method="post" action="edits.php?edit=pla" enctype="multipart/form-data">
    <div class="form-group label_input_form">
		<label>Id</label>
		<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" readonly="true">
    </div>
    <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter name" maxlength="25" autofocus required>
	</div>
	<div class="form-group label_input_form">
		<label>Address</label>
		<input type="text" name="address" class="form-control" value="<?php echo $address; ?>" placeholder="Enter address" maxlength="120" required>
	</div>
	<div class="form-group label_input_form">
		<label>City</label>
		<input type="text" name="city" class="form-control" value="<?php echo $city; ?>" placeholder="Enter city" maxlength="25" required>
	</div>
	<div class="form-group label_input_form">
		<label>Phone</label>
		<input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>" placeholder="Enter phone" title="numbers only" pattern="[0-9]{1,10}" maxlength="10" required>
	</div>
	<div class="form-group label_input_form">
		<label>Schedule</label>
		<input type="text" name="schedule" class="form-control" value="<?php echo $schedule; ?>" placeholder="Enter schedule" maxlength="50" required>
	</div>
	<div class="form-group label_input_form">
		<label>Image</label>
		<input type="hidden" name="id_image" value="<?php echo $image; ?>">
		<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture">
	</div>
	<div class="form-group label_input_form">
		<label>Rating</label>
		<input type="text" name="id" class="form-control" value="<?php echo $rating; ?>" readonly="true">
	</div>
	<div class="form-group label_input_form">
		<label>Latitude</label>
		<input type="text" name="lat" class="form-control" value="<?php echo $lat; ?>" placeholder="Enter latitude" title="numbers only" title="Enter a latitude" pattern="[0-9.-]{1,17}" maxlength="17" required>
	</div>
	<div class="form-group label_input_form">
		<label>Longitude</label>
		<input type="text" name="lon" class="form-control" value="<?php echo $lon; ?>" placeholder="Enter longitude" title="numbers only" title="Enter a longitude" pattern="[0-9.-]{1,17}" maxlength="17" required>
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
					if($cat_id==$id_category){
						echo '<option selected="selected" value="'.$id_category.'">'.$name_category.'</option>';
					}
					else{
						echo '<option value="'.$id_category.'">'.$name_category.'</option>';
					}	
				}					
			?>
		</select>
	</div>
	<div class="form-group label_input_form">
		<label>Tags</label>
		<select id="edit_tags_place" name="tags_id[]" class="form-control" multiple="multiple">
		    <?php				
				//tags of place
				$tag_list = explode(",", $place_tags);
				$tag_ids = array();					  
				foreach($tag_list as $tag){
				  $tag_ids[] = trim($tag, "|");
				}		  				
				$size_tags = count($tag_list);
				
				//select id and name of tags
				$query_tag= "SELECT id, name FROM tags order by name asc"; 
				$result_tag= $conex->query($query_tag);
				while ($row_tag = $result_tag->fetch_assoc()){
					$id_tag=$row_tag['id'];
					$name_tag=$row_tag['name'];
					//select tags
					$watch="1";
					for ($i = 0; $i<$size_tags; $i ++){ 
						if($id_tag==$tag_ids[$i]){
							echo '<option selected="selected" value="'.$id_tag.'">'.$name_tag.'</option>';
							$watch="0";
						}
					} 
					if($watch=="0"){
					}
					else{
						echo '<option value="'.$id_tag.'">'.$name_tag.'</option>';
					}	
				}	
				$conex->close();
			?>
		</select>
	</div>
    <button type="button" id="butt_can_pla_edit" class="btn btn-default butt_cancel">Cancel</button>
    <button type="submit" class="btn btn-default butt_add" onclick="return confirm_edit()">Save</button>
</form>


<script>
	$(document).ready(function(){
		/*click button cancel form_edit*/
		$("#butt_can_pla_edit").click(function(evento){
		  evento.preventDefault();  
		    $("#table_pla").show();
		    $("#butt_add_pla").show();
			$("#form_pla").hide();
			$("#form_pla_edit").hide();
		});
		
		/*scrollbar*/
	    $('.scroll_form_y').perfectScrollbar();  
		
		/*form---select*/
		$("#edit_tags_place").multipleSelect({
            position: 'top',
			selectAll: false
        });
	});
	
	/*edit*/
	function confirm_edit(){ 
		if (confirm('Are you sure to edit this place?')){ 
			return true;
		} 
		else{
			return false;
		}
	}
</script>	