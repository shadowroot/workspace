<?php
$server = "127.0.0.1";
$user = "root";
$passwd = "jonny555";
$db = "curve";
mysql_connect($server,$user,$passwd) or die("mysql connect error");
mysql_select_db($db) or die("mysql database select error");
function check_inject($data){
	$data = htmlspecialchars($data);
	$data = strip_tags($data);
	$data = stripslashes($data);
	$data = mysql_escape_string($data);

	return $data;
}

?>
