<?php

session_start();

$con=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

	$user=$_SESSION['user_email'];
$update="update users set last_login=NOW() where user_email='$user'";	
$run_user=mysqli_query($con,$update);
	$row=mysqli_fetch_array($run_user);
	



 
$run =mysqli_query($con,$update);


session_destroy();

header("location:index.php");