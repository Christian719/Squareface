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
	$query = "select * from promotion where id='$id'";
	$result = $conex->query($query);
	$promotion = $result->fetch_assoc();
	$day=$promotion['day'];
	$promo=$promotion['promotion'];
	$image=$promotion['image'];
	$pla_id=$promotion['place_id'];
	
	//select name of place			
	$query_pla= "SELECT name FROM place WHERE id='$pla_id'"; 
	$result_pla= $conex->query($query_pla);
	$row_pla = $result_pla->fetch_assoc();	
	$pla_name = $row_pla['name'];
?>

<label class="title_form">Edit</label>
<form name="form_edit_pro" method="post" action="edits.php?edit=pro" enctype="multipart/form-data">
    <div class="form-group label_input_form">
		<label>Id</label>
		<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" readonly="true">
    </div>
   <div class="form-group label_input_form">
		<label>Day</label>
		<select name="day" class="form-control">
		<?php
			if($day==1){
				echo '<option selected="selected" value="1">Sunday</option>';
		    	echo '<option value="2">Monday</option>';
		    	echo '<option value="3">Tuesday</option>';
		    	echo '<option value="4">Wednesday</option>';
		    	echo '<option value="5">Thursday</option>';
				echo '<option value="6">Friday</option>';
		    	echo '<option value="7">Saturday</option>';
			}
			if($day==2){
				echo '<option value="1">Sunday</option>';
		    	echo '<option selected="selected" value="2">Monday</option>';
		    	echo '<option value="3">Tuesday</option>';
		    	echo '<option value="4">Wednesday</option>';
		    	echo '<option value="5">Thursday</option>';
				echo '<option value="6">Friday</option>';
		    	echo '<option value="7">Saturday</option>';
			}
			if($day==3){
				echo '<option value="1">Sunday</option>';
		    	echo '<option value="2">Monday</option>';
		    	echo '<option selected="selected" value="3">Tuesday</option>';
		    	echo '<option value="4">Wednesday</option>';
		    	echo '<option value="5">Thursday</option>';
				echo '<option value="6">Friday</option>';
		    	echo '<option value="7">Saturday</option>';
			}
			if($day==4){
				echo '<option value="1">Sunday</option>';
		    	echo '<option value="2">Monday</option>';
		    	echo '<option value="3">Tuesday</option>';
		    	echo '<option selected="selected" value="4">Wednesday</option>';
		    	echo '<option value="5">Thursday</option>';
				echo '<option value="6">Friday</option>';
		    	echo '<option value="7">Saturday</option>';
			}
			if($day==5){
				echo '<option value="1">Sunday</option>';
		    	echo '<option value="2">Monday</option>';
		    	echo '<option value="3">Tuesday</option>';
		    	echo '<option value="4">Wednesday</option>';
		    	echo '<option selected="selected" value="5">Thursday</option>';
				echo '<option value="6">Friday</option>';
		    	echo '<option value="7">Saturday</option>';
			}
			if($day==6){
				echo '<option value="1">Sunday</option>';
		    	echo '<option value="2">Monday</option>';
		    	echo '<option value="3">Tuesday</option>';
		    	echo '<option value="4">Wednesday</option>';
		    	echo '<option value="5">Thursday</option>';
				echo '<option selected="selected" value="6">Friday</option>';
		    	echo '<option value="7">Saturday</option>';
			}
			if($day==7){
				echo '<option  value="1">Sunday</option>';
		    	echo '<option value="2">Monday</option>';
		    	echo '<option value="3">Tuesday</option>';
		    	echo '<option value="4">Wednesday</option>';
		    	echo '<option value="5">Thursday</option>';
				echo '<option value="6">Friday</option>';
		    	echo '<option selected="selected" value="7">Saturday</option>';
			}
		?>	
		</select>
	</div>
	<div class="form-group label_input_form">
		<label>Promotion</label>
		<textarea name="promotion" class="form-control tam_textarea_admin" rows="5" maxlength="150" placeholder="Enter promotion" required><?php echo $promo; ?></textarea>
	</div>
	<div class="form-group label_input_form">
		<label>Image</label>
		<input type="hidden" name="id_image" value="<?php echo $image; ?>">
		<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture">
	</div>
	<div class="form-group label_input_form">
		<label>Place</label>
		<input type="text" name="place" class="form-control" value="<?php echo $pla_name; ?>" readonly="true">
	</div>
    <button type="button" id="butt_can_pro_edit" class="btn btn-default butt_cancel">Cancel</button>
    <button type="submit" class="btn btn-default butt_add" onclick="return confirm_edit()">Save</button>
</form>


<script>
	$(document).ready(function(){
		/*click button cancel form_edit*/
		$("#butt_can_pro_edit").click(function(evento){
		  evento.preventDefault();  
		    $("#table_pro").show();
		    $("#butt_add_pro").show();
			$("#form_pro").hide();
			$("#form_pro_edit").hide();
		});
	});
	
	/*edit*/
	function confirm_edit(){ 
		if (confirm('Are you sure to edit this promotion?')){ 
			return true;
		} 
		else{
			return false;
		}
	}
</script>	