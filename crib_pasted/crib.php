<<<<<<< HEAD
Little crib<br>
Taháky
<p>
Paste your own crib
<?php 
if(isset($_SESSION['user']) && $_SESSION['user'] != ""){
	echo 'Hello '.$_SESSION['user'].' !';
}
else{
	echo '<p>To <a href="http://'.$root.'/login/">Log In!</a></p>';
	echo '<p>You can register <a href="http://'.$root.'/register/">here</a></p>';
}

?>
</p>
<p>
Themes
</p>

<?php
require_once 'functions.php';
require_once 'mysql_connect.php';
$query = mysql_query("select keyword,page from indexes");
$keys = array();
while($row = mysql_fetch_array($query)){
	$keys[$row['page']] = $row['keyword'];
	echo '<a href="#'.$row['page'].'">'.$row['keyword'].'</a><br>';
}
$q = mysql_query("select * from completed");
while($row = mysql_fetch_array($q)){
	echo '<a name="'.$row['id'].'">'.$keys[$row['id']].'</a><p>'.$row['page'].'</p>';
}
?>
<hr size="1" /><br />
=======
Little crib<br>
Taháky
<p>
Paste your own crib
<?php 
if(isset($_SESSION['user']) && $_SESSION['user'] != ""){
	echo 'Hello '.$_SESSION['user'].' !';
}
else{
	echo '<p>To <a href="http://'.$root.'/login/">Log In!</a></p>';
	echo '<p>You can register <a href="http://'.$root.'/register/">here</a></p>';
}

?>
</p>
<p>
Themes
</p>

<?php
require_once 'functions.php';
require_once 'mysql_connect.php';
$query = mysql_query("select keyword,page from indexes");
$keys = array();
while($row = mysql_fetch_array($query)){
	$keys[$row['page']] = $row['keyword'];
	echo '<a href="#'.$row['page'].'">'.$row['keyword'].'</a><br>';
}
$q = mysql_query("select * from completed");
while($row = mysql_fetch_array($q)){
	echo '<a name="'.$row['id'].'">'.$keys[$row['id']].'</a><p>'.$row['page'].'</p>';
}
?>
<hr size="1" /><br />
>>>>>>> ab09edaaba59a3e337c0735bdc0bd0224ad31e90
Just cribs use them as you want to. 