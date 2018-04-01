<?php
$con=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
	
//function for getting topics
function getTopics()
{
	global $con;
$get_topics="select * from topics";
$run_topics=mysqli_query($con,$get_topics);

	while($row=mysqli_fetch_array($run_topics))
	{
		$topic_id=$row['topic_id'];
		$topic_title=$row['topic_title'];
		echo "<option value='$topic_id'>$topic_title</option> ";
	}
}


//function for inserting post
function insertPost()
{
	if(isset($_POST['sub']))
	{
		global $con;
		global $user_id;
		$title=addcslashes($_POST['title'],"\'");
		$content=addcslashes($_POST['content'],"\'");
		$topic=$_POST['topic'];
		
		$user_posts="select * from post where user_id='$user_id'";
		$run_posts=mysqli_query($con,$user_posts);
		if(mysqli_query($con,$user_posts))
		{
			$posts=mysqli_num_rows($run_posts);
		}
		if($content=='')
		{
		echo "<h2>Please enter topic description </h2>";
		exit();
		}
		else
		{
		$insert="INSERT INTO `post`(`user_id`, `topic_id`, `post_title`, `post_content`, `post_date`) VALUES ('$user_id','$topic','$title','$content',NOW())";
		if(mysqli_query($con,$insert))
		{
			echo"<h3>Posted to timeline, Looks great! </h3>";
			$update="update users set posts='yes' where user_id='$user_id'";
			$run_update=mysqli_query($con,$update);
		}
		}
	}
}
//function for displaying post
function get_post()
{
	 global $con;
	$per_page=5;
	if(isset($_GET['page']))
	{
		$page=$_GET['page'];

	}
	else
	{
		$page=1;
	}
	$start_from =($page-1) *$per_page;
	$get_post="select * from post ORDER by 1 DESC LIMIT $start_from, $per_page";
	$run_post = mysqli_query($con,$get_post);
	while($row = mysqli_fetch_array($run_post))
	{
		$post_id=$row['post_id'];
		$user_id=$row['user_id'];
		$post_title=$row['post_title'];
		$content=$row['post_content'];
		$post_date=$row['post_date'];

		//getting the user who has posted the post
		$user="select * from users where user_id='$user_id' AND posts='yes'";

		$run_user =mysqli_query($con, $user);
		$row_user=mysqli_fetch_array($run_user);
		$user_name=$row_user['user_name'];
		$user_image =$row_user['user_image'];

		//now displaying all at once
		echo "<div id ='posts'>

		<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
		<h3><a href='user_profile.php?u_id= $user_id'>$user_name</a></h3>
		<h3>$post_title</h3>
		<p>$post_date</p>
		<p>$content</p>
		<a href='single.php?post_id=$post_id' style='float:right;'><button>See Replies or Reply to This</button></a>

		</div><br/>

		";

	}
	include("pagination.php");
}




	function single_post(){
		if(isset($_GET['post_id'])){

			$get_id=$_GET['post_id'];
			 global $con;

			 $get_post="select * from post where  post_id='$get_id'";


			$run_post = mysqli_query($con,$get_post);
		
			$row = mysqli_fetch_array($run_post);
			$post_id=$row['post_id'];
			$user_id=$row['user_id'];
			$post_title=$row['post_title'];
			$content=$row['post_content'];
			$post_date=$row['post_date'];

			//getting the user who has posted the post
			$user="select * from users where user_id='$user_id' AND posts='yes'";

			$run_user =mysqli_query($con, $user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
			$user_image =$row_user['user_image'];


			//getting the user session


			$user_com=$_SESSION['user_email'];
			$get_com="select * from users where user_email='$user_com'";
			$run_com=mysqli_query($con,$get_com);
			$row_com=mysqli_fetch_array($run_com);
			$user_com_id=$row_com['user_id'];
			$user_com_name=$row_com['user_name'];
			//now displaying all at once
			
			echo "
			<div id ='posts'> 

			<p><img src='user/user_images/$user_image' width='50' height='50' alt=$user_image/></p>
			<h3><a href='user_profile.php?user id= $user_id'>$user_name</a></h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content</p>
			
			</div>";
			include("comments.php");
			echo "
			
			<form action='' method='post' id='reply'>
			<textarea cols='50' rows='5'name='comment'  placeholder='write your reply'></textarea><br/>
			
			<input type='submit' name='reply' value='Reply to this'/>
			</form>
			";
			
			if(isset($_POST['reply'])){
				$comment=$_POST['comment'];

				 $insert ="insert into comments (post_id,user_id,comment,date,comment_author) values ('$post_id','$user_id','$comment',NOW(),'$user_com_name')";

				 if(mysqli_query($con,$insert)){
				 header("location: single.php?post_id=$post_id");
				}
				
			}

		}
	}
		function get_Cats(){
		 
		global $con;

	$per_page=5;
		if(isset($_GET['page'])){
			$page=$_GET['page'];

		}
		else{
			$page=1;
		}
		$start_from =($page-1) *$per_page;
	
		if(isset($_GET['topic'])){
			$topic_id=$_GET['topic'];

		}
		else{
		$topic_id=1;
	}
		$start_from =($page-1) *$per_page;

		$get_post="select * from post where topic_id='$topic_id' ORDER by 1 DESC LIMIT $start_from, $per_page";


				$run_post = mysqli_query($con,$get_post);
		while($row = mysqli_fetch_array($run_post)){
		
			$post_id=$row['post_id'];
			$user_id=$row['user_id'];
			$post_title=$row['post_title'];
			$content=$row['post_content'];
			$post_date=$row['post_date'];

			//getting the user who has posted the post
			$user="select * from users where user_id='$user_id' AND posts='yes'";

			$run_user =mysqli_query($con, $user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
			$user_image =$row_user['user_image'];

			//now displaying all at once
			echo "<div id ='posts'>

			<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
			<h3><a href='user_profile.php?u_id= $user_id'>$user_name</a></h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content</p>
			<a href='single.php?post_id=$post_id' style='float:right;'><button>See Replies or Reply to This</button></a>

			</div><br/>

			";

		}
		include("pagination_topic.php");
	}


//search results
	function GetResults(){
		 
		global $con;

		$per_page=5;
		if(isset($_GET['page'])){
			$page=$_GET['page'];

		}
		else{
			$page=1;
		}
		$start_from =($page-1) *$per_page;

			if(isset($_GET['user_query'])){
			$search_term=$_GET['user_query'];

		}

		$get_post="select * from post where post_title like '%$search_term%' or post_content like '%$search_term%' ORDER by 1 DESC LIMIT $start_from, $per_page";


				$run_post = mysqli_query($con,$get_post);
				$count_result=mysqli_num_rows($run_post); 
				if($count_result==0)
				{
					echo "<h3 style='background:black; color:white;padding:10px;'>'Sorry, No results found </h3>

					";
					exit();
				}
		while($row = mysqli_fetch_array($run_post)){
		
			$post_id=$row['post_id'];
			$user_id=$row['user_id'];
			$post_title=$row['post_title'];
			$content=$row['post_content'];
			$post_date=$row['post_date'];

			//getting the user who has posted the post
			$user="select * from users where user_id='$user_id' AND posts='yes'";

			$run_user =mysqli_query($con, $user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
			$user_image =$row_user['user_image'];

			//now displaying all at once
			echo "<div id ='posts'>

			<p><img src='user/user_images/$user_image' width='50' height='50' alt=$user_image/></p>
			<h3><a href='user_profile.php?user id= $user_id'>$user_name</a></h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content</p>
			<a href='single.php?post_id=$post_id' style='float:right;'><button>See Replies or Reply to This</button></a>

			</div><br/>

			";

		}
		include("pagination.php");
	}




	//function for displaying post
	function user_posts(){
		 
		global $con;

		$per_page=5;
		if(isset($_GET['page'])){
			$page=$_GET['page'];

		}
		else{
			$page=1;
		}
		$start_from =($page-1) *$per_page;
		if(isset($_GET['u_id'])){
			$u_id=$_GET['u_id'];
		}

		$get_posts="select * from post where user_id='$u_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
		$run_posts = mysqli_query($con,$get_posts);
		$num = mysqli_num_rows($run_posts);

		while($row = mysqli_fetch_array($run_posts)){
		
			$post_id=$row['post_id'];
			$user_id=$row['user_id'];
			$post_title=$row['post_title'];
			$content=$row['post_content'];
			$post_date=$row['post_date'];

			//getting the user who has posted the post
			$user="select * from users where user_id='$user_id' AND posts='yes'";

			$run_user =mysqli_query($con, $user);
			$row_user=mysqli_fetch_array($run_user);
			$user_name=$row_user['user_name'];
			$user_image =$row_user['user_image'];

			//now displaying all at once
			echo "<div id ='posts'>

			<p><img src='user/user_images/$user_image' width='50' height='50'/></p>
			<h3><a href='user_profile.php?u_id=$user_id'>$user_name</a></h3>
			<h3>$post_title</h3>
			<p>$post_date</p>
			<p>$content</p>
			<a href='single.php?post_id=$post_id' style='float:right;'><button>View</button></a>
			<a href='edit_post.php?post_id=$post_id' style='float:right;'><button>Edit</button></a>
			<a href='delete_post.php?post_id=$post_id' style='float:right;'><button>Delete</button></a>

			</div><br/>

			";
			include("delete_post.php");
			
		}
		if($num != 0)
		include("pagination_userpost.php");
		else{
			echo"
<center>
<div id='pagination'>
<h2> no posts </h2>
</center></div>";
		}
}

	//function for displaying post
	function user_profile(){
		 
		global $con;

		if(isset($_GET['u_id'])){
			$user1_id=$_GET['u_id'];
		}
		
		 
		$select="select * from users where user_id='$user1_id'";


		$run = mysqli_query($con,$select);
		$row = mysqli_fetch_array($run);
		
			$id=$row['user_id'];
			$image=$row['user_image'];
			$name=$row['user_name'];
			$country=$row['user_country'];
			$gender=$row['user_gender'];
			$last_login=$row['last_login'];
			$register_date=$row['register_date'];
			if($gender=='Male'){
				$msg="Send him a message";
			}
			else
			{
				$msg="Send her a message";
			}

			//now displaying all at once
			echo "<div id ='user_profile'>

			<img src='user/user_images/$image' width='150' height='150'/>
			<br>
			<p><strong>Name:</strong> $name</p><br/>
			<p><strong>Gender:</strong> $gender</p><br/>
			<p><strong>Country:</strong>$country</p><br/>
			<p><strong>Last Login</strong> $last_login</p><br/>
			<a href='messages.php?u_id=$id'><button>$msg</button></a><hr>
			</div>
			";
			new_members();
		}
	
	function new_members()
	{
		global $con;
		$get_members="select * from users";
		$run_members=mysqli_query($con,$get_members);
		
		echo "<br/><h2>New Member </h2>";
		while($row=mysqli_fetch_array($run_members)){
		$user_id=$row['user_id'];
		$user_name=$row['user_name'];
		$user_image=$row['user_image'];
		 


		echo"
		<span>
		<a href ='user_profile.php?u_id=$user_id'>	
		<img src='user/user_images/$user_image' width='50' height='50' title='$user_name'/>						</a> 
		</span>
		 
		";
	}
}

?>
