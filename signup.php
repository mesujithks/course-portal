<?php
include("auth.php"); //include auth.php file on all secure pages ?>
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
    		var u=document.getElementById('username').value;
    		var p=document.getElementById('password').value;
    		var e=document.getElementById('email').value;
    		var fn=document.getElementById('fname').value;
    		var ln=document.getElementById('lname').value;
    		var ad=document.getElementById('address').value;
    		var ph=document.getElementById('phone').value;
    		var cl=document.getElementById('college').value;
    		var db=document.getElementById('dob').value;
    		var gd=document.getElementById('gender').value;
    		
    		if (u=="" || p=="" || e=="" || fn=="" || ln=="" || ad=="" || ph=="" || cl=="" || db=="" || gd=="") {
    			alert("error");
    		}
    		else if(f){
    			
    			f.submit();
    		}
}    		
    	
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
		<?php
	require('db.php');
    // If form submitted, insert values into the database.
    if (isset($_REQUEST['username'])){
		$username = stripslashes($_REQUEST['username']); // removes backslashes
		$username = mysqli_real_escape_string($con,$username); //escapes special characters in a string
		$email = stripslashes($_REQUEST['email']);
		$email = mysqli_real_escape_string($con,$email);
		$password = stripslashes($_REQUEST['password']);
		$password = mysqli_real_escape_string($con,$password);
		$type = stripslashes($_REQUEST['type']);
		$type = mysqli_real_escape_string($con,$type);

		$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, type, trn_date) VALUES ('$username', '".md5($password)."', '$email', '$type', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            //succesfully inserted user
            $query1 = "SELECT * FROM `users` WHERE username='$username'";
            $result1 = mysqli_query($con,$query1);
            if($result1) {
            	
            	$row=$result1->fetch_assoc();
          	   $studentId=$row["id"];
          	   echo $studentId;
        
      			$fname = stripslashes($_REQUEST['fname']);
					$fname = mysqli_real_escape_string($con,$fname);
					$lname = stripslashes($_REQUEST['lname']);
					$lname = mysqli_real_escape_string($con,$lname);
					$address = stripslashes($_REQUEST['address']);
					$address = mysqli_real_escape_string($con,$address);
					$phone = stripslashes($_REQUEST['phone']);
					$phone = mysqli_real_escape_string($con,$phone);
					$college = stripslashes($_REQUEST['college']);
					$college = mysqli_real_escape_string($con,$college);
					$dob = stripslashes($_REQUEST['dob']);
					$dob = mysqli_real_escape_string($con,$dob);
					$gender = stripslashes($_REQUEST['gender']);
					$gender = mysqli_real_escape_string($con,$gender);

					
					$query2 = "INSERT into `students` (studentId,fname,lname,address,phone,college,dob,gender) VALUES ($studentId,'$fname', '$lname', '$address', '$phone', '$college','$dob','$gender')";
            	$result2 = mysqli_query($con,$query2);
            	if($result2) {
            		echo "signup success";
            		
            		}
				
					else {
							echo mysqli_error($con);
							$query1 = "DELETE `users` WHERE username='$username'";
           				$result1 = mysqli_query($con,$query1);
						}
				}else {
          		echo mysqli_error($con);
          		}
			}	
		

        
    }
?>

		<div class="mdl-card mdl-shadow--2dp layout1">
						<!-- Simple header with fixed tabs. -->
						<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
						    <header class="mdl-layout__header">
							    <div class="mdl-layout__header-row">
							      <!-- Title -->
							      <span class="mdl-layout-title">Course Portal Signup</span>
							      <div class="mdl-layout-spacer"></div>
							      <nav class="mdl-navigation mdl-layout--large-screen-only">
							        <a class="mdl-navigation__link" href="index.php">Home</a>
							        <a class="mdl-navigation__link" href="login.php">Login</a>
							        <a class="mdl-navigation__link" href="">Courses</a>
							        <a class="mdl-navigation__link" href="">About</a>
							      </nav>
							    </div>
							    <!-- Tabs -->
							    <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
							      <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Student</a>
							      <a href="#fixed-tab-2" class="mdl-layout__tab">Faculty</a>
							    </div>
						    </header>
						    <div class="mdl-layout__drawer">
						        <span class="mdl-layout-title">Menu</span>
						         <nav class="mdl-navigation">
							      <a class="mdl-navigation__link" href="index.php">Home</a>
							      <a class="mdl-navigation__link" href="login.php">Login</a>
							      <a class="mdl-navigation__link" href="">Courses</a>
							      <a class="mdl-navigation__link" href="">About</a>
							    </nav>
						    </div>
						    <main class="mdl-layout__content">
							    <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
							        <div class="page-content"><!-- Your content goes here -->
											<div class="page-content"><center>
						    	<form action="" method="post" name="signup" id="signupstudent">
			<div class="login-form-div mdl-grid">
				
				<div class="mdl-cell mdl-cell--12-col cell_con">
					<i class="material-icons">person</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="uname" name="username">
						<label class="mdl-textfield__label" for="uname">Enter Username</label>
						
			        </div>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<i class="material-icons">lock</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="password" id="pwd" name="password">
						<label class="mdl-textfield__label" for="pwd">Enter Password</label>
			        </div>
				</div>
				
				<div class="mdl-cell mdl-cell--12-col cell_con">
					<i class="material-icons">email</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email">
						<label class="mdl-textfield__label" for="email">Enter valid Email</label>
						<span class="mdl-textfield__error">Invalid Email...!</span>
			        </div>
			      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			        <i class="material-icons">phone</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="phone" name="phone">
						<label class="mdl-textfield__label" for="phone">Phone Number</label>
			        </div>
			   
			      
				</div>	
			        
				<div class="mdl-cell mdl-cell--12-col cell_con">
					<i class="material-icons">person</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="fname" name="fname">
						<label class="mdl-textfield__label" for="fname">First Name</label>
			        </div>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<i class="material-icons">person</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="lname" name="lname">
						<label class="mdl-textfield__label" for="lname">Last Name</label>
			        </div>
			   </div>
			   
			   <div class="mdl-cell mdl-cell--12-col cell_con">
					<i class="material-icons">today</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="dob" id="lname" name="dob">
						<label class="mdl-textfield__label" for="dob">Date of Birth (YYYY-MM-DD)</label>
			        </div>
			   </div>
			   
			   <div class="mdl-cell mdl-cell--12-col cell_con">
					<i class="material-icons">home</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<textarea class="mdl-textfield__input" type="text" rows= "3" id="address" name="address" ></textarea>
								<label class="mdl-textfield__label" for="address">Address</label>
						    </div>
			        </div>
				</div>
				
				<div class="mdl-cell mdl-cell--12-col cell_con">
			        <i class="material-icons">person</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="college" name="college">
						<label class="mdl-textfield__label" for="college">College or Institution</label>
			        </div>
			   	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<i class="material-icons">person</i>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
						<input class="mdl-textfield__input" type="text" id="type" name="type" value="student" readonly>
						<label class="mdl-textfield__label" for="college">Account Type</label>
			        </div>
			   </div>
				
				<div class="mdl-cell mdl-cell--12-col  login-btn-con">
					<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--primary btn" onclick="postSignupStudent()">Signup</button>
				</div>
				
				<div class="mdl-cell mdl-cell--6-col mdl-cell--8-col-tablet links">
					<a class="mdl-button--primary" href="login.php">I have an account alredy, Login Now!</a>
				</div>		
			</div></form></div></center>							        
							        </div>
							    </section>
							    <section class="mdl-layout__tab-panel" id="fixed-tab-2">
							        <div class="page-content"><!-- Your content goes here --></div>
							    </section>
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
