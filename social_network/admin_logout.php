<?php

session_start();

$con=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

	$user=$_SESSION['a_email'];

session_destroy();

header("location:admin_login.php");
?>