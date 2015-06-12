<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//obtain id
	$id=$_GET['id'];
	
	//query
	$query = "select name, category_id from tags where id='$id'";
	$result = $conex->query($query);
	$tags = $result->fetch_assoc();
	$name=$tags['name'];
	$cat_id=$tags['category_id'];
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
?>

<label class="title_form">Edit</label>
<form name="form_edit_cat" method="post" action="edits.php?edit=tag">
    <div class="form-group label_input_form">
		<label>Id</label>
		<input type="text" name="id" class="form-control" value="<?php echo $id; ?>" readonly="true">
    </div>
    <div class="form-group label_input_form">
		<label>Name</label>
		<input type="text" name="name" value="<?php echo $name; ?>" class="form-control" placeholder="Enter name" maxlength="25" autofocus required>
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
					if($cat_name==$name_category){
						echo '<option selected="selected" value="'.$id_category.'">'.$name_category.'</option>';
					}
					else{
						echo '<option value="'.$id_category.'">'.$name_category.'</option>';
					}	
				}
				if($cat_name=="All categories"){
					echo '<option selected="selected" value="0">All categories</option>';
				}
				else{
					echo '<option value="0">All categories</option>';
				}	
				$conex->close();					
			?>
		</select>
	</div>
    <button type="button" id="butt_can_tag_edit" class="btn btn-default butt_cancel">Cancel</button>
    <button type="submit" class="btn btn-default butt_add" onclick="return confirm_edit()">Save</button>
</form>


<script>
	$(document).ready(function(){
		/*click button cancel form_edit*/
		$("#butt_can_tag_edit").click(function(evento){
		  evento.preventDefault();  
		    $("#table_tag").show();
		    $("#butt_add_tag").show();
			$("#form_tag").hide();
			$("#form_tag_edit").hide();
		});
	});
	
	/*edit*/
	function confirm_edit(){ 
		if (confirm('Are you sure to edit this tag?')){ 
			return true;
		} 
		else{
			return false;
		}
	}
</script>	