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
		<div id="sidebar">
		<h2>Manage Content</h2>
		<ul id="menu">
			<li><a href="index.php?view_users">View Users</a></li>
			<li><a href="adduser">Add Users</a></li>
			<li><a href="admin_logout.php">Admin Logout</a></li>
			</li>
		</ul>
	</div>
		<div id="content">
		<div id ="form2">
		<form action="../user_insert.php" method="post">
			<table style="box-sizing: border-box;color: brown;" >
				<tr">
					<td align="right">Name:</td>
					<td>
					<input type="text" placeholder="Enter your name" required="required" />
					</td>
				</tr>
				<tr>
					<td align="right">Pasword:</td>
					<td>
					<input type="password" name="u_pass" placeholder="Enter your password" required="required" />
					</td>
				</tr>
				<tr>
					<td align="right">Email:</td>
					<td>
					<input type="email" name="u_email" placeholder="Enter your email" required="required" />
					</td>
				</tr>
				<tr>
					<td align="right">Country:</td>
					<td>
					<select name="u_country">
							<option>Select a Country</option>
							<option>Afgansitan</option>
							<option>India</option>
							<option>Pakistan</option>
							<option>United States</option>
							<option>UAE</option>
						</select>
				</td>
				</tr>
					<td align="right">Gender:</td>
					<td>
						<select name="u_gender">
							<option>Gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</td>
				<tr>
					<td align="right">Birthday</td>
					<td>
					<input type="date" name="u_birthday">
					</td>
				</tr>
				
				<tr >
					<td></td>
					<td>
					<button name="sign_up">Sign Up</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
			</div>
	
</body>
</html>
