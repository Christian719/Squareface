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
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><img class="img_ur" id="logo" src="../images/uv.png"></a>
    </div>
	
	<ul class="nav navbar-nav navbar-right">
        <li><a href="#"><img class="img_user" id="user" src="../images/user.png"></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['nickname'];?><span class="caret"></span></a>
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
        <button type="submit" class="btn btn-default">Search</button>
      </form>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav options_header">
        <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Promotions</a></li>
		<li><a href="#">Category</a></li>        
      </ul>     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
























