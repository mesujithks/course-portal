<?php
require('db.php');
session_start();
$btn="Register";
$successMessage=$flag=$content="";
$uid=0;
$header='<header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
            <div class="mdl-layout__header-row portfolio-logo-row">
                <span class="mdl-layout__title">
                    <div class="portfolio-logo"></div>
                    <span class="mdl-layout__title">Online Course Portal</span>
                </span>
            </div>
            <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                    <a class="mdl-navigation__link is-active" href="index.php">Courses</a>
                    <a class="mdl-navigation__link" href="login.php">Login</a>
                    <a class="mdl-navigation__link" href="signup.php">SignUp</a>
                    <a class="mdl-navigation__link" href="about.php">About</a>
                </nav>
            </div>
        </header>
        <div class="mdl-layout__drawer mdl-layout--small-screen-only">
            <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                <a class="mdl-navigation__link is-active" href="index.html">Courses</a>
                <a class="mdl-navigation__link" href="login.php">Login</a>
                <a class="mdl-navigation__link" href="signup.php">SignUp</a>
                <a class="mdl-navigation__link" href="about.php">About</a>
            </nav>
        </div>';

if ($_SERVER["REQUEST_METHOD"]=="POST"){

    $user=$_REQUEST['uid'];
    $crs=$_REQUEST['cid'];

    if ($user==0) {
        header("Location: login.php");
    }elseif ($user==1) {
        header("Location: admin-courses.php?eid=".$crs);
    }else{
        $query = "INSERT into `courses_taken` (stdId, crsId) VALUES ($user,$crs)";
        $result = mysqli_query($con,$query);
        if($result){
            $flag="disabled";
            $btn="Registered";
            $content='&nbsp&nbsp&nbsp<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="content.php?id='.$crs.'">content</a>';
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



if(isset($_SESSION["username"])){
    $username=$_SESSION["username"];
    $query = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($con,$query) or die(mysql_error());
    if(mysqli_num_rows($result)==1){
        $row=$result->fetch_assoc();
        $email=$row["email"];
        $uid=$row["id"];
        if($row["type"]=="admin")
        {
            $btn="Edit";
            $uid=1;
            $header='<header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
            <div class="mdl-layout__header-row portfolio-logo-row">
                <span class="mdl-layout__title">
                    <div class="portfolio-logo"></div>
                    <span class="mdl-layout__title">Course Portal - Admin Panel</span>
                </span>
            </div>
            <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                    <a class="mdl-navigation__link is-active" href="admin.php">Dashboard</a>
                    <a class="mdl-navigation__link" href="admin-courses.php">Courses</a>
                    <a class="mdl-navigation__link" href="admin-students.php">Students</a>
                    <a class="mdl-navigation__link" href="contact.html">Contact</a>
                </nav>
            </div>
        </header>
        

        <div class="demo-drawer mdl-layout__drawer mdl-color--grey-pink-900 mdl-color-text--grey-pink-50">
        <header class="demo-drawer-header"><center>
          <img src="img/admin-dp.png" class="dp_img"><br /><strong>Admin</strong>
          <div class="demo-avatar-dropdown">
            <span>'.$email.'</span>
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
        </div>';
                
        }
        else if($row["type"]=="student")
        {   
            $c=isset($_REQUEST['id']) ? $_REQUEST['id'] : $_REQUEST['cid'];
            $query = "SELECT * FROM `students` WHERE studentId=$uid";
            $result = mysqli_query($con,$query) or die(mysql_error());
            if(mysqli_num_rows($result)==1){
                $row=$result->fetch_assoc();    
                $name=$row["fname"]." ".$row["lname"];
            }
            $query = "SELECT * FROM `courses_taken` WHERE stdId=$uid AND crsId=$c";
            $result = mysqli_query($con,$query) or die(mysql_error());
            if(mysqli_num_rows($result)==1){
                $flag="disabled";
                $btn="Registered";
                $content='&nbsp&nbsp&nbsp<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="content.php?id='.$c.'">content</a>';
            }

            $header='<header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
            <div class="mdl-layout__header-row portfolio-logo-row">
                <span class="mdl-layout__title">
                    <div class="portfolio-logo"></div>
                    <span class="mdl-layout__title">Course Portal - Student Panel</span>
                </span>
            </div>
            <div class="mdl-layout__header-row portfolio-navigation-row mdl-layout--large-screen-only">
                <nav class="mdl-navigation mdl-typography--body-1-force-preferred-font">
                    <a class="mdl-navigation__link is-active" href="student.php">Dashboard</a>
                    <a class="mdl-navigation__link" href="student-courses.php">Registered Courses</a>
                    <a class="mdl-navigation__link" href="student-edit.php">Edit Details</a>
                    <a class="mdl-navigation__link" href="contact.html">Contact</a>
                </nav>
            </div>
        </header>
        

        <div class="demo-drawer mdl-layout__drawer mdl-color--grey-pink-900 mdl-color-text--grey-pink-50">
        <header class="demo-drawer-header"><center>
          <img src="img/admin-dp.png" class="dp_img"><br /><strong>'.$name.'</strong>
          <div class="demo-avatar-dropdown">
            <span>'.$email.'</span>
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
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">report</i>Contact</a>
        </nav>
        </div>';   
        }
    }
        
}


if (isset($_REQUEST['id']) || isset($_REQUEST['cid'])){
    $cid=isset($_REQUEST['id']) ? $_REQUEST['id'] : $_REQUEST['cid'];
    
    $coure_details="";
    $sql = "SELECT * FROM `courses` WHERE courseId=$cid";
    $result1 = mysqli_query($con,$sql) or die(mysql_error());
    if (mysqli_num_rows($result1)==1) {
        $row=mysqli_fetch_assoc($result1);
        $coure_details='<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">'.$row["courseName"].'</h2>
                    </div>
                    <div class="mdl-card__media">
                        <img class="article-image" src="'.$row["courseImageL"].'" border="0" alt="">
                    </div>
                    <div class="mdl-card__supporting-text">
                        <form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'" method="post" name="register" id="register">
                        <input type="hidden" name="uid" value="'.$uid.'">
                        <input type="hidden" name="cid" value="'.$cid.'">
                        <div class="mdl-cell mdl-cell--12-col  login-btn-con">
                            <center><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn" onclick="register()" '.$flag.'>'.$btn.'</button>'.$content.'</center>
                        </div>
                        </form>
                        <p>'.$row["longD"].'</p>
                    </div>
                </div>';
  
    }

}



?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Course Portal- Home</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/material.min.css">
    <link rel="stylesheet" href="css/materialdesignicons.css" media="all" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"> 
    <script src="js/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script type="text/javascript">
        function register() {
            f=document.getElementsById('register');
            if (f) {
             f.submit();
            }
        }
    </script>

</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <?php echo $header; ?>
        
        <main class="mdl-layout__content">
            <div class="mdl-grid portfolio-max-width portfolio-contact">
                <?php echo $successMessage; echo $coure_details; ?>
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
            </footer></main>
    </div>
</body>

</html>
