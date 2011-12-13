<<<<<<< HEAD
<?php
require_once 'mysql_connect.php';
require_once 'functions.php';
if($_SESSION['privilege'] == 0){
	echo '<table><tr><td>ID</td><td>USER</td><td>PRIVILEGE</td><td>AUTHORIZED</td><td>E-mail</td></tr>';
	$q = mysql_query("select * from users");
		while($row = mysql_fetch_array($q)){
			echo '<tr><td>'.$row['id'].'</td><td>'.$row['user'].'</td><td>'.$row['privilege'].'</td><td>'.$row['authorized'].'</td><td>'.$row['email'].'</td><td><a href="/admin/2/?id='.$row['id'].'">Authorize</a></td><td><a href="/admin/3/?id='.$row['id'].'&privilege=0">Privilege 0</a></td><td><a href="/admin/3/?id='.$row['id'].'&privilege=1">Privilege 1</a></td><td><a href="/admin/3/?id='.$row['id'].'&privilege=2">Privilege 2</a></td><td><a href="/admin/3/?id='.$row['id'].'&privilege=3">Privilege 3</a></td><td><a href="/admin/4/?id='.$row['id'].'&privilege=1">Delete</a></td></tr>';
		}
}


=======
<?php
require_once 'mysql_connect.php';
require_once 'functions.php';
if($_SESSION['privilege'] == 0){
	echo '<table><tr><td>ID</td><td>USER</td><td>PRIVILEGE</td><td>AUTHORIZED</td><td>E-mail</td></tr>';
	$q = mysql_query("select * from users");
		while($row = mysql_fetch_array($q)){
			echo '<tr><td>'.$row['id'].'</td><td>'.$row['user'].'</td><td>'.$row['privilege'].'</td><td>'.$row['authorized'].'</td><td>'.$row['email'].'</td><td><a href="/admin/2/?id='.$row['id'].'">Authorize</a></td><td><a href="/admin/3/?id='.$row['id'].'&privilege=0">Privilege 0</a></td><td><a href="/admin/3/?id='.$row['id'].'&privilege=1">Privilege 1</a></td><td><a href="/admin/3/?id='.$row['id'].'&privilege=2">Privilege 2</a></td><td><a href="/admin/3/?id='.$row['id'].'&privilege=3">Privilege 3</a></td><td><a href="/admin/4/?id='.$row['id'].'&privilege=1">Delete</a></td></tr>';
		}
}


>>>>>>> ab09edaaba59a3e337c0735bdc0bd0224ad31e90
?>