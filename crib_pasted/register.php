<<<<<<< HEAD
<form action="<?php echo 'http://'.$root.'/action/1/'; ?>" method="post">
			<table id="form">
				<tr class="form_col">
					<td>*Username</td>
					<td><input type="text" size="20" name="user" onchange="check_user(this.value);"
						value="<?php if(isset($_GET['user'])){echo $_GET['user'];} ?>" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*Password</td>
					<td><input type="password" size="20" name="passwd1"
						value="" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*Password</td>
					<td><input type="password" size="20" name="passwd2"
						value="" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*E-mail</td>
					<td><input type="text" size="20" name="email"
						value="<?php if(isset($_GET['email']))echo $_GET['email']; ?>" />
					</td>

				<tr>
					<td></td>
					<td><input type="submit" value="Register!" /></td>
				</tr>
			</table>
=======
<form action="<?php echo 'http://'.$root.'/action/1/'; ?>" method="post">
			<table id="form">
				<tr class="form_col">
					<td>*Username</td>
					<td><input type="text" size="20" name="user" onchange="check_user(this.value);"
						value="<?php if(isset($_GET['user'])){echo $_GET['user'];} ?>" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*Password</td>
					<td><input type="password" size="20" name="passwd1"
						value="" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*Password</td>
					<td><input type="password" size="20" name="passwd2"
						value="" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*E-mail</td>
					<td><input type="text" size="20" name="email"
						value="<?php if(isset($_GET['email']))echo $_GET['email']; ?>" />
					</td>

				<tr>
					<td></td>
					<td><input type="submit" value="Register!" /></td>
				</tr>
			</table>
>>>>>>> ab09edaaba59a3e337c0735bdc0bd0224ad31e90
		</form>