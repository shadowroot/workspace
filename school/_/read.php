<?php
ob_start();
echo '
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html>
  <head>
  <title>Domena ea0825</title>
  <meta http-equiv="Content-Type" CONTENT="text/html; charset=utf-8">
  </head>
<body>
 ';

 $file = $_GET['file'];
 include_once $file;

echo '
</body>
</html>
';
?>
<?
ob_end_flush();
?>
