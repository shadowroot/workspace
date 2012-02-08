<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html>
  <head>
  <title>Domena ea0825</title>
  <meta http-equiv="Content-Type" CONTENT="text/html; charset=windows-1250">
  </head>
<body>
<?php
$time = date("j.n.Y H:i:s");
$dir = opendir(".");
echo "<ul>";
while($handle = readdir($dir)){
   echo "<li><a href=\"read.php?file=$handle\">$handle</a> Source <a href=\"view.php?file=$handle\">Source code $handle</a></li>";

}
echo "</ul>";
?>

</body>
</html>
