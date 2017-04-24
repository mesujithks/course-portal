<?php
include("auth.php"); 
	
	$fnameErr=$lnameErr=$dobErr=$collegeErr=$successMessage="";
	$flag=0;

	if ($_SERVER["REQUEST_METHOD"]=="POST"){
	 	
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
		$sid= test_input($_POST['sid']);
		
		if($flag==0) {
			$query = "UPDATE `students` SET fname='$fname', lname='$lname', address='$address', phone='$phone', college='$college', dob='$dob' WHERE studentId=$sid";
		 	$result = mysqli_query($con,$query);
		  	if($result){
				$successMessage='<div class="mdl-grid portfolio-max-width">
               			 <div class="mdl-cell mdl-card mdl-shadow--4dp portfolio-card">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Success!/h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Account deatils updated successfully.
                    </div>
                </div></div>';
		}
	}
}

	$username=$_SESSION["username"];
	$editForm="";
	$query = "SELECT * FROM `users`,`students` WHERE username='$username' AND studentId=id";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
	if($rows==1){
		$row=$result->fetch_assoc();			
		$id=$row["id"];
		$email=$row["email"];	
		$name=$row["fname"]." ".$row["lname"];
		$fname=$row["fname"];
		$lname=$row["lname"];
		$dob=$row["dob"];
		$address=$row["address"];
		$phone=$row["phone"];
		$college=$row["college"];

		$editForm='<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Edit Details</h2>
                    </div>
                    <div class="mdl-card__media">
                        <img class="article-image" src=" images/online-courses.png" border="0" alt="">
                    </div>
                    <div class="mdl-card__supporting-text">
                    	<form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" name="edit" id="editstudent">
			        
							<div class="mdl-cell mdl-cell--12-col cell_con">
								<i class="material-icons">person</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="fname" name="fname" value="'.$fname.'">
									<label class="mdl-textfield__label" for="fname">First Name</label>
									<span class="error">'.$fnameErr.'</span>
			        			</div>
								
								<i class="material-icons">person</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="lname" name="lname" value="'.$lname.'">
									<label class="mdl-textfield__label" for="lname">Last Name</label>
									<span class="error">'.$lnameErr.'</span>
			        			</div>
			   			</div>
			   
			   			<div class="mdl-cell mdl-cell--12-col cell_con">
							<i class="material-icons">today</i>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="dob" id="lname" name="dob" value="'.$dob.'">
								<label class="mdl-textfield__label" for="dob">Date of Birth (YYYY-MM-DD)</label>
								<span class="error">'.$dobErr.'</span>
			        		</div>
			   			</div>
			   
			   			<div class="mdl-cell mdl-cell--12-col cell_con">
							<i class="material-icons">home</i>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                					<input class="mdl-textfield__input" type="text" id="address" name="address" value="'.$address.'"></input>
                					<label class="mdl-textfield__label" for="address">Address</label>
                			</div>
			        	</div>

						<div class="mdl-cell mdl-cell--12-col cell_con">
			       		 		<i class="material-icons">phone</i>
								
								<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
									<input class="mdl-textfield__input" type="text" id="phone" name="phone" value="'.$phone.'">
									<label class="mdl-textfield__label" for="phone">Phone Number</label>
			       				 </div>   
						</div>	

						<div class="mdl-cell mdl-cell--12-col cell_con">
							<i class="material-icons">work</i>
							
							<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
								<input class="mdl-textfield__input" type="text" id="college" name="college" value="'.$college.'">
								<label class="mdl-textfield__label" for="college">College or Institution</label>
								<span class="error">'.$collegeErr.'</span>
			        		</div>
			   				
			   			</div>

			   			<input type="hidden" name="sid" value="'.$id.'">
				
						<div class="mdl-cell mdl-cell--12-col  login-btn-con">
							<button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="eidtStudent()">Save</button>
						</div>	
					</form>
				</div>
			</div>';
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
    <title>Online Course Portal- Student Panel</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/materialdesignicons.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> 
    <script src="js/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript">
    	function postSignupStudent() {
    		var f=document.getElementById('editstudent');
    		if(f){
    			f.submit();
    		}
    	}
    </script>
</head>
<body>

	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
            <div class="mdl-layout__header-row portfolio-logo-row">
                <span class="mdl-layout__title">
                    <div class="portfolio-logo"></div>
                    <span class="mdl-layout__title">Course Portal - Student Panel</span>
                </span>
            </div>
            <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                    <a class="mdl-navigation__link" href="student.php">Dashboard</a>
                    <a class="mdl-navigation__link" href="student-courses.php">Registered Courses</a>
                    <a class="mdl-navigation__link is-active" href="student-edit.php">Edit Details</a>
                    <a class="mdl-navigation__link" href="about.php">About</a>
                </nav>
            </div>
        </header>
        

        <div class="demo-drawer mdl-layout__drawer mdl-color--grey-pink-900 mdl-color-text--grey-pink-50">
        <header class="demo-drawer-header"><center>
          <img src="img/admin-dp.png" class="dp_img"><br /><strong><?php echo $name; ?></strong>
          <div class="demo-avatar-dropdown">
            <span><?php echo $email; ?></span>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <li class="mdl-menu__item"><a class="mdl-navigation__link" href="logout.php">Logout</a></li>
            </ul>
          </div></center>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--grey-pink-800">
          <a class="mdl-navigation__link" href="student.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">home</i>Dashboard</a>
          <a class="mdl-navigation__link" href="student-courses.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">inbox</i>Registered Courses</a>
          <a class="mdl-navigation__link" href="student-edit.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">delete</i>Edit Details</a>
          <a class="mdl-navigation__link" href="about.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">report</i>About</a>
        </nav>
      	</div>

		<main class="mdl-layout__content">
			<div class="mdl-grid portfolio-max-width portfolio-contact">
				<?php echo $successMessage; echo $editForm; ?>

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
