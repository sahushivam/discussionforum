<?php


$con=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

		$name=mysqli_real_escape_string($con,$_POST['u_name']);
		$pass=mysqli_real_escape_string($con,$_POST['u_pass']);
		$email=mysqli_real_escape_string($con,$_POST['u_email']);
		$country=mysqli_real_escape_string($con,$_POST['u_country']);
		$gender=mysqli_real_escape_string($con,$_POST['u_gender']);
		$b_day=mysqli_real_escape_string($con,$_POST['u_birthday']);
		$date=date("y-m-d");
		$status="unverified";
		$posts="No";
		$default="default.jpg";
		$get_email="select * from users where user_email='$email'";
		$run_email=mysqli_query($con,$get_email);
		$check=mysqli_num_rows($run_email);

		if($check==1)
		{
			echo "<h2>This e-mail is already registered</h2>";
			exit();
		}
		else
		{
			
			
			if(mysqli_query($con,"INSERT INTO `users`( `user_name`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_image`, `register_date`, `last_login`, `status`) VALUES ('$name','$pass','$email','$country','$gender','$default',NOW(),NOW(),'$status')"))
			{
				echo "<script>alert('Registration is successful')</script>";
				header('Location: home.php');

			}
			else{
				echo "query not inserted";
			}


		}

?>
