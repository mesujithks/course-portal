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


$list="";
$sql = "SELECT * FROM `courses`";
$result1 = mysqli_query($con,$sql) or die(mysql_error());
if (mysqli_num_rows($result1)>0) {
  while ($row=mysqli_fetch_assoc($result1)) {
    $list.='<li class="mdl-menu__item">'.$row["courseName"]."</li>";
}
  
  } 
  
  $coursenameErr=$shortdErr=$longdErr=$coursename=$shortd=$longd=$successMessage=$course=$courseErr=$shortde=$shortdeErr=$longde=$longdeErr=$courses=$coursesErr="";

  $tab1_a=" is-active";
  $tab2_a=$tab3_a="";
  $editF="";
  $b=$btNm="select";

  $flag=$e=0;
  $t=1;

  if (isset($_REQUEST["eid"])) {
    $tab2_a=" is-active";
    $tab1_a=$tab3_a="";
    $e=1;
    $cide=$_REQUEST['eid'];
    $query="SELECT * FROM `courses` WHERE courseId = $cide";

    $result = mysqli_query($con,$query) or die(mysql_error());
  
    if (mysqli_num_rows($result)==1) {
      $row=mysqli_fetch_assoc($result);
        $course=$row["courseName"];
        $shortde=$row['shortD'];
        $longde=$row['longD'];
        $b=$btNm="save";
    
        $editF='<div class="mdl-cell mdl-cell--6-col cell_con">
                <i class="material-icons">lock</i>
              
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="shortd" name="shortd" value="'.$shortde.'">
                  <label class="mdl-textfield__label" for="shortd">Enter a Short Description</label>
                  <span class="error">'.$shortdeErr.'</span>
                    </div>
              </div>

              <div class="mdl-cell mdl-cell--12-col cell_con">
              <i class="material-icons">home</i>
              
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" rows= "3" id="longd" name="longd" value="'.$longde.'"></input>
                <label class="mdl-textfield__label" for="longd">Long Description</label>
                <span class="error">'.$longdeErr.'</span>
                </div>
                </div>';

    }else echo mysqli_error($con);

    
  }
  
   if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if ($_POST['addC']=="addC") {

      if(empty($_POST["coursename"])) {
        $coursenameErr="Course name is required.";
        $flag=1;
      }
      else {
        $coursename = test_input($_POST['coursename']);
      }
      if(empty($_POST["shortd"])) {
        $shortdErr="Short description is required.";
        $flag=1;
      }
      else {
        $shortd = test_input($_POST['shortd']);
      }
      if(empty($_POST["longd"])) {
        $longdErr="Long description is required.";
        $flag=1;
      }
      else {
        $longd = test_input($_POST['longd']);
      }
      
      if($flag==0) {
        $query = "INSERT into `courses` (courseName, shortD, longD) VALUES ('$coursename', '$shortd', '$longd')";
        $result = mysqli_query($con,$query);
        if($result){
          $coursenameErr=$shortdErr=$longdErr=$coursename=$shortd=$longd=$successMessage="";
          $successMessage='<div class="mdl-grid portfolio-max-width">
                     <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp portfolio-card">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Success!</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        New course is successfully created.
                    </div>
                </div></div>';
        }
      }
    }elseif ($_POST['editC']=="editC") {
      $flag=0;
      $tab2_a="is-active";
      $tab1_a=$tab3_a="";

      
        if(empty($_POST["shortd"])) {
          if ($_POST['choice']=="save") {
        $shortdeErr="Short description is required.";}
        $flag=1;
        }
        else {
          $shortde = test_input($_POST['shortd']);
        }
      

      
        if(empty($_POST["longd"])) {
          if ($_POST['choice']=="save") {
           $longdeErr="Long description is required.";}
         $flag=1;
       }
        else {
         $longde = test_input($_POST['longd']);
        }
      
      
      if(empty($_POST["course"])) {
        $courseErr="Select a course first.";
        $flag=1;
      }
      else {
        $course = test_input($_POST['course']);
        $result = mysqli_query($con,"SELECT * FROM `courses` WHERE courseName = '$course'") or die(mysql_error());
      if (mysqli_num_rows($result)==1) {
        $row=mysqli_fetch_assoc($result);
        $cid=$row["courseId"];
        if(test_input($_POST['choice'])!="save"){
        $shortde=$row['shortD'];
        $longde=$row['longD'];}

      }
        $b=$btNm="save";
        $editF='<div class="mdl-cell mdl-cell--6-col cell_con">
                <i class="material-icons">lock</i>
              
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="shortd" name="shortd" value="'.$shortde.'">
                  <label class="mdl-textfield__label" for="shortd">Enter a Short Description</label>
                  <span class="error">'.$shortdeErr.'</span>
                    </div>
              </div>

              <div class="mdl-cell mdl-cell--12-col cell_con">
              <i class="material-icons">home</i>
              
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" rows= "3" id="longd" name="longd" value="'.$longde.'"></input>
                <label class="mdl-textfield__label" for="longd">Long Description</label>
                <span class="error">'.$longdeErr.'</span>
                </div>
                </div>';
      }

      

      if($flag==0) {
        $query = "UPDATE `courses` SET courseName='$course', shortD='$shortde', longD='$longde' WHERE courseId=$cid";
        $result = mysqli_query($con,$query);
        if($result){
          $course=$courseErr=$shortde=$shortdeErr=$longde=$longdeErr="";
          $edit=$editF;
          $successMessage='<div class="mdl-grid portfolio-max-width">
                     <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp portfolio-card">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Success!</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Course is successfully updated.
                    </div>
                </div></div>';
            $editF="";
            $b=$btNm="select";
        }
      }
    }elseif ($_POST['deleteC']=="deleteC") {
      $flag=0;
      $tab3_a="is-active";
      $tab1_a=$tab2_a="";
      if(empty($_POST["courses"])) {
        $coursesErr="Select a course first.";
        $flag=1;
      }
      else {
        $courses = test_input($_POST['courses']);
      }

      $result2 = mysqli_query($con,"SELECT * FROM `courses` WHERE courseName = '$courses'") or die(mysql_error());
      if (mysqli_num_rows($result2)==1) {
        $row=mysqli_fetch_assoc($result2);
         $cid=$row["courseId"];     
      }
      
      if($flag==0) {
        $query = "DELETE FROM `courses` WHERE `courses`.`courseId` = $cid";
        echo $query;
        $result = mysqli_query($con,$query);
        if($result){
          $courses=$coursesErr="";
          $successMessage='<div class="mdl-grid portfolio-max-width">
                     <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp portfolio-card">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Success!</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Course is successfully deleted.
                    </div>
                </div></div>';
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
    <title>Online Course Portal- Admin Panel</title>
    <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/getmdl-select.min.css">
   <script src="js/getmdl-select.min.js"></script>
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/materialdesignicons.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> 
    <script src="js/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript">
      function postCourse()
      {
        f=document.getElementsById('addcourse');
        if (f) {
          f.submit();
        }
      }
      function editCourse()
      {
        f=document.getElementsById('editcourse');
        if (f) {
          f.submit();
        }
      }

      function deleteCourse()
      {
        f=document.getElementsById('deletecourse');
        if (f) {
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
                    <span class="mdl-layout__title">Course Portal - Admin Panel</span>
                </span>
            </div>
            <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                    <a class="mdl-navigation__link" href="admin.php">Dashboard</a>
                    <a class="mdl-navigation__link is-active" href="admin-courses.php">Courses</a>
                    <a class="mdl-navigation__link" href="admin-contents.php">Contents</a>
                    <a class="mdl-navigation__link" href="admin-students.php">Students</a>
                    <a class="mdl-navigation__link" href="contact.html">Contact</a>
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
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">report</i>Spam</a>
        </nav>
      	</div>

		<main class="mdl-layout__content">
        <?php echo $successMessage; $successMessage="";  ?>
        <br />
        <div class="mdl-shadow--2dp">
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
              <div class="mdl-tabs__tab-bar">
                <a href="#tab-1" class="mdl-tabs__tab <?php echo $tab1_a; ?>">ADD NEW COURSE</a>
                <a href="#tab-2" class="mdl-tabs__tab <?php echo $tab2_a; ?>">EDIT COURSE</a>
                <a href="#tab-3" class="mdl-tabs__tab <?php echo $tab3_a; ?>">DELETE COURSE</a>
              </div>

              <div class="mdl-tabs__panel <?php echo $tab1_a; ?>" id="tab-1">
                  <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="addcourse" id="addcourse">
                      <input type="hidden" name="addC" value="addC">
              <div class="mdl-cell mdl-cell--6-col cell_con">
                <i class="material-icons">person</i>
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="coursename" name="coursename" value="<?php echo $coursename; ?>">
                  <label class="mdl-textfield__label" for="coursename">Enter Course Name</label>
                  <span class="error"><?php echo $coursenameErr; ?></span>
                    </div>
              </div>  

              <div class="mdl-cell mdl-cell--6-col cell_con">
                <i class="material-icons">lock</i>
              
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="shortd" name="shortd" value="<?php echo $shortd; ?>">
                  <label class="mdl-textfield__label" for="shortd">Enter a Short Description</label>
                  <span class="error"><?php echo $shortdErr; ?></span>
                    </div>
              </div>

              <div class="mdl-cell mdl-cell--12-col cell_con">
              <i class="material-icons">home</i>
              
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" type="text" rows= "3" id="longd" name="longd" value="<?php echo $longd; ?>"></textarea>
                <label class="mdl-textfield__label" for="longd">Long Description</label>
                <span class="error"><?php echo $longdErr; ?></span>
                </div>
                </div>
        
              <div class="mdl-cell mdl-cell--6-col  login-btn-con">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="postCourse()">ADD COURSE</button>
              </div>
           
            </form></center>
            <br />
              </div>

              <div class="mdl-tabs__panel <?php echo $tab2_a; ?>" id="tab-2">
                <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="editcourse" id="editcourse">
                      <input type="hidden" name="editC" value="editC">
                  <div class="mdl-cell mdl-cell--6-col cell_con">
                <i class="material-icons">person</i>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                  <input class="mdl-textfield__input" value="<?php echo $course ?>" type="text" id="course" name="course" readonly tabIndex="-1" />
                    <label class="mdl-textfield__label" for="course">Course</label>
                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="course">
                      <?php echo $list; ?>
                    </ul>
                    <span class="error"><?php echo $courseErr; ?></span>
                </div>
              </div> 

              <?php echo $editF; ?>
              <input type="hidden" name="choice" value="<?php echo $b; ?>">
        
              <div class="mdl-cell mdl-cell--6-col  login-btn-con">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="editCourse()"><?php echo $btNm; ?></button>
              </div>
           
            </form></center>
                   
            <br />

                </div>
              <div class="mdl-tabs__panel <?php echo $tab3_a; ?>" id="tab-3">
                   <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="deletecourse" id="deletecourse">
                      <input type="hidden" name="deleteC" value="deleteC">
                      

                <div class="mdl-cell mdl-cell--6-col cell_con">
                <i class="material-icons">person</i>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                  <input class="mdl-textfield__input" value="<?php echo $courses ?>" type="text" id="courses" name="courses" readonly tabIndex="-1" />
                    <label class="mdl-textfield__label" for="courses">Course</label>
                    <ul class="mdl-menu mdl-menu--bottom-left mdl-js-menu" for="courses">
                      <?php echo $list; ?>
                    </ul>
                    <span class="error"><?php echo $coursesErr; ?></span>
                </div>
              </div>
              <div class="mdl-cell mdl-cell--6-col  login-btn-con">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="deleteCourse()">DELETE COURSE</button>
              </div>
           
            </form></center>
            <br />
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
      </footer>
			    	</main>
	</div>
						   					
</body>

</html>
