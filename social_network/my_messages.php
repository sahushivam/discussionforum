<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");
if(!isset($_SESSION['user_email'])){
	header("location:indexpage.php");
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
			<!--head wrap ends-->
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
					$sel_msg="select * from messages where reciever='$user_id' AND status='unread' ORDER by 1 DESC";
					$run_msg=mysqli_query($con,$sel_msg);
					
					$count_msg=mysqli_num_rows($run_msg);

						echo"
							
						<center><img src='user/user_images/$user_image' width='200' height='200' alt=$user_image/></center>

						<div id='user_mention'>
						<p><strong>Name</strong> $user_name</p>
						<p><strong>Country </strong>$user_country</p>
						<p><strong>Last Login </strong>$last_login</p>
						<p><strong>Member Since </strong>$register_date</p>
 
						<p><a href='my_messages.php?u_id=$user_id'> Messages ($count_msg)</a></p>
						<p><a href='my_posts.php?u_id=$user_id' >My Posts ($posts)</a></p>
						<p><a href='edit_profile.php?u_id=$user_id'>Edit My Account</a></p>
						<p><a href='logout.php'>Logout</a></p>
						</div>
						";
						?>
					</div>
				</div>
				<!--user timeline ends-->
				<!--content timeline starts-->
				<div id ="msg">
					
			
				<?php

							if(isset($_GET['u_id'])){
							$u_id=$_GET['u_id'];
							


							$select="select * from users where user_id='$u_id'";


							$run = mysqli_query($con,$select);
							$row2 = mysqli_fetch_array($run);

							$image=$row2['user_image'];
							$name=$row2['user_name'];
							$register_date=$row2['register_date'];
}


				?>

			<p align="center">
				<a href="my_messages.php?inbox">My Inbox</a>  || 
				<a href="my_messages.php?sent">Sent Items</a>
			</p>	
			<?php
			if(isset($_GET['sent'])){
				include("sent.php");
			}
			?>

			<?php if(isset($_GET['inbox']))	{?>
			<table width="700">
				<tr>
					<th>Sender </th>
					<th>Subject</th>
					<th>DAte</th>
					<th>Reply</th>
					</tr>
				<?php
					$sel_msg="select * from messages where reciever='$user_id' ORDER by 1 DESC";
					$run_msg=mysqli_query($con,$sel_msg);
					
					$count_msg=mysqli_num_rows($run_msg);
					$row_msg=mysqli_fetch_array($run_msg);

					$count=1;
					while($count<=$count_msg)
					{
						$count=$count+1;
						$msg_id=$row_msg['msg_id'];
						$msg_sender=$row_msg['sender'];
						$msg_sub=$row_msg['msg_sub'];
						$msg_topic=$row_msg['msg_topic'];
						$msg_date=$row_msg['msg_date'];

						//$get_sender="select * from users where user_id='$msg_sender'";
						//$run_sender=mysqli_query($con,$get_sender);
						//$row=mysqli_fetch_array($run_sender);
						//$sender_name=$row['user_name'];


			
			$run_user =mysqli_query($con, "select * from users where user_id='$msg_sender' order by 1 DESC ");
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
					$row_msg=mysqli_fetch_array($run_msg);	
					
					
				
				  
					
					echo "<tr align='center'>
						<td><a href='user_profile.php?u_id=$msg_sender'/>$user_name</td>
						<td><a href='my_messages.php?msg_id=$msg_id'/>$msg_sub</td>
						<td>$msg_date</td>
						<td><a href='my_messages.php?msg_id=$msg_id '/>Reply</td>


					</tr>";
				}
			}
				?>
						</table>

						<?php
						if(isset($_GET['msg_id'])){

							$get_id=$_GET['msg_id'];
							$sel_message="select * from messages where msg_id='$get_id'";
							$run_message=mysqli_query($con,$sel_message);
							$row_message=mysqli_fetch_array($run_message);

							$msg_subject=$row_message['msg_sub'];
							$msg_sender=$row_message['sender'];
							$msg_topic=$row_message['msg_topic'];
							$msg_date=$row_message['msg_date'];
							$reply_content=$row_message['reply'];
							$update_unread="update messages set status='read' where msg_id='$get_id'";
							$run_unread=mysqli_query($con,$update_unread);
							$run_user =mysqli_query($con, "select * from users where user_id='$msg_sender'");
							$row_user=mysqli_fetch_array($run_user);
							$sender_name=$row_user['user_name'];

							echo"<center><br/><hr>
							<h2>$msg_subject</h2>
							<p style='padding-top:3px;'><b>Message: </b>$msg_topic</p>
							<p><b>My Reply</b> $reply_content

							<form action='' method='post'>
							<textarea cols='30' rows='4' name='reply'></textarea>
							<br/>
							<input type='submit' name='msg_reply' value='Reply to this'/>
							</center>
						</form>
							";
						}

						
						if(isset($_POST['msg_reply'])){
							$reply=$_POST['reply'];

							if($reply_content!='no_reply'){
								echo"<h2 align='center'>Message already replied!</h2>";
							}
							else{

							$update_msg="update messages set reply='$reply' where msg_id=$get_id";
							$run_update=mysqli_query($con,$update_msg);
							if($run_update)
							{
								echo"<center>Message sent</center> ";
							}
						}
					}
				
						?>
						
						
	
				</div>
				<!--msg ends-->
			</div>
			<!--contents ends-->
		</div>
		<!--container ends--> 
		</body>
</html>
<?php } ?>








