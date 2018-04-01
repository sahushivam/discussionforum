
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="col-sm-2"></div>
	<div class="col-sm-8">
  <h2>Online Quiz</h2>
  <form action="answer.php" method="post">
  <?php
	
	$conn=mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
	global $conn;
	$ques=$_POST['cat'];
	$get_topics="select * from questions where cat_id='$ques'";
	$run_topics=mysqli_query($conn,$get_topics);
	while($row=mysqli_fetch_array($run_topics)){
	$id=$row['id'];
	$ques=$row['question'];
	$option1=$row['ans1'];
	$option2=$row['ans2'];
	$option3=$row['ans3'];
	$option4=$row['ans4'];
	$correctoption=$row['ans'];?>
  <table class="table table-bordered">
    <thead>
      <tr class="danger">
        <th><?php echo $ques ?></th>
      </tr>
    </thead>
    <tbody>
      <tr class="info">
        <td>1.&emsp;<input type="radio" name="options" value="<?php echo $id; ?>">&nbsp;<?php echo $option1 ?></td>
      </tr>
       <tr class="info">
        <td>2.&emsp;<input type="radio" name="options" value="<?php echo $id; ?>">&nbsp;<?php echo $option2 ?></td>
      </tr>
       <tr class="info">
        <td>3.&emsp;<input type="radio" name="options" value="<?php echo $id; ?>">&nbsp;<?php echo $option3 ?></td>
      </tr>
       <tr class="info">
        <td>4.&emsp;<input type="radio" name="options" value="<?php echo $id; ?>">&nbsp;<?php echo $option4 ?></td>
      </tr>
  </tbody>
</table>
<?php } ?>
<center><input type="submit" name="" value="Submit Quiz" class="btn btn-success"></center>
</form>
</div>
</div>
<div class="col-sm-2"></div>
</body>
</html>