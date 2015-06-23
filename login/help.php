<?php  		
	//connection
	include("../include/functions.php");
	
	//session start
	session_start();
?>
<script>
$("dd").hide();
		$("dt").click(function(event){
             var desplegable = $(this).next();
             $('dd').not(desplegable).slideUp('fast');
              desplegable.slideToggle('fast');
              event.preventDefault();
              });
</script>
<div class="container">
	<div class="col-md-12">
		<div class="col-md-1"></div>
		<div class="col-md-10" id="category_container">
			<h4 class="category_title">help</h4>
			<div class="help_content">
			<dl>
				<dt>How to locate my position?</dt>
				<dd> If your browser has a scroll bar just click and drag it until the bottom of the page, then
				this button appears <button type="button" class="btn btn-danger">Locate me</button> just click it 
				and you will be redirected to your position. </dd><br>
				<dt> Where I can see my notifications?</dt>
				<dd> If your browser has a scroll bar just click and drag it until the bottom of the page, then
				this button appears <button type="button" class="btn btn-primary">Notifications</button> just click it</dd><br>
				<dt> Where I can see my friends?</dt>
				<dd> If your browser has a scroll bar just click and drag it until the bottom of the page, then
				this button appears <button type="button" class="btn btn-primary">Friends</button> just click it</dd></dd><br>
				<dt> Where I can see the place information?</dt>
				<dd>When you see an icon like this <img src="../images/icons/restaurant.png"> you can click the icon and then
					it will show you the information about the place.</dd><br>
				<dt>Where I can comment?</dt>
				<dd>After you clicked an icon like this <img src="../images/icons/restaurant.png"> you will see some buttons,
					just click this button <button type="button" class="btn btn-primary">comments</button> and you will see a form to comment</dd><br>
				<dt>Where I can see the gallery?</dt>	
				<dd>After you clicked an icon like this <img src="../images/icons/restaurant.png"> you will see some buttons,
				just click this button <button type="button" class="btn btn-primary">gallery</button> and you will see the galleries</dd><br>
				<dt>Where I can see the promotions?</dt>
				<dd>After you clicked an icon like this <img src="../images/icons/restaurant.png"> you will see some buttons,
				just click this button <button type="button" class="btn btn-primary">promotions</button> and you will see the promotions</dd>
			</dl>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>