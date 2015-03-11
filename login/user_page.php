<?php
	//connection to the database
	require_once('connection_db.php');
	
	//session start
	session_start();
	
	//Validate if you are actively involved in successfully
	if (!$_SESSION){
		echo '<script language = javascript>
		alert("You must log in")
		self.location = "../"
		</script>';
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Squareface</title>

    <!-- css-------------------------- -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
	
	<!-- js-------------------------- -->
	<script src="../js/jquery.min.js" type="text/javascript"></script>
	
    <script>
	$(document).ready(function(){
	   $("#enlaceajax").click(function(evento){
		  evento.preventDefault();
		  $("#destino").load("logout.php");
	   });
	})
	</script>  
		
  </head>
  <body>
  <div id="destino"> </div>
	<table align="center">
	  <tr>
		<td><div align="right">User: <strong><?php echo $_SESSION['nickname'];?></strong></div></td>
	  </tr>
	  <tr>
		<td><div align="right"><a href="#" id="enlaceajax">logout</a> </div></td>
	  </tr>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>   
	</table>
	<br />

  </body>
</html>