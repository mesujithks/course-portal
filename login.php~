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

<?php
	require('db.php');
	session_start();
    // If form submitted, insert values into the database.
    if (isset($_POST['username'])){
		
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		
	//Checking is user existing in the database or not
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
				echo "student loggedin";
			}
			else
			{
			header("Location: index.php"); // Redirect user to index.php
			}
            }else{
					echo '<script type="text/javascript">';
					echo 'alert("Invalid Username/Password, Try again.!");';
    				echo '</script>';
				}
    }
?>

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
						<input class="mdl-textfield__input" type="text" id="sample1" name="username">
						<label class="mdl-textfield__label" for="sample1">Enter Username</label>
						
			        </div>
				</div>				
				<div class="mdl-cell mdl-cell--12-col cell_con">
					<i class="material-icons">lock</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="password" id="sample2" name="password">
						<label class="mdl-textfield__label" for="sample2">Enter Password</label>
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
</html>
