<?php
require('db.php');
session_start();
if(!isset($_SESSION["username"])){
	if(basename($_SERVER['PHP_SELF'])=="index.php" || basename($_SERVER['PHP_SELF'])=="signup.php") {
		echo "user is not loggedin";	
	}
	else {
		header("Location: login.php");
		exit();	
	}
 }
else {
		$username=$_SESSION["username"];
		$query = "SELECT * FROM `users` WHERE username='$username'";
		$result = mysqli_query($con,$query) or die(mysql_error());
		$rows = mysqli_num_rows($result);
        if($rows==1){
			$row=$result->fetch_assoc();
			if($row["type"]=="admin" && basename($_SERVER['PHP_SELF'])!="admin.php")
			{
				header("Location: admin.php"); 
				
			}
			else if($row["type"]=="student")
			{
				echo "student loggedin";
			}
		}
		else {
			echo mysqli_error();
			}
}
?>