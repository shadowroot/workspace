<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Taneční podložky" />
<title>Taneční podložky</title>
</head>
<body>
<?php
/*
*	@param $password = "my_password" (string)
*	@param $filename = "name_of_file" (string)
*
*
*/
require_once 'mysql_connect.php';
error_reporting(0);
ob_start();
session_start();
session_cache_expire(120);

$passwd = "trythispassword";
if(isset($_POST['passwd']) && $_POST['passwd'] == $passwd){
	$_SESSION['logged'] = 1;	
}


echo '<table id="results">';
echo '<tr><td>Jméno</td><td>Příjmení</td><td>Ulice</td><td>Město</td><td>PSČ</td><td>E-mail</td><td>Telefon</td><td>Slevový kupon</td></tr>';
if(isset($_SESSION['logged']) && $_SESSION['logged'] == 1){
	$limit = mysql_result(mysql_query("select count(*) from orders ", 0));
	if(isset($_GET['i']) && $_GET['i'] != ""){
		$i = 50*$i;
	}
	else{
		$i = 50;
	}
	$query = mysql_query("select * from orders limit 0,$i");
	while($row=mysql_fetch_array($query)){
		echo '<tr class="result">';
		echo '<td>'.$row['jmeno'].'</td>';
		echo '<td>'.$row['prijmeni'].'</td>';
		echo '<td>'.$row['ulice'].'</td>';
		echo '<td>'.$row['mesto'].'</td>';
		echo '<td>'.$row['psc'].'</td>';
		echo '<td>'.$row['email'].'</td>';
		echo '<td>'.$row['telefon'].'</td>';
		echo '<td>'.$row['sleva'].'</td>';
		echo '</tr>';
	}
	$page = (int)$limit/50;
	if($limit/50 > $page){$page++;}
	$i=1;
	while($i<=$page){
		echo '<a href="view.php?i="'.$i.'>'.$i.'</a>';
		$i++;
	}
	
}
else{
	echo '<form action="" method="POST">';
	echo '<input type="text" name="passwd" size="20" id="log" />&nbsp;<input type="submit" value="Log me in" />';
	echo '</form>';
}
echo '</table>';

ob_end_flush();
?>
</body>
</html>