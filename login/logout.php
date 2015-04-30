<?php 
	include("functions.php");
	$conex = connection();
	
	session_start();	
	if ($_SESSION['nickname']){	
		unset($_SESSION['id']); 
		unset($_SESSION['nickname']); 
		
		session_destroy();
		$conex->close();
		echo '<script language = javascript>
		alert("Session finished successfully")
		self.location = "../"
		</script>';
		}
	else{
		echo '<script language = javascript>
		alert("Has not logged on")
		self.location = "../"
		</script>';
	}
?>