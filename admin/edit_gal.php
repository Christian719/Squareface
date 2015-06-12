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
	$query = "select * from gallery where id='$id'";
	$result = $conex->query($query);
	$gallery = $result->fetch_assoc();
	
	//obtain values
	$comment=$gallery['comment'];
	$date=$gallery['date'];
	$type = $gallery['type'];
	$pla_id = $gallery['place_id'];
		
	//select name of place			
	$query_pla= "SELECT name FROM place WHERE id='$pla_id'"; 
	$result_pla= $conex->query($query_pla);
	$row_pla = $result_pla->fetch_assoc();	
	$pla_name = $row_pla['name'];
?>

<label class="title_form">Edit</label>
<form method="post" action="edits.php?edit=gal" enctype="multipart/form-data">
    <div class="form-group label_input_form">
		<label>Id</label>
		<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" readonly="true">
    </div>
    <div class="form-group label_input_form">
		<label>Comment</label>
		<textarea name="comment" class="form-control tam_textarea_admin" rows="5" maxlength="150" placeholder="Enter comment" required><?php echo $comment; ?></textarea>
	</div>
	<div class="form-group label_input_form">
		<label>Date</label>
		<input type="text" name="date" class="form-control" value="<?php echo $date; ?>" readonly="true">
    </div>
	<div class="form-group label_input_form">
		<label>Image</label>
		<input type="hidden" name="type" value="<?php echo $type; ?>">
		<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture">		
	</div>
	<div class="form-group label_input_form">	  	
		<label>Place</label>
		<input type="text" name="place_name" class="form-control" value="<?php echo $pla_name; ?>" readonly="true">
	</div>
    <button type="button" id="butt_can_gal_edit" class="btn btn-default butt_cancel">Cancel</button>
    <button type="submit" class="btn btn-default butt_add" onclick="return confirm_edit()">Save</button>
</form>


<script>
	$(document).ready(function(){
		/*click button cancel form_edit*/
		$("#butt_can_gal_edit").click(function(evento){
		  evento.preventDefault();  
		    $("#table_gal").show();
		    $("#butt_add_gal").show();
			$("#form_gal").hide();
			$("#form_gal_edit").hide();
		});
	});
	
	/*edit*/
	function confirm_edit(){ 
		if (confirm('Are you sure to edit this photo of gallery?')){ 
			return true;
		} 
		else{
			return false;
		}
	}
</script>	