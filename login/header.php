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
	
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/diseño2.css" rel="stylesheet">
		
</head>

<body>
<nav class="navbar navbar-default mark_header">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed butt_page" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="glyphicon glyphicon-menu-hamburger"></span>
      </button>
      <a class="navbar-brand" href="home.php"><img class="img_ur" id="logo" src="../images/uv.png"></a>
    </div>
	
	<ul class="nav navbar-nav navbar-right">	
		<?php
			//conexion
			require_once('connection_db.php');
			
			//consulta
			$select_image = mysql_query("SELECT * FROM image WHERE papa_id = '$_SESSION[id]'");
			$row_select_image = mysql_fetch_assoc($select_image);
			
			$id = $row_select_image['id'];
			$ext = $row_select_image['img_type'];
			$nombre_fichero = "../photos/user/$id$ext";
			
			if (file_exists($nombre_fichero)) {
				$nombre_fichero = $nombre_fichero;
			} else {
				$nombre_fichero = '../photos/user/default.png';
			}
		?>
		<li><a href="#"><img class="img_user" id="user" src="<?php echo $nombre_fichero; ?>"></a></li>	
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['nickname'];?> <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Administration</a></li>
            <li class="divider"></li>
            <li><a href="logout.php" id="logout">Log out</a></li>
          </ul>
        </li>
      </ul>
	  
      <form class="navbar-form navbar-right search_header" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search place">
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Promotions</a></li>
		<li><a href="#">Category</a></li>        
      </ul>     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-----------------------------------------------mobile---------------------->
<nav class="navbar navbar-default mark_header_mobile">
  <div class="container-fluid">
    <div class="navbar-header">
	  <a href="home.php"><img class="img_ur_m" id="logo" src="../images/uv.png"></a> 
	  
	  <div>     
	  <a href="#" class="dropdown-toggle options_page" data-toggle="dropdown" id="dropdownMenu1" role="button" aria-expanded="true"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
	  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Promotions</a></li>
		<li><a href="#">Category</a></li> 
	  </ul>
	  </div>
	  
	  <form class="option_search" role="search">
		<div class="input-group">
		   <input type="text" class="form-control" placeholder="Search">
		   <div class="input-group-btn">
			  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
		   </div>
		</div>
	 </form>
	 
	 <a href="#"><img class="img_user_m" id="logo" src="<?php echo $nombre_fichero; ?>"></a>      
	  <a href="#" class="dropdown-toggle options_user" data-toggle="dropdown" id="dropdownMenu2" role="button" aria-expanded="true"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
	  <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu2">
		<li><a href="#">Profile</a></li>
        <li><a href="#">Administration</a></li>
        <li class="divider"></li>
        <li><a href="logout.php" id="logout">Log out</a></li>
	  </ul>
  
        
	</div>	
	
  </div><!-- /.container-fluid -->
</nav>























