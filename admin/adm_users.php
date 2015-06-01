<h4>USERS</h4>
<?php
	//connection
	include("../include/functions.php");
	$conex = connection();
	
	//query
	$query = "SELECT * FROM user ORDER BY name LIMIT 10";
	$result = $conex->query($query);
	
	if ($result->num_rows > 0) {
		 // output data of each row
		 while($row = $result->fetch_assoc()) {
			 echo "<br> id: ". $row["id"]. " - Name: ". $row["name"]. " " . $row["last_name"] . "<br>";
		 }
	} else {
		 echo "0 results";
	}
	
	$conex->close();
?>

