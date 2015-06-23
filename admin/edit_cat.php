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
	$query = "select name from category where id='$id'";
	$result = $conex->query($query);
	$category = $result->fetch_assoc();
	$name=$category['name'];
?>

<label class="title_form">Edit</label>
<form method="post" action="edits.php?edit=cat" enctype="multipart/form-data">
    <div class="form-group label_input_form">
		<label>Id</label>
		<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" readonly="true">
    </div>
    <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter name" title="Only letters" pattern="[A-z,ñ,Ñ -]{1,20}" maxlength="20" required>
    </div>
	<div class="form-group label_input_form">
		<label>Image</label>
		<input type="file" name="image" class="filestyle" data-buttonText="Choose image" data-size="sm" data-iconName="glyphicon glyphicon-picture">		
	</div>
    <button type="button" id="butt_can_cat_edit" class="btn btn-default butt_cancel">Cancel</button>
    <button type="submit" class="btn btn-default butt_add" onclick="return confirm_edit()">Save</button>
</form>


<script>
	$(document).ready(function(){
		/*click button cancel form_edit*/
		$("#butt_can_cat_edit").click(function(evento){
		  evento.preventDefault();  
		    $("#table_cat").show();
		    $("#butt_add_cat").show();
			$("#form_cat").hide();
			$("#form_cat_edit").hide();
		});
	});
	
	/*edit*/
	function confirm_edit(){ 
		if (confirm('Are you sure to edit this category?')){ 
			return true;
		} 
		else{
			return false;
		}
	}
</script>	