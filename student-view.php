<?php
include("auth.php"); 
require('db.php');
$username=$_SESSION["username"];
$query = "SELECT * FROM `users` WHERE username='$username'";
$result = mysqli_query($con,$query) or die(mysql_error());
$rows = mysqli_num_rows($result);
if($rows==1){
	$row=$result->fetch_assoc();
	$email=$row["email"];
	}
  if (isset($_REQUEST["id"])) {
   $sid=$_REQUEST["id"];
  
  $couse_list="";

  $query="SELECT * FROM students,users WHERE students.studentId=$sid AND users.id=$sid";
$student_details="";
$i=1;

$result = mysqli_query($con,"SELECT courses.courseName FROM courses_taken,courses WHERE courses_taken.stdId=$sid AND courses.courseId=courses_taken.crsId") or die(mysql_error());
if (mysqli_num_rows($result)>0) {
  while ($row=mysqli_fetch_assoc($result)) {
    $couse_list.=$i.". ".$row["courseName"].'<br /><br />';
    $i++;
  }

}

$result = mysqli_query($con,$query) or die(mysql_error());
if (mysqli_num_rows($result)==1) {
  $row=mysqli_fetch_assoc($result);
  $student_details='<strong>Name : </strong>'.$row["fname"]." ".$row["lname"].'<br /><br />
                <strong>Birth Date : </strong>'.$row["dob"].'<br /><br />
                <strong>Gender : </strong>'.$row["gender"].'<br /><br />
                <strong>Email : </strong>'.$row["email"].'<br /><br />
                <strong>Address : </strong>'.$row["address"].'<br /><br />
                <strong>Phone : </strong>'.$row["phone"].'<br /><br />
                <strong>College : </strong>'.$row["college"].'<br /><br />
                <h6><strong>Courses Selected</strong></h6>';
  
  $student_details.=$couse_list;
} 
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Course Portal- Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/materialdesignicons.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> 
    <script src="js/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>

	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
            <div class="mdl-layout__header-row portfolio-logo-row">
                <span class="mdl-layout__title">
                    <div class="portfolio-logo"></div>
                    <span class="mdl-layout__title">Course Portal - Admin Panel</span>
                </span>
            </div>
            <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                    <a class="mdl-navigation__link" href="admin.php">Dashboard</a>
                    <a class="mdl-navigation__link" href="admin-courses.php">Courses</a>
                    <a class="mdl-navigation__link" href="admin-contents.php">Contents</a>
                    <a class="mdl-navigation__link is-active" href="admin-students.php">Students</a>
                    <a class="mdl-navigation__link" href="about.php">boutA</a>
                </nav>
            </div>
        </header>
        

        <div class="demo-drawer mdl-layout__drawer mdl-color--grey-pink-900 mdl-color-text--grey-pink-50">
        <header class="demo-drawer-header"><center>
          <img src="img/admin-dp.png" class="dp_img"><br /><strong>Admin</strong>
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
          <a class="mdl-navigation__link" href="admin.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">home</i>Dashboard</a>
          <a class="mdl-navigation__link" href="admin-courses.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">inbox</i>Courses</a>
          <a class="mdl-navigation__link" href="admin-contents.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">inbox</i>Contents</a>
          <a class="mdl-navigation__link" href="admin-students.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">delete</i>Students</a>
          <a class="mdl-navigation__link" href="about.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">report</i>About</a>
        </nav>
      	</div>

		<main class="mdl-layout__content">
      <div class="mdl-grid portfolio-max-width portfolio-contact">
			   <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
              <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Student Deatils</h2>
              </div>
              <center><div class="mdl-cell mdl-cell--12-col  login-btn-con">
                          <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="admin-students.php?id=<?php echo $sid; ?>"><strong>Delete</strong></a>
                      </div></center>
              
              <div class="mdl-card__supporting-text">
             
                <?php echo $student_details; ?>

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
