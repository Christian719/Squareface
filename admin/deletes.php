<?php
	//connection	
	include("../include/functions.php");
	$conex = connection();
	
	//session start
	session_start();
	
	//Get the table of delete
	$del_table=$_GET['del'];
	
	//category
	if($del_table=="cat"){
		$id = $_GET['id']; 	
		$update = "update category set status='0' where id='$id'";
		$result_update = $conex->query($update);	
	}
	
	//place
	if($del_table=="pla"){
		$id = $_GET['id']; 	
		$update = "update place set status='0' where id='$id'";
		$result_update = $conex->query($update);	
	}
	
	//promotion
	if($del_table=="pro"){
		$id = $_GET['id']; 	
		$update = "update promotion set status='0' where id='$id'";
		$result_update = $conex->query($update);	
	}
	
	//tags
	if($del_table=="tag"){
		$id = $_GET['id']; 	
		$update = "update tags set status='0' where id='$id'";
		$result_update = $conex->query($update);	
	}
	
	//gallery
	if($del_table=="gal"){
		$id = $_GET['id']; 	
		$update = "update gallery set status='0' where id='$id'";
		$result_update = $conex->query($update);	
	}
	
	$conex->close();
	header("Location: ./");
?>