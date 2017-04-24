<?php
include("auth.php"); 

    $username=$_SESSION["username"];
    $query = "SELECT * FROM `users`,`students` WHERE username='$username' AND studentId=id";
    $result = mysqli_query($con,$query) or die(mysql_error());
    $rows = mysqli_num_rows($result);
    if($rows==1){
        $row=$result->fetch_assoc();            
        $id=$row["id"];
        $email=$row["email"];   
        $name=$row["fname"]." ".$row["lname"];
    }
    
    if (isset($_REQUEST['id'])){
    $cid=$_REQUEST['id'];

    $cname="";
    $coure_contents="";
    $sql = "SELECT * FROM `contents`,`courses` WHERE cId=$cid AND courseId=cId ORDER BY post_date DESC";
    $result1 = mysqli_query($con,$sql) or die(mysql_error());
    if (mysqli_num_rows($result1)>0) {
        while ($row=mysqli_fetch_assoc($result1)){
            $coure_contents.='<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">'.$row["title"].'</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <span>'.$row["post_date"].'</span>
                        <p>'.$row["body"].'</p>
                    </div>
                </div>';
            $cname=$row["courseName"];
            }
  
    }
    else $coure_contents='<div class="mdl-cell mdl-cell--12-col mdl-card mdl-shadow--4dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Conents Unavailable</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        <p>Currently no conents is posted for this course.</p>
                    </div>
                </div>';

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
        <header class="mdl-layout__header mdl-layout__header--waterfall portfolio-header">
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
                <center><h5><?php echo $cname; ?></h5></center>
                <?php echo $coure_contents; ?>
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