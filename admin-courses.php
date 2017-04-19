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
  
  $coursenameErr=$shortdErr=$longdErr=$coursename=$shortd=$longd=$successMessage=$course=$courseErr=$title=$titleErr=$body=$bodyErr="";

  $tab1_a=" is-active";
  $tab2_a=$tab3_a="";

  $flag=0;
  
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
    }elseif ($_POST['postC']=="postC") {
      $flag=0;
      $tab2_a="is-active";
      $tab1_a=$tab3_a="";
      if(empty($_POST["course"])) {
        $courseErr="Select a course first.";
        $flag=1;
      }
      else {
        $course = test_input($_POST['course']);
      }
      if(empty($_POST["title"])) {
        $titleErr="Title is required.";
        $flag=1;
      }
      else {
        $title = test_input($_POST['title']);
      }
      if(empty($_POST["body"])) {
        $bodyErr="Body is required.";
        $flag=1;
      }
      else {
        $body = test_input($_POST['body']);
      }

      $post_date = date("Y-m-d H:i:s");

      $result2 = mysqli_query($con,"SELECT * FROM `courses` WHERE courseName = '$course'") or die(mysql_error());
      if (mysqli_num_rows($result2)==1) {
        $row=mysqli_fetch_assoc($result2);
        $cid=$row["courseId"];
      }

      if($flag1==0) {
        $query = "INSERT into `contents` (cId, title, body, post_date) VALUES ($cid, '$title', '$body', '$post_date')";
        $result = mysqli_query($con,$query);
        if($result){
          $course=$courseErr=$title=$titleErr=$body=$bodyErr="";
          $successMessage='<div class="mdl-grid portfolio-max-width">
                     <div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp portfolio-card">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Success!</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        New content is successfully posted.
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
      function postContent()
      {
        f=document.getElementsById('postcontent');
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
          <a class="mdl-navigation__link" href="admin-students.php"><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">delete</i>Students</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">report</i>Spam</a>
        </nav>
      	</div>

		<main class="mdl-layout__content">
        <?php echo $successMessage; $successMessage=""; ?>
        <br />
        <div class="mdl-shadow--2dp">
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
              <div class="mdl-tabs__tab-bar">
                <a href="#tab-1" class="mdl-tabs__tab <?php echo $tab1_a; ?>">ADD NEW COURSE</a>
                <a href="#tab-2" class="mdl-tabs__tab <?php echo $tab2_a; ?>">POST CONTENT</a>
                <a href="#tab-3" class="mdl-tabs__tab <?php echo $tab3_a; ?>">DELETE COURSE</a>
              </div>

              <div class="mdl-tabs__panel is-active" id="tab-1">
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

              <div class="mdl-tabs__panel" id="tab-2">
                   <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="postcontent" id="postcontent">
                      <input type="hidden" name="postC" value="postC">

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
        

              <div class="mdl-cell mdl-cell--6-col cell_con">
                <i class="material-icons">person</i>
                
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="title" name="title" value="<?php echo $title; ?>">
                  <label class="mdl-textfield__label" for="title">Title</label>
                  <span class="error"><?php echo $titleErr; ?></span>
                    </div>
              </div>  

              
              <div class="mdl-cell mdl-cell--12-col cell_con">
              <i class="material-icons">home</i>
              
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" type="text" rows= "3" id="body" name="body" value="<?php echo $body; ?>"></textarea>
                <label class="mdl-textfield__label" for="longd">Body</label>
                <span class="error"><?php echo $bodyErr; ?></span>
                </div>
                </div>
        
              <div class="mdl-cell mdl-cell--6-col  login-btn-con">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="postcontent()">POST CONTENT</button>
              </div>
           
            </form></center>
            <br />

                </div>
              <div class="mdl-tabs__panel" id="tab-3">
                   <p>This is Tab 3</p>
                   <ul>
                      <li>Option 1</li>
                    <li>Option 2</li>
                      <li>Option 3</li>
                      <li>Option 4</li>
                      <li>Option 5</li>
                  </ul>
              </div>
            </div>
            </div>

			
					    				
	     <footer class="mdl-mini-footer">
                <div class="mdl-mini-footer__left-section">
                    <div class="mdl-logo">Simple portfolio website</div>
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
