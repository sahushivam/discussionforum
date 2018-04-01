<!--Content Area starts-->
			<div id="content">
				<div style="float: left;">
					<img src="images/images.png" style="margin-right: 40px; width: 350px;" />
				</div>
		<div id ="form2">
		<form action="user_insert.php" method="post">
			<h2>Sign Up Here</h2>
			<table>
				<tr>
					<td align="right">Name:</td>
					<td>
					<input type="text" name="u_name" placeholder="Enter your name" required="required" />
					</td>
				</tr>
				<tr>
					<td align="right">Pasword:</td>
					<td>
					<input type="password" name="u_pass" placeholder="Enter your password" required="required" />
					</td>
				</tr>
				<tr>
					<td align="right">Email:</td>
					<td>
					<input type="email" name="u_email" placeholder="Enter your email" required="required" />
					</td>
				</tr>
				<tr>
					<td align="right">Country:</td>
					<td>
					<select name="u_country">
							<option>Select a Country</option>
							<option>Afgansitan</option>
							<option>India</option>
							<option>Pakistan</option>
							<option>United States</option>
							<option>UAE</option>
						</select>
				</td>
				</tr>
					<td align="right">Gender:</td>
					<td>
						<select name="u_gender">
							<option>Gender</option>
							<option>Male</option>
							<option>Female</option>
						</select>
					</td>
				<tr>
					<td align="right">Birthday</td>
					<td>
					<input type="date" name="u_birthday">
					</td>
				</tr>
				
				<tr>
					<td></td>
					<td>
					<button name="sign_up">Sign Up</button>
					</td>
				</tr>
			</table>
		</form>
	
	</div>
	</div>
	<!--content area ends-->
	</div>
		<!--container ends-->