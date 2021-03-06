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
    <meta name="description" content="A portfolio template that uses Material Design Lite.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.grey-pink.min.css" />

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
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
            <div class="mdl-layout__header-row portfolio-logo-row">
                <span class="mdl-layout__title">
                    <div class="portfolio-logo"></div>
                    <span class="mdl-layout__title">Online Course Portal</span>
                </span>
            </div>
            <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                    <a class="mdl-navigation__link" href="index.php">Courses</a>
                    <a class="mdl-navigation__link is-active" href="login.php">Login</a>
                    <a class="mdl-navigation__link" href="signup.php">SignUp</a>
                    <a class="mdl-navigation__link" href="about.php">About</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer mdl-layout--small-screen-only">
            <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                <a class="mdl-navigation__link" href="index.php">Courses</a>
                    <a class="mdl-navigation__link is-active" href="login.php">Login</a>
                    <a class="mdl-navigation__link" href="signup.php">SignUp</a>
                    <a class="mdl-navigation__link" href="about.php">About</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
        	<div class="mdl-grid portfolio-max-width portfolio-contact">
                <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Login to your account</h2>
                    </div>
                    <div class="mdl-card__media">
                        <img class="article-image" src=" images/login-image.png" border="0" alt="">
                    </div>
                    <div class="mdl-card__supporting-text">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="login" id="getlogin">

							<div class="mdl-cell mdl-cell--6-col cell_con">
								<i class="material-icons">person</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="username" name="username" value="<?php echo $username; ?>">
									<label class="mdl-textfield__label" for="username">Enter Username</label>
									<span class="error"><?php echo $usernameErr; ?></span>
			        			</div>
							</div>	

							<div class="mdl-cell mdl-cell--6-col cell_con">
								<i class="material-icons">lock</i>
							
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="password" id="password" name="password" value="<?php echo $password; ?>">
									<label class="mdl-textfield__label" for="password">Enter Password</label>
									<span class="error"><?php echo $passwordErr; ?></span>
			        			</div>
							</div>
				
							<div class="mdl-cell mdl-cell--6-col  login-btn-con">
								<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="postLogin()">Login</button>
							</div>
				
							<div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet links">
								<a class="mdl-button--primary" href="signup.php">Signup now !</a>
							</div>
							<div class="mdl-cell mdl-cell--6-col mdl-cell--4-col-tablet links">
								<a class="mdl-button--primary">Forgot password ?</a>
							</div>		
						</form>
					</div>
                </div>
            </div>
            <footer class="mdl-mini-footer">
                <div class="mdl-mini-footer__left-section">
                    <div class="mdl-logo">Course Portal</div>
                </div>
                <div class="mdl-mini-footer__right-section">
                    <ul class="mdl-mini-footer__link-list">
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Privacy & Terms</a></li>
                    </ul>
                </div>
        </main>
     </div>
</body>

</html>
