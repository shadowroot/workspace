<?php

ob_start();
session_start();
include_once "config.php";
if(!isset($_GET['action'])){
	$_GET['action'] = null;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Gallery</title>
	
</head>

<body>
	<?php 
	switch($_GET['action']){
		case "edit":
			include "edit.php";
			break;
		case "image":
			include 'image.php';
			break;
		default:
		include './php/file_upload_handler.php';
		include './php/galery.php';
		include './front_php/file_upload.php';
		break;
	}
	?>
	<script type="text/javascript" src="js/ui.js"></script>
	<div id="debug">
	</div>
</body>
</html>
<?php
ob_end_flush();
?>