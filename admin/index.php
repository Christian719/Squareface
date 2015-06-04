<?php
	//connection to the database
	include("../include/functions.php");
	
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
	<link href="../images/icon.jpg" rel="Shortcut Icon" type="image/x-icon">
	
	<!--css-->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/perfect-scrollbar.css" rel="stylesheet">
	<link href="../css/design_admin.css" rel="stylesheet">	
	
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
            <li><a href="../login/home.php">Home</a></li>
            <li class="divider"></li>
            <li><a href="../login/logout.php" id="logout">Log out</a></li>
          </ul>
        </li>
    </ul>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
		<li><a href="#" id="categories">Categories</a></li>
		<li><a href="#" id="places">Places</a></li>
		<li><a href="#" id="galleries">Galleries</a></li>
		<li><a href="#" id="promotions">Promotions</a></li>
		<li><a href="#" id="tags">Tags</a></li>
      </ul>     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	
<!--HOME---------------------------------------------------------------->
<img class="default_image_admin" id="default_image" src="../images/administration.png">

<div class="content_tables">
	<div id="container_categories"></div>
	<div id="container_places"></div>
	<div id="container_galleries"></div>
	<div id="container_promotions"></div>
	<div id="container_tags"></div>
</div>	
		
<!--FOOTER-------------------------------------------------------------->		
<div id="footer">  
  <div class="text_footer">
    <a href="#">About</a> | <a href="#">Help</a>
    <h5>SQUAREFACE 2015</h5>
  </div>	
</div>	
	
<!--JS----------------------------------------------------------------->	
<script src="../js/jquery.min.js"></script>  
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/perfect-scrollbar.jquery.js"></script>  

<script>
	$(document).ready(function(){
		//load pages and show/hide------------------------------		
		//categories	
		$("#categories").click(function(evento){
	   		$("#container_categories").load("adm_categories.php");
			$("#container_categories").show();
			$("#container_places").hide();
			$("#container_galleries").hide();
			$("#container_promotions").hide();
			$("#container_tags").hide();
			$("#default_image").hide();		
	    });
		
		//places	
		$("#places").click(function(evento){
	   		$("#container_places").load("adm_places.php");	
			$("#container_categories").hide();
			$("#container_places").show();
			$("#container_galleries").hide();
			$("#container_promotions").hide();
			$("#container_tags").hide();
			$("#default_image").hide();	
	    });
		
		//galleries	
		$("#galleries").click(function(evento){
	   		$("#container_galleries").load("adm_galleries.php");	
			$("#container_categories").hide();
			$("#container_places").hide();
			$("#container_galleries").show();
			$("#container_promotions").hide();
			$("#container_tags").hide();
			$("#default_image").hide();	
	    });
		
		//promotions	
		$("#promotions").click(function(evento){
	   		$("#container_promotions").load("adm_promotions.php");	
			$("#container_categories").hide();
			$("#container_places").hide();
			$("#container_galleries").hide();
			$("#container_promotions").show();
			$("#container_tags").hide();
			$("#default_image").hide();	
	    });
		
		//tags	
		$("#tags").click(function(evento){
	   		$("#container_tags").load("adm_tags.php");	
			$("#container_categories").hide();
			$("#container_places").hide();
			$("#container_galleries").hide();
			$("#container_promotions").hide();
			$("#container_tags").show();
			$("#default_image").hide();	
	    });
	});
	
</script>

</body>

</html>