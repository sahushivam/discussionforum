<table align="center" width="800px" border="1" bgcolor="skyblue">
	<tr>
		<th>SN</th>
		<th>Name</th>
		<th>Image</th>
		<th>Country</th>
		<th>Gender</th>
		<th>Delete</th>
		<th>Edit</th>
	</tr>
		<?php
		$i=1;
		include("includes/connection.php");
		$get_members="select * from users";
		$run_members=mysqli_query($con,$get_members);
		while($row=mysqli_fetch_array($run_members)){
						$user_id=$row['user_id'];
						$user_name=$row['user_name'];
						$user_image=$row['user_image'];
			$user_country=$row['user_country'];
			$user_gender=$row['user_gender'];
			$user_reg_date=$row['register_date'];
			$user_email=$row['user_email'];
			$user_pass=$row['user_pass'];
		
		?>
	<tr align="center" bgcolor="orange">
		<td><?php echo $i;$i++;?></td>
		<td><?php echo $user_name;?></td>
				<td><img src="../user/user_images/<?php echo $user_image;?>" width ='50' height='50'/></td>
		<td><?php echo $user_country;?></td>
		<td><?php echo $user_gender;?></td>
		<td><a href="delete.php?delete=<?php echo $user_id;?>">Delete</a></td>
		<td><a href="index.php?view_users&edit=<?php echo $user_id;?>">Edit</a></td>
	</tr>
	<?php
}
?>
</table>
<?php
if(isset($_GET['edit']))
		{
			$edit_id=$_GET['edit'];
		?>
<form action="" method="post" id="f" class="ff" enctype="multipart/form-data">
			<table>
				<tr align="center">
					<td colspan="6"><h2>Edit User</h2>
				</tr>
				<tr>
					<td align="right">Name:</td>
					<td>
					<input type="text" name="u_name"  required="required" value="<?php echo "$user_name";?>"/>
					</td>
				</tr>
				<tr>
					<td align="right">Password:</td>
					<td>
					<input type="password" name="u_pass"  required="required" value="<?php echo "$user_pass";?>" />
					</td>
				</tr>
				<tr>
					<td align="right">Email:</td>
					<td>
					<input type="email" name="u_email"  required="required" value="<?php echo "$user_email";?>" />
					</td>
				</tr>
				<tr>
					<td align="right">Country:</td>
					<td>
					<select name="u_country">
							<option><?php echo "$user_country";?></option>
							<option>Afgansitan</option>
							<option>India</option>
							<option>Pakistan</option>
							<option>United States</option>
							<option>UAE</option>
						</select>
				</td>
				</tr>
					<td align="right">Gender:</td>
					<td >
						<select name="u_gender">
							<option>Gender</option>
							<option>Male</option>
							<option>Female</option> 
						</select>
					</td>
				
				<tr>
					<td align="right">Photo</td>
					<td>
					<input type="file" name="u_image" value="<?php echo "$user_image";?>"  />
					</td>
				</tr>
				
				<tr align="center">
					
					<td colspan="6">
					<input type="submit" name="update" value="Update" />
					</td>
				</tr>
			</table>
		</form>
		<?php } ?>
	<?php

	if(isset($_POST['update'])){

		$u_name=$_POST['u_name'];
		$u_pass=$_POST['u_pass'];
		$u_email=$_POST['u_email'];
		$u_country=$_POST['u_country'];
		$u_image=$_FILES['u_image']['name'];
		$image_tmp=$_FILES['u_image']['tmp_name'];


move_uploaded_file($image_tmp, "../user/user_images/$u_image");

$update="update users set user_name='$u_name',user_pass='$u_pass', user_email='$u_email',user_country='$u_country', user_image='$u_image' where user_id='$user_id'";


 
$run =mysqli_query($con,$update);
if($run)
{
	echo "<script> alert('Your Profile is updated')</script>";
	echo "<script>window.open('index.php','_self')</script>";
}
}

	