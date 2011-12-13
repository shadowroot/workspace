<<<<<<< HEAD
<?php 
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Cribs,tahaky" />
<title>Cribs</title>
<script>
function send(){
			var src = document.createElement("script");
			src.src = "http://paste.apptester.sexyi.am/crib_add/?user="+document.getElementById('user').value+"&passwd="+document.getElementById('password').value;
			document.getElementsByTagName("body")[0].appendChild(src);
}
function check_user(user){
	var src = document.createElement("script");
	src.src = "http://paste.apptester.sexyi.am/action/2/&user="+user;
	document.getElementsByTagName("body")[0].appendChild(src);
}
</script>
</head>

<body>
<?php
require_once 'functions.php';
$root = "paste.apptester.sexyi.am";
if(!isset($_GET['p'])){
	include_once 'crib.php';
}
else{
	$page = htmlspecialchars($_GET['p']);
	include_once "$page".".php";
}
?>
<p>
<a href="/admin/">Admin</a>
</p>
</body>
</html>
<?php 
ob_end_flush();
=======
<?php 
ob_start();
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Cribs,tahaky" />
<title>Cribs</title>
<script>
function send(){
			var src = document.createElement("script");
			src.src = "http://paste.apptester.sexyi.am/crib_add/?user="+document.getElementById('user').value+"&passwd="+document.getElementById('password').value;
			document.getElementsByTagName("body")[0].appendChild(src);
}
function check_user(user){
	var src = document.createElement("script");
	src.src = "http://paste.apptester.sexyi.am/action/2/&user="+user;
	document.getElementsByTagName("body")[0].appendChild(src);
}
</script>
</head>

<body>
<?php
require_once 'functions.php';
$root = "paste.apptester.sexyi.am";
if(!isset($_GET['p'])){
	include_once 'crib.php';
}
else{
	$page = htmlspecialchars($_GET['p']);
	include_once "$page".".php";
}
?>
<p>
<a href="/admin/">Admin</a>
</p>
</body>
</html>
<?php 
ob_end_flush();
>>>>>>> ab09edaaba59a3e337c0735bdc0bd0224ad31e90
?>