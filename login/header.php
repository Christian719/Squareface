<?php
	//connection to the database
	error_reporting(5);
	include("functions.php");
	
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
	<link href="../images/icon.png" rel="Shortcut Icon" type="image/x-icon">
	
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/magnific-popup.css" rel="stylesheet">
	<link href="../css/jquery-ui.css" rel="stylesheet">
	<link href="../css/design2.css" rel="stylesheet">
	<link href="../css/design3.css" rel="stylesheet">
	<link href="../css/design_pru.css" rel="stylesheet">
	
</head>

<body>
<!-----------------------------------------------desktop----------------------------------------------------->
<nav class="navbar navbar-default header_container">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="glyphicon glyphicon-menu-hamburger"></span>
	  </button>
      <img class="navbar-brand urvenue_image" src="../images/uv.png" title="Urvenue">
	</div>	
	<ul class="nav navbar-nav navbar-right">	
		<li><img class="user_image" src="<?php user_avatar(); ?>" title="Avatar"></li>	
        <li class="dropdown">
          <a href="#" class="dropdown-toggle options_user" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['nickname'];?><span class="caret"></span></a>
          <ul class="dropdown-menu " role="menu">
            <li><a href="profile.php" class="ajax-popup-link">Profile</a></li>
            <li><a href="#">Administration</a></li>
            <li class="divider"></li>
            <li><a href="logout.php" id="logout">Log out</a></li>
          </ul>
        </li>
      </ul>
	  
      <form class="navbar-form navbar-right search_header" role="search" method="post" action="search_response.php">
        <div class="form-group">
          <input type="text" name="tags" id="tags" class="form-control" placeholder="Search place">
        </div>	
        <button type="submit" class="btn btn-default" title="Search"><span class="glyphicon glyphicon-search"></span></button>
      </form>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="promotion.php" class="ajax-promotion">Promotions</a></li>
		<li><a href="category.php" class="ajax-category">Category</a></li>        
      </ul>     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<!-----------------------------------------------mobile----------------------------------------------------->
<nav class="navbar navbar-default header_container_mobile">
  <div class="container-fluid">
    <div class="navbar-header">
	  <a href="#" data-toggle="dropdown"><img class="urvenue_image_mobile" src="../images/uv.png" title="Urvenue"></a>	   
	  <a href="#" class="dropdown-toggle options_page_mobile" data-toggle="dropdown" id="dropdownMenu1" role="button" aria-expanded="true"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
	  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
		<li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
        <li><a href="promotion.php" class="ajax-promotion">Promotions</a></li>
		<li><a href="category.php" class="ajax-category">Category</a></li> 
	  </ul>	
	</div>  
    <form class="option_search" role="search">
	  <div class="input-group">
	    <input type="text" class="form-control" name="tags-mobile" id="tags_mobile" placeholder="Search">
	    <div class="input-group-btn">
		  <button type="submit" class="btn btn-default" title="Search"><span class="glyphicon glyphicon-search"></span></button>
	    </div>
	  </div>
    </form>	 
    <a href="#" data-toggle="dropdown"><img class="user_image_mobile" src="<?php user_avatar(); ?>" title="Avatar"></a>      
    <a href="#" class="dropdown-toggle options_user_mobile" data-toggle="dropdown" id="dropdownMenu2" role="button" aria-expanded="true"><span class="glyphicon glyphicon-menu-hamburger"></span></a>
    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu2">
	  <li><a href="complete_user.php" class="ajax-popup-link">Profile</a></li>
	  <li><a href="#">Administration</a></li>
	  <li class="divider"></li>
	  <li><a href="logout.php" id="logout">Log out</a></li>
    </ul>
  </div><!-- /.container-fluid -->
</nav>





















