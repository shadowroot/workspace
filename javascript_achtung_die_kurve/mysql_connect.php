<?php
$server = "127.0.0.1";
$user = "root";
$passwd = "jonny555";
$db = "curve";
mysql_connect($server,$user,$passwd);
mysql_select_db($db);
function check_inject($data){
	$data = htmlspecialchars($data);
	$data = strip_tags($data);
	$data = stripslashes($data);

	if(find(array("'","\"","#","&"), $data)){
		return false;
	}
	
	return $data;
}
function find($what,$where){
	$c = count($what);
	for ($i=0;i<=len($where)-1;$i++){
		for($u=0;$u<=$c-1;$u++){
			if($where[$i] == $what[$u]){
				return true;
			}
		}
	}
	return false;	
}
?>
