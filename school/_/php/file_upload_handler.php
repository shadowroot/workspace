<?php
include "pdo.php";
include_once "./config.php";
$pdo = new db($db['dsn'] , $db['user'] , $db['password'] );
$debug = 1;
if(!empty($_FILES)){
	if($debug){
		var_dump($_FILES);
		var_dump($_POST);
	}
	$images = array();
	$subscripts = array();
	$path = "images/";
	foreach ($_FILES as $key => $file)
	{
		$len = count($_FILES[$key]['name']) ;
		for($i=0;$i<=$len;$i++){
			echo $_FILES[$key]['name'][$i];
			$images[$key]['name'] = $_FILES[$key]['name'][$i];
			if(is_uploaded_file($_FILES[$key]['tmp_name'][$i])){
				$name = explode(".",$_FILES[$key]['name'][$i]);
				$end = $name[count($name)-1];
				$filename = $path.md5($_FILES[$key]['name'][$i]).".".$end;
				if(move_uploaded_file($_FILES[$key]['tmp_name'][$i] , $filename )){
					if($_FILES[$key]['size'][$i] != filesize($filename)){
						echo "<script>up.success();</script>";
					}
					else{
						echo "<script>up.fail(" . $_FILES[$key]['name'][$i] .");</script>";
					}
				}
			}
		}
	}
	foreach ($_POST as $key => $value){
		$subscripts[$key]['subscribe'] = $value;
		
	}

}
?>