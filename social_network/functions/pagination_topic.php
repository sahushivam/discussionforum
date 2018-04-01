<?php
$query ="select * from post where topic_id='$topic_id'";
$result=mysqli_query($con,$query);
//count the total records
$total_posts=mysqli_num_rows($result);
//using ceil function to  divide the total records on per page
$total_pages=ceil($total_posts/$per_page);
//Going to first page
echo"
<center>
<div id='pagination'>

";
$topicForPagination="topic=".$topic_id;
for($i=1;$i<=$total_pages;$i++){
	echo "<a href='topic.php?$topicForPagination&page=$i'>$i</a>";

}
//going to last page
echo "</center></div>";
?>

