<?php
require_once 'functions.php';
ob_start();
session_start();
session_cache_expire(120);
function process($data,$theme){
	$query = mysql_query("insert into pages (page) VALUES('$data')") or die("Selhala datab�ze");
	$text = "";
	$enter = "\x0D\x0A";//\r\n
	$tab1 = "\x20\x20\x20\x20";
	$tab2 = "\x09";
	$separator = "\x0D\x0A\x0D\x0A";//hlavni odstavec <a name>
	$names = array();
	$tab = explode($separator, $data);
	$i=0;
	foreach ($tab as $tex){
			if(strlen($tex) < 100){
				$text .= '<a name="'.$tex.'">'.$tex.'</a>';
				$names[$i] = $tex;
				$i++;
			}
			else{
				$text .= $tex;
			}
		}
	mysql_query("insert into completed (page) values ('$text')");
	$max = mysql_result(mysql_query("select max(id) from pages"), 0);
	$namess = implode(' ', $names);
	mysql_query("insert into indexes (keyword,page,positions) values ('$theme','$max','$namess')");
}
	

if(isset($_SESSION['privilege']) && $_SESSION['privilege'] <= 3){
	if(isset($_POST['data'])){
		process(not_inj($_POST['data']),not_inj($_POST['theme']));
		header("Location:index.php");
	}
	else{
		echo '<form method="POST" action="">';
		echo 'Theme <input type="text" name="theme" /><br>';
		echo 'Text <textarea cols="100" rows="50" name="data"></textarea><br>';
		echo '<input type="submit" value="save">';
		echo '</form>';
	}
	
}
else {
	header("Location:/login/");
	$_SESSION['ref'] = "/crib_add/";
}
ob_end_flush();
?>
