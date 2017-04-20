<?php
	include("auth.php"); //include auth.php file on all secure pages 
	require('db.php');
	$usernameErr=$passwordErr=$emailErr=$fnameErr=$lnameErr=$dobErr=$collegeErr="";
	$username=$password=$email=$phone=$fname=$lname=$address=$dob=$college="";
	$successMessage="";
	$flag=0;
	
	if ($_SERVER["REQUEST_METHOD"]=="POST"){
	 	if(empty($_POST["username"])) {
			$usernameErr="Username is required.";
			$flag=1;
		}
		else {
			$username = test_input($_POST['username']);
		}
		if(empty($_POST["email"])) {
			$emailErr="Email is required.";
			$flag=1;
		}
		else {
			$email = test_input($_POST['email']);	
		}
		if(empty($_POST["password"])) {
			$passwordErr="Password is required.";
			$flag=1;
		}
		else {
			$password = test_input($_POST['password']);
		}
		if(empty($_POST["fname"])) {
			$fnameErr="First name is required.";
			$flag=1;
		}
		else {
			$fname = test_input($_POST['fname']);
		}
		if(empty($_POST["lname"])) {
			$lnameErr="Last name is required.";
			$flag=1;
		}
		else {
			$lname = test_input($_POST['lname']);
		}
		if(empty($_POST["dob"])) {
			$dobErr="Date of birth is required.";
			$flag=1;
		}
		else {
			$dob = test_input($_POST['dob']);
		}
		if(empty($_POST["college"])) {
			$collegeErr="College/Institution is required.";
			$flag=1;
		}
		else {
			$college = test_input($_POST['college']);
		}
		
		$address = stripslashes($_POST['address']);
		$address = mysqli_real_escape_string($con,$address);
		$phone = stripslashes($_POST['phone']);
		$phone = mysqli_real_escape_string($con,$phone);
		$gender = stripslashes($_POST['gender']);
		$gender = mysqli_real_escape_string($con,$gender);		
		
		$type = stripslashes($_POST['type']);
		$type = mysqli_real_escape_string($con,$type);
	
		$trn_date = date("Y-m-d H:i:s");
		
		if($flag==0) {
		  $query = "INSERT into `users` (username, password, email, type, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$type', '$trn_date')";
		  $result = mysqli_query($con,$query);
		  if($result){
			   //succesfully inserted user
			   $query1 = "SELECT * FROM `users` WHERE username='$username'";
			   $result1 = mysqli_query($con,$query1);
			   if($result1) {
			   	
			   	$row=$result1->fetch_assoc();
			 	   $studentId=$row["id"];
					$query2 = "INSERT into `students` (studentId,fname,lname,address,phone,college,dob,gender) VALUES ($studentId,'$fname', '$lname', '$address', '$phone', '$college','$dob','$gender')";
			   	$result2 = mysqli_query($con,$query2);
			   	if($result2) {
			   		$username=$password=$email=$phone=$fname=$lname=$address=$dob=$college="";
			   		$successMessage='<div class="mdl-grid portfolio-max-width">
               			 <div class="mdl-cell mdl-card mdl-shadow--4dp portfolio-card">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Success!/h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Your account is successfully created. You can login now...
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="login.php">Login</a>
                    </div>
                </div></div>';
			   		
			   		}
				
					else {
							$query1 = "DELETE `users` WHERE username='$username'";
			  				$result1 = mysqli_query($con,$query1);
						}
				} 
			 		
			}
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
    <title>Signup - Online Course Portal</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/materialdesignicons.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> 
    <script src="js/material.min.js"></script>
    <script src="js/getmdl-select.min.js"></script>
	 <link rel="stylesheet" href="css/getmdl-select.min.css">
    <script type="text/javascript" >
    	function postSignupStudent() {
    		var f=document.getElementById('signupstudent');
    		if(f){
    			f.submit();
    		}
    	}
    	function gotoLogin()
    	{
    		window.location="http://localhost/online-course-portal/login.php";
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
                    <a class="mdl-navigation__link" href="login.php">Login</a>
                    <a class="mdl-navigation__link is-active" href="signup.php">SignUp</a>
                    <a class="mdl-navigation__link" href="about.php">About</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer mdl-layout--small-screen-only">
            <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                <a class="mdl-navigation__link" href="index.php">Courses</a>
                <a class="mdl-navigation__link" href="login.php">Login</a>
                <a class="mdl-navigation__link is-active" href="signup.php">SignUp</a>
                <a class="mdl-navigation__link" href="about.php">About</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
        	<?php echo $successMessage; ?>
        	<div class="mdl-grid portfolio-max-width portfolio-contact">
                <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Create new account</h2>
                    </div>
                    <div class="mdl-card__media">
                        <img class="article-image" src=" images/contact-image.jpg" border="0" alt="">
                    </div>
                    <div class="mdl-card__supporting-text">
                    	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="signup" id="signupstudent">
				
							<div class="mdl-cell mdl-cell--12-col cell_con">
								<i class="material-icons">person</i>
								
					
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="uname" name="username" value="<?php echo $username; ?>">
									<label class="mdl-textfield__label" for="uname">Username</label>
									<span class="error"><?php echo $usernameErr; ?></span>
						
			        			</div>
								
								<i class="material-icons">lock</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="password" id="pwd" name="password" value="<?php echo $password; ?>">
									<label class="mdl-textfield__label" for="pwd">Password</label>
									<span class="error"><?php echo $passwordErr; ?></span>
			       				 </div>
							</div>
				
							<div class="mdl-cell mdl-cell--12-col cell_con">
								<i class="material-icons">email</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="email" id="email" name="email" value="<?php echo $email; ?>">
									<label class="mdl-textfield__label" for="email">Email</label>
									<span class="error"><?php echo $emailErr; ?></span>
			       				</div>
			      				
			       		 		<i class="material-icons">phone</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="phone" name="phone" value="<?php echo $phone; ?>">
									<label class="mdl-textfield__label" for="phone">Phone Number</label>
			       				 </div>   
							</div>	
			        
							<div class="mdl-cell mdl-cell--12-col cell_con">
								<i class="material-icons">person</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="fname" name="fname" value="<?php echo $fname; ?>">
									<label class="mdl-textfield__label" for="fname">First Name</label>
									<span class="error"><?php echo $fnameErr; ?></span>
			        			</div>
								
								<i class="material-icons">person</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="lname" name="lname" value="<?php echo $lname; ?>">
									<label class="mdl-textfield__label" for="lname">Last Name</label>
									<span class="error"><?php echo $lnameErr; ?></span>
			        			</div>
			   			</div>
			   
			   			<div class="mdl-cell mdl-cell--12-col cell_con">
							<i class="material-icons">today</i>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="dob" id="lname" name="dob" value="<?php echo $dob; ?>">
								<label class="mdl-textfield__label" for="dob">Date of Birth (YYYY-MM-DD)</label>
								<span class="error"><?php echo $dobErr; ?></span>
			        		</div>
			   			</div>
			   
			   			<div class="mdl-cell mdl-cell--12-col cell_con">
							<i class="material-icons">home</i>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<textarea class="mdl-textfield__input" type="text" rows= "3" id="address" name="address" value="<?php echo $address; ?>"></textarea>
								<label class="mdl-textfield__label" for="address">Address</label>
						    </div>
			        	</div>
				
						<div class="mdl-cell mdl-cell--12-col cell_con">
			        		<i class="material-icons">person</i>
							<br />
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
     							<input class="mdl-textfield__input" value="Male" type="text" id="gender" name="gender" readonly tabIndex="-1" />
       							<label class="mdl-textfield__label" for="gender">Gender</label>
       							<ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="gender">
        					 		<li class="mdl-menu__item">Male</li>
        							<li class="mdl-menu__item">Female</li>
       							</ul>
   							</div>
   						</div>
				
						<div class="mdl-cell mdl-cell--12-col cell_con">
							<i class="material-icons">work</i>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="text" id="college" name="college" value="<?php echo $college; ?>">
								<label class="mdl-textfield__label" for="college">College or Institution</label>
								<span class="error"><?php echo $collegeErr; ?></span>
			        		</div>
			   				
							<i class="material-icons">person</i>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="text" id="type" name="type" value="student" readonly>
								<label class="mdl-textfield__label" for="college">Account Type</label>
			        		</div>
			   			</div>
				
						<div class="mdl-cell mdl-cell--12-col  login-btn-con">
							<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="postSignupStudent()">Signup</button>
						</div>
				
						<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet links">
							<a class="mdl-button--primary" href="login.php">I have an account alredy, Login Now!</a>
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
</body>

</html>
