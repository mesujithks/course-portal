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
  
  $successMessage=$course=$courseErr=$title=$titleErr=$body=$bodyErr="";

  $tab1_a=" is-active";
  $tab2_a=$tab3_a="";
  $editF="";
  $btNm="select";

  $flag=0;
  $t=1;
  
   if ($_SERVER["REQUEST_METHOD"]=="POST"){
    if ($_POST['addC']=="addC") {

      if(empty($_POST["course"])) {
        $courseErr="First select a course.";
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

      $result = mysqli_query($con,"SELECT * FROM `courses` WHERE courseName = '$course'") or die(mysql_error());
      if (mysqli_num_rows($result)==1) {
        $row=mysqli_fetch_assoc($result);
        $cid=$row["courseId"];
      }

      $trn_date = date("Y-m-d H:i:s");
      
      if($flag==0) {
        $query = "INSERT into `contents` (cId, title, body, post_date) VALUES ($cid, '$title', '$body', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
          $course=$courseErr=$title=$titleErr=$body=$bodyErr="";
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

      
        if(empty($_POST["titlee"])) {
          if ($_POST['choice']=="save") {
        $titleeErr="Title is required.";}
        $flag=1;
        }
        else {
          $titlee = test_input($_POST['titlee']);
        }
      

      
        if(empty($_POST["bodye"])) {
          if ($_POST['choice']=="save") {
           $bodyeErr="Body is required.";}
         $flag=1;
       }
        else {
         $bodye = test_input($_POST['bodye']);
        }
      
      
      if(empty($_POST["scourse"])) {
        $courseeErr="Select a course first.";
        $flag=1;
      }
      else {
        $coursee = test_input($_POST['scourse']);
      }
      if(empty($_POST['stitle'])){
        $stitleErr="Select a course first.";
        $flag=1;
      }
      else{
        $stitle = test_input($_POST['stitle']);
        $result = mysqli_query($con,"SELECT * FROM `courses` WHERE courseName = '$course'") or die(mysql_error());
        if (mysqli_num_rows($result)==1) {
        $row=mysqli_fetch_assoc($result);
        $cid=$row["courseId"];
        }

        $result = mysqli_query($con,"SELECT * FROM `contents` WHERE cId = $cid AND title = '$stitle'") or die(mysql_error());
        if (mysqli_num_rows($result)==1) {
        $row=mysqli_fetch_assoc($result);
        if(test_input($_POST['choice'])!="save"){
        $bodye=$row["body"];}
        }


        $btNm="save";
        $editF='<div class="mdl-cell mdl-cell--12-col cell_con">
                <i class="material-icons">person</i>
              
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" rows= "3" id="titlee" name="bodye" value="'.$titlee.'"></input>
                <label class="mdl-textfield__label" for="longd">Title</label>
                <span class="error">'.$titleeErr.'</span>
                </div>
              </div>

              <div class="mdl-cell mdl-cell--12-col cell_con">
                <i class="material-icons">home</i>
              
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" rows= "3" id="bodye" name="bodye" value="'.$bodye.'"></input>
                <label class="mdl-textfield__label" for="longd">Body</label>
                <span class="error">'.$bodyeErr.'</span>
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
                    <a class="mdl-navigation__link" href="admin-courses.php">Courses</a>
                    <a class="mdl-navigation__link is-active" href="admin-contents.php">Contents</a>
                    <a class="mdl-navigation__link" href="admin-students.php">Students</a>
                    <a class="mdl-navigation__link" href="about.php">About</a>
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
        <?php echo $successMessage; $successMessage="";  ?>
        <br />
        <div class="mdl-shadow--2dp">
            <div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
              <div class="mdl-tabs__tab-bar">
                <a href="#tab-1" class="mdl-tabs__tab <?php echo $tab1_a; ?>">ADD NEW CONTENT</a>
              </div>
              <div class="mdl-tabs__panel <?php echo $tab1_a; ?>" id="tab-1">
                  <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" name="addcourse" id="addcourse">
                      <input type="hidden" name="addC" value="addC">
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
                <i class="material-icons">lock</i>
              
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
                <label class="mdl-textfield__label" for="body">Body</label>
                <span class="error"><?php echo $bodyErr; ?></span>
                </div>
                </div>
        
              <div class="mdl-cell mdl-cell--6-col  login-btn-con">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="postCourse()">ADD CONTENT</button>
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
