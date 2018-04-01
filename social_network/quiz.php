<!DOCTYPE html>
<html>
<head>
	<title>Online Quiz</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
			<center><h2 style="font-family: Verdana;">Online Quiz</h2></center>
			<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#"><strong>Quiz</strong></a></li>
					<li><a data-toggle="tab" href="#" style="color: black;"><strong>Home</strong></a></li>
					<li style="float: right;"><a data-toggle="tab" style="color: brown;" href="#"><b>Logout<b></a></li>
			</ul>
			<br/>
				<div class="tab-content">
					<div id="quiz" class="tab-pane fade in active">
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<br/>
					<div id="select">
						<form method="post" action="ques.php">
					 <select class="form-control" id="" name="cat">
				        <option>select category</option>
				        <?php $conn=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");


					global $conn;
					$get_topics="select * from caegory";
					$run_topics=mysqli_query($conn,$get_topics);
					while($row=mysqli_fetch_array($run_topics))
					{
					$topic_id=$row['id'];
					$topic_title=$row['cat_name'];
					echo "<option value='$topic_id'>$topic_title</option> ";
					}
						?>
				     </select>
				     <br/>
				     <center><input type="submit" value="Start Quiz" class="btn btn-primary"></center>
				 </form>
				 	</div>
				 	</div>
					</div>
				</div>
		</div>
	</div>
</body>
</html>