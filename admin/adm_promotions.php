<h4>PROMOTIONS</h4>
<?php
	//connection
	include("../include/functions.php");
	$conex = connection();
	
	//query
	$query = "SELECT * FROM promotion";
	$result = $conex->query($query);
	
	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 echo "<br> id: ". $row["id"]. " - Promotion: ". $row["promotion"]. "<br>";
		 }
	} else {
		 echo "0 results";
	}
	
	$conex->close();
?>