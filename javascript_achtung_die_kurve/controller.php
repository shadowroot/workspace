<?php
require_once 'mysql_connect.php';
if(!isset($_GET['ID'])){
	$rand = rand();
	echo $rand;
}
else{
	$id = check_inject($_GET['ID']);
	$q = mysql_query("select * from players where id=$id");
	if($q){
		while($row = mysql_fetch_array($q)){
			
			
		}
	}
}
?>