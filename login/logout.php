<?php 
	session_start();	
	if ($_SESSION['nickname']){	
		session_destroy();
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