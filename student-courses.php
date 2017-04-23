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

    $tableRow="";
    $query = "SELECT * FROM `courses_taken` WHERE stdId=$id";
    $result = mysqli_query($con,$query) or die(mysql_error());
    if (mysqli_num_rows($result)>0) {
        while ($row=mysqli_fetch_assoc($result)) {
            $cid=$row['crsId'];
            $sql = "SELECT * FROM `courses` WHERE courseId=$cid";
            $result1 = mysqli_query($con,$sql) or die(mysql_error());
            if (mysqli_num_rows($result1)==1) {
                $row1=mysqli_fetch_assoc($result1);
                $crsName=$row1['courseName'];
            }
 
            $tableRow.='<tr><td class="mdl-data-table__cell--non-numeric">'.$crsName.'</td>
                                <td>
                                    <div class="mdl-cell mdl-cell--12-col  login-btn-con">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--accent" href="content.php?id='.$cid.'">Content</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="mdl-cell mdl-cell--12-col  login-btn-con">
                                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect mdl-button--primary" href="course.php?id='.$cid.'">Details</a>
                                    </div>
                                </td></tr>';
        }
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
        function content() {
            f=document.getElementsById('content');
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
                    <a class="mdl-navigation__link" href="student.php">Dashboard</a>
                    <a class="mdl-navigation__link is-active" href="student-courses.php">Registered Courses</a>
                    <a class="mdl-navigation__link" href="student-edit.php">Edit Details</a>
                    <a class="mdl-navigation__link" href="contact.html">Contact</a>
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
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--grey-pink-400 material-icons" role="presentation">report</i>Contact</a>
        </nav>
      	</div>

		<main class="mdl-layout__content">
            <div class="mdl-grid portfolio-max-width portfolio-contact">
			<center>
            <table class="mdl-data-table mdl-js-data-table  mdl-shadow--2dp">
                        <thead>
                            <tr>
                              <th class="mdl-data-table__cell--non-numeric">Course</th>
                              <th></th>
                              <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php echo $tableRow; ?>
                        </tbody>
                    </table></center>
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