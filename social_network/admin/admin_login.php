<?php
session_start();
include("includes/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<style>
		body{
			padding: 0;margin: 0;
			background:pink;
		}
		td,table{
			padding: 10px;
		}
		table{
			margin: auto;
		}
	</style>
</head>
<body>
	<form action="admin_login.php" method="post">
		<table align="center" bgcolor="skyblue" width="500">
			<tr align="center">
				<td colspan="3"><h1>Admin Login here</h1></td>
			</tr>
			<tr>
				<td align="center"><strong>Admin Email:</strong>
				</td>
				<td>
					<input type="email" name="email" placeholder="Enter email" />
				</td>
			</tr>
			<tr>
				<td align="center"><strong>Admin Password</strong></td>
				<td>
					<input type="password" name="pass" placeholder="Enter Password"/>
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td><input type="submit" name="admin_login" value="Admin Login" style="padding: 10px;box-sizing: border-box;"/></td>
			</tr>
		</table>
	</form>
	<?php
	include("includes/connection.php");
		if(isset($_POST['admin_login']))
		{
		$email=mysqli_real_escape_string($con,$_POST['email']);
		$pass=mysqli_real_escape_string($con,$_POST['pass']);

		$get_user="select * from admin where a_email='$email' AND a_pass='$pass'";
		$run_user=mysqli_query($con,$get_user);
		$check=mysqli_num_rows($run_user);

		if($check==1){
			$_SESSION['a_email']=$email;
			header('Location: index.php');
		}
		else
		{
			echo"<script>alert('email or password is not correct')</script>";
		}

	}
	?>
</body>
</html>