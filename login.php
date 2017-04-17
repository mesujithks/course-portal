<?php
	include("auth.php");
	require('db.php');
	
	$usenameErr=$passwordErr=$username=$password="";
	$flag=0;
   
   if ($_SERVER["REQUEST_METHOD"]=="POST"){
   	
   	if(!isset($_SESSION["username"])){
   		
		 	if(empty($_POST["username"])) {
				$usernameErr="Username is required.";
				$flag=1;
			}
			else {
				$username = test_input($_POST['username']);
			}
			if(empty($_POST["password"])) {
				$passwordErr="Password is required.";
				$flag=1;
			}
			else {
				$password = test_input($_POST['password']);
			}
			
			if($flag==0) {
				$query = "SELECT * FROM `users` WHERE username='$username' and password='".md5($password)."'";
				$result = mysqli_query($con,$query) or die(mysql_error());
				$rows = mysqli_num_rows($result);
		        if($rows==1){
						$_SESSION['username'] = $username;
						$row=$result->fetch_assoc();
						if($row["type"]=="admin")
						{
							header("Location: admin.php"); 
							
						}
						else if($row["type"]=="student")
						{
							header("Location: student.php");
						}
						else
						{
						header("Location: index.php"); // Redirect user to index.php
						}
		         }else{
							$passwordErr="Invalid Username/Password, Try again.!";
						}
				
				}
			}
			else {
				header("Location: login.php");
				exit();	
			}
		
	}
    
   function test_input($data) {
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Online Course Portal</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/materialdesignicons.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> 
    <script src="js/material.min.js"></script>
    <script type="text/javascript" >
    	function postLogin() {
    		var f=document.getElementById('getlogin');
    		if(f){
    				f.submit();
    		}
		}
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>

	<div class="mdl-card mdl-shadow--2dp layout1">
						<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
						    <header class="mdl-layout__header">
							    <div class="mdl-layout__header-row">
							      <span class="mdl-layout-title">Course Portal Login</span>
							      <div class="mdl-layout-spacer"></div>
							      <nav class="mdl-navigation mdl-layout--large-screen-only">
							        <a class="mdl-navigation__link" href="index.php">Home</a>
							        <a class="mdl-navigation__link" href="signup.php">Signup</a>
							        <a class="mdl-navigation__link" href="">Courses</a>
							        <a class="mdl-navigation__link" href="">About</a>
							      </nav>
							    </div>
						    </header>
						    <div class="mdl-layout__drawer">
							    <span class="mdl-layout-title">Menu</span>
							    <nav class="mdl-navigation">
							      <a class="mdl-navigation__link" href="index.php">Home</a>
							      <a class="mdl-navigation__link" href="signup.php">Signup</a>
							      <a class="mdl-navigation__link" href="">Courses</a>
							      <a class="mdl-navigation__link" href="">About</a>
							    </nav>
						    </div>
						    <main class="mdl-layout__content">
						    	<div class="page-content"><center><h3><strong>Login To Your Account</strong></h3>
						    	<form action="" method="post" name="login" id="getlogin">
			<div class="login-form-div mdl-grid mdl-shadow--2dp">
				
				<div class="mdl-cell mdl-cell--12-col cell_con">
					<i class="material-icons">person</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="username" name="username" value="<?php echo $username; ?>">
						<label class="mdl-textfield__label" for="username">Enter Username</label>
						<span class="error"><?php echo $usernameErr; ?></span>
			        </div>
				</div>				
				<div class="mdl-cell mdl-cell--12-col cell_con">
					<i class="material-icons">lock</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="password" id="password" name="password" value="<?php echo $password; ?>">
						<label class="mdl-textfield__label" for="password">Enter Password</label>
						<span class="error"><?php echo $passwordErr; ?></span>
			        </div>
				</div>
				
				<div class="mdl-cell mdl-cell--12-col  login-btn-con">
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary btn" onclick="postLogin()">Login</button>
				</div>
				
				<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet links">
					<a class="mdl-button--primary" href="signup.php">Signup now !</a>
				</div>
				<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet links">
					<a class="mdl-button--primary">Forgot password ?</a>
				</div>		
			</div></form></div></center>
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
