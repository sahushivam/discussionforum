<?php
		include("includes/connection.php");
		if(isset($_POST['Login']))
		{
		$email=mysqli_real_escape_string($con,$_POST['uemail']);
		$pass=mysqli_real_escape_string($con,$_POST['upass']);
		echo $email.$pass;

		$get_user="select * from users where user_email='$email' AND user_pass='$pass'";
		$run_user=mysqli_query($con,$get_user);
		$check=mysqli_num_rows($run_user);

		if($check==1){
			$_SESSION['user_email']=$email;
			header('Location: home.php');
		}
		else
		{
			echo"<script>alert('email is not correct')</script>";
		}

	}
?>