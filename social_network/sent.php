<table width="700">
				<tr>
					<th>Reciever</th>
					<th>Subject</th>
					<th>Date</th>
					<th>Reply</th>
					</tr>
				<?php
					$sel_msg="select * from messages where sender='$user_id' ORDER BY 1 DESC";
					$run_msg=mysqli_query($con,$sel_msg);
					$count_msg=mysqli_num_rows($run_msg);

					$count=1;
					while($row_msg=mysqli_fetch_array($run_msg))
					{
						$count=$count+1;
						$msg_id=$row_msg['msg_id'];
						$msg_sender=$row_msg['sender'];
						$msg_receiver=$row_msg['reciever'];
						$msg_sub=$row_msg['msg_sub'];
						$msg_topic=$row_msg['msg_topic'];
						$msg_date=$row_msg['msg_date'];

						$get_reciever="select * from users where user_id='$msg_receiver'";
						$run_reciever=mysqli_query($con,$get_reciever);
						$row=mysqli_fetch_array($run_reciever);
						$reciever_name=$row['user_name'];
					
					echo "<tr align='center'>
						<td><a href='user_profile.php?u_id=$msg_receiver'/>$reciever_name</td>
						<td><a href='my_messages.php?msg_id=$msg_id'/>$msg_sub</td>
						<td>$msg_date</td>
						<td><a href='my_messages.php?msg_id=$msg_id '/>Reply</td>


					</tr>";
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
							$msg_topic=$row_message['msg_topic'];
							$msg_date=$row_message['msg_date'];
							$reply_content=$row_message['reply'];
							$run_user =mysqli_query($con, "select * from users where user_id='$msg_receiver'");
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