<?php
require_once 'functions.php';
if(isset($_POST['user']) && isset($_POST['passwd'])){
	$query = mysql_query("select * from users where user='".$_GET['user']."' and password='".md5($_GET['passwd'])."'");
	$user = mysql_fetch_array($query);
	if($query){
		if($user['authorized'] == 1){
			$_SESSION['privilege'] = $user['privilege'];
			$_SESSION['user'] = $user['user'];
			$_SESSION['id'] = $user['id'];
			header("Location:".$_SESSION['ref']);
		}
		else{
			$_GET['err'] = 1;
			$_GET['subs'] = "Vaše přihlašovací údaje nejsou správné.";
			redir();
		}
	}
}
else{
echo '<form action="" method="post">
			<table id="form">
				<tr class="form_col">
					<td>*Username</td>
					<td><input type="text" size="20" name="user" onchange="check_user(this.value);"
						value="" />
					</td>
				</tr>
				<tr class="form_col">
					<td>*Password</td>
					<td><input type="password" size="20" name="passwd"
						value="" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" value="Log In!" /></td>
				</tr>
			</table>
		</form>';
}