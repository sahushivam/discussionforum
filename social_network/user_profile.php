<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email'])){
	header("location:index.php");
}
else
{
	?>
<!DOCTYPE html>

<html>
	<head>
		<title>Welcome User</title>
		<link rel="stylesheet" href="home_style.css" media="all">
	</head>

	<body>
		
		<!--container start--> 
		<div class ="container">
			<!--head_wrap start--> 
			<div id ="head_wrap">
				<!--header start--> 
				<div id="header">
					<ul id="menu">
						<li><a href="home.php">Home</a></li>
						<li><a href="members.php">Members</a></li>
						<strong>Topics:</strong>
						<?php
						 $get_topics="select * from topics";
						$run_topics=mysqli_query($con,$get_topics);

						while($row=mysqli_fetch_array($run_topics))
						{
							$topic_id=$row['topic_id'];
							$topic_title=$row['topic_title'];

						echo "<li><a href='topic.php?topic=$topic_id' >$topic_title</a></li> ";

						}
						?>
					</ul>
					<form method="get" action="results.php" id="form1">
						<input type="text" name="user_query" placeholder="Search a topic"/>
						<input type="submit" name="Search" value="Search"/>
					</form>
 				</div>
				<!--header ends--> 
			</div>
			<!--content starts-->
			<div class="content">
				<!--user timeline starts-->

				<div id="user_timeline">
					<div id="user_details">
						<?php
						$user=$_SESSION['user_email'];
						$get_user="select * from users where user_email='$user'";
						$run_user=mysqli_query($con,$get_user);
						$row=mysqli_fetch_array($run_user);

						$user_id=$row['user_id'];
						$user_name=$row['user_name'];
						$user_country=$row['user_country'];
						$user_image=$row['user_image'];
						$register_date=$row['register_date'];
						$last_login=$row['last_login'];

						$user_posts="select * from post where user_id='$user_id'";
						
						$run_posts=mysqli_query($con,$user_posts);
						if(mysqli_query($con,$user_posts))
						{
						$posts=mysqli_num_rows($run_posts);
					}
				$sel_msg="select * from messages where reciever='$user_id' and status='unread' ORDER by 1 DESC";
					$run_msg=mysqli_query($con,$sel_msg);
					
					$count_msg=mysqli_num_rows($run_msg);
					$row_msg=mysqli_fetch_array($run_msg);

						echo"
							
						<center><img src='user/user_images/$user_image' width='200' height='200' alt=$user_image/></center>

						<div id='user_mention'>
						<p><strong>Name</strong> $user_name</p>
						<p><strong>Country </strong>$user_country</p>
						<p><strong>Last Login </strong>$last_login</p>
						<p><strong>Member Since </strong>$register_date</p>
 
						<p><a href='my_messages.php?inbox&u_id=$user_id'> Messages($count_msg)</a></p>
						<p><a href='my_posts.php?u_id=$user_id' >My Posts ($posts)</a></p>
						<p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
						<p><a href='logout.php'>Logout</a></p>
						</div>
						";
						?>
					</div>
				</div>
				<!--user timeline ends-->
				<!--user timeline ends-->
				<!--content timeline starts-->
				<div id ="content_timeline">
					
					
						<h2 align="center">Info about this User: </h2>
		
						<?php user_profile();?>
					
				</div>
				<!--content timeline ends-->
			</div>
			<!--content ends-->
			<!--head_wrap ends--> 
		</div>
		<!--container ends--> 
	</body>
</html>
<?php } ?>