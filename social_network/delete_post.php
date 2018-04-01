<?php

 $con=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
if(isset($_GET['post_id']))
			{
				$post_id=$_GET['post_id'];
				$get_posts1="select * from post where post_id='$post_id'";
				$run_posts1 = mysqli_query($con,$get_posts1);
				$row=mysqli_fetch_array($run_posts1);
				if($row)
				{
				$user_id1=$row['user_id'];
			}
				$delete_post ="delete from post where post_id='$post_id'";
				$run_delete=mysqli_query($con,$delete_post);

				if($run_delete)
				{
					echo"<script>alert('A post has been deleted')</script>";
					header("location: my_posts.php?u_id=$user_id1");

				}

			}

?>