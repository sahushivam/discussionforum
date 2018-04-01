<?php
session_start();
include("../includes/connection.php");
include("../functions/functions.php");
if(!isset($_SESSION['a_email'])){
	header("location:admin_login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome to Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="indexadmin.css" media="all">
</head>
<body>
	<div class="container">
		<div id="head">
			<img src="logo.jpg" height="100" />
		</div>
		<div id="content">
		<?php
			include("includes/view_users.php");
		?>
	</div>
		<div id="sidebar">
		<h2>Manage Content</h2>
		<ul id="menu">
			<li><a href="index.php?view_users">View Users</a></li>
			<li><a href="adduser">Add Users</a></li>
			<li><a href="admin_logout.php">Admin Logout</a></li>
			</li>
		</ul>
	</div>
		<div id="foot"
			<h2 style="color: white;padding: 10px; text-align: center;">
			Copyights 2017 by sahushivam.ml
		</h2>
	</div>
	</div>
	
</body>
</html>