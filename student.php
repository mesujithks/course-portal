<?php
include("auth.php"); 

	$username=$_SESSION["username"];
	$query = "SELECT * FROM `users` WHERE username='$username'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	  		if($rows==1){
		$row=$result->fetch_assoc();			
		$id=$row["id"];
		$email=$row["email"];
	}
	
	$query = "SELECT * FROM `students` WHERE studentId=$id";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	  		if($rows==1){
		$row=$result->fetch_assoc();	
		$name=$row["fname"]." ".$row["lname"];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Course Portal- Student Panel</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/materialdesignicons.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> 
    <script src="js/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>

	<div class="mdl-card mdl-shadow--2dp layout1">
						<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
						    <header class="mdl-layout__header">
							    <div class="mdl-layout__header-row">
							      <span class="mdl-layout-title">Course Portal Student Panel</span>
							      <div class="mdl-layout-spacer"></div>
							      <nav class="mdl-navigation mdl-layout--large-screen-only">
							        <a class="mdl-navigation__link" href="logout.php">Logout</a>
							        <a class="mdl-navigation__link" href="">Courses</a>
							        <a class="mdl-navigation__link" href="">About</a>
							      </nav>
							    </div>
						    </header>
						    <div class=" mdl-layout__drawer">
						    	<div class="layout__drawer_custom">
						    	    <div class="mdl-grid">
						    	    	<div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet ">
 						    	    		<center><img class="dp_img" src="img/admin-dp.png" class="avatar"> 
 						    	    		<p><strong><?php echo $name; ?></strong>
 						    	    		<nav class="mdl-navigation">
						    		    		<a id="submenu" class="mdl-navigation__link" href="#"><strong>
						    		    		<?php echo $email; ?>&#x25BC;</strong></a>
 						    	    		</nav></center>
 						    	    		<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="submenu">
 						    	    			<li class="mdl-menu__item"><a class="mdl-navigation__link" href="logout.php">Logout</a></li>
 						    	    		</ul>
 						    	    		<hr>
					    		        </div>
						    		    <div class="mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet">
						    		    	<nav class="mdl-navigation">
						    		    		<a class="mdl-navigation__link" href="#">Nav link 2</a>
						    		    		<a class="mdl-navigation__link" href="#">Nav link 2</a>
						    		    		<a class="mdl-navigation__link" href="#">Nav link 3</a>
						    		    	</nav>
						    		    </div></p>
						    	    </div>	
						    	</div>					    
						    </div>
						    <main class="mdl-layout__content">
						    	<div class="admin-cover-card-wide mdl-card mdl-shadow--2dp">
					   				 <div class="mdl-card__title">
					      				  <h2 class="mdl-card__title-text">Welcome <?php echo $name; ?></h2>
					 				   </div>
								   	<div class="mdl-card__supporting-text">
					       			 One person with passion is better than ten with interest..!
					    				</div>
					    				
									</div>
						    </main>
						</div>
					</div>	
					
</body>

<footer class="mdl-mega-footer">
	<div class="mdl-mega-footer__middle-section">
		  <div class="mdl-mega-footer__drop-down-section"> 
		  		<input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked> 
		  		<h1 class="mdl-mega-footer__heading">Features</h1> 
		  		<ul class="mdl-mega-footer__link-list"> 
				  	<li><a href="#">About</a></li> 
				  	<li><a href="#">Terms</a></li>
				  	<li><a href="#">Partners</a></li>
					<li><a href="#">Updates</a></li>
				</ul> 
			</div>
		<div class="mdl-mega-footer__drop-down-section">
			 <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked> 
			 <h1 class="mdl-mega-footer__heading">Details</h1> 
			 <ul class="mdl-mega-footer__link-list"> 
				 <li><a href="#">Specs</a></li> 
				 <li><a href="#">Tools</a></li> 
				 <li><a href="#">Resources</a></li> 
			 </ul> 
		 </div> 
	 <div class="mdl-mega-footer__drop-down-section"> 
		 <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked> 
		 <h1 class="mdl-mega-footer__heading">Technology</h1> 
		 <ul class="mdl-mega-footer__link-list"> 
			 <li><a href="#">How it works</a></li> 
			 <li><a href="#">Patterns</a></li> 
			 <li><a href="#">Usage</a></li> 
			 <li><a href="#">Products</a></li> 
			 <li><a href="#">Contracts</a></li> 
		 </ul> 
	 </div>
	 <div class="mdl-mega-footer__drop-down-section"> 
		 <input class="mdl-mega-footer__heading-checkbox" type="checkbox" checked> 
		 <h1 class="mdl-mega-footer__heading">FAQ</h1> 
		 <ul class="mdl-mega-footer__link-list"> 
			 <li><a href="#">Questions</a></li> 
			 <li><a href="#">Answers</a></li> 
			 <li><a href="#">Contact us</a></li> 
		 </ul> 
	 </div>
	<div class="mdl-mega-footer__bottom-section"> 
		<div class="mdl-logo">Title</div> 
		<ul class="mdl-mega-footer__link-list"> 
			<li><a href="#">Help</a></li> 
			<li><a href="#">Privacy & Terms</a></li> 
		</ul> 
	</div> 
</footer>

</html>
